<?php

namespace Uni\Queries;

use Uni\MasterData\Models\Ranking;
use Uni\Exceptions\AppException;
use Uni\Support\YlsIdeas\FeatureFlags\Facades\Features;
use Illuminate\Support\Facades\DB;

class MasterDataQueryService
{
    const supported_biz_flags = [
        'double-check', 'self-pickup'
    ];

    public static function getAccessCodesInfoByOrderIdAndDriverId($order_id, $driver_id)
    {
        $order = DB::table('kuaisong.ecs_order_info as eoi')
            ->select('eoi.lat', 'eoi.lng', 'uw.time_zone')
            ->join('kuaisong.uni_warehouses as uw', 'eoi.warehouse', '=', 'uw.id')
            ->where('order_id', $order_id)
            ->first();

        if (!$order) {
            throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
        }

        $sub_query = 'SELECT * FROM uni_common_access_codes WHERE ((ABS(latitude - ' . $order->lat . ') <= 0.3 OR ABS(longitude - (' . $order->lng . ')) <= 0.3))';

        $ranking_count = 'SELECT subject_id, count(id) AS total_score FROM uni_common_ranking WHERE subject_type = ' . Ranking::SUBJECT_TYPE_RANKING . ' GROUP BY subject_id';

        $driver_rank = 'SELECT * FROM uni_common_ranking WHERE driver_id = ' . $driver_id . ' AND subject_type = ' . Ranking::SUBJECT_TYPE_RANKING;

        $results = DB::select(DB::raw(
            'SELECT
            sub_query.id,
            sub_query.longitude,
            sub_query.latitude,
            sub_query.address,
            sub_query.access_code,
            sub_query.comment,
            sub_query.driver_id AS creator,
            UNIX_TIMESTAMP(CONVERT_TZ(sub_query.created_at, \'Etc/UTC\', \'' . $order->time_zone . '\')) AS created_at,
            ROUND(6731 * 2 * ASIN(SQRT(POWER(SIN((RADIANS(sub_query.latitude) - RADIANS(' . $order->lat . ')) / 2), 2) +
            COS(RADIANS(sub_query.latitude)) * COS(RADIANS(' . $order->lat . ')) * POWER(SIN((RADIANS(sub_query.longitude) - RADIANS(' . $order->lng . ')) / 2), 2)
            ))' . (Features::accessible('us-version') ? ' * 0.6213712' : '') . ', 4) AS distance,
            IF(ISNULL(driver_rank.id), NULL, driver_rank.id) AS ranking_id,
            IF(ISNULL(driver_rank.ranking_score), 0, driver_rank.ranking_score) AS ranking_score,
            IF(ISNULL(ranking_count.total_score), 0, ranking_count.total_score) AS total_ranking
            FROM (' . $sub_query . ') AS sub_query
            LEFT JOIN (' . $ranking_count . ') AS ranking_count ON ranking_count.subject_id = sub_query.id
            LEFT JOIN (' . $driver_rank . ') AS driver_rank ON driver_rank.subject_id = sub_query.id
            WHERE (
            6731 * 2 * ASIN(SQRT(POWER(SIN((RADIANS(sub_query.latitude) - RADIANS(' . $order->lat . ')) / 2), 2) +
            COS(RADIANS(sub_query.latitude)) * COS(RADIANS(' . $order->lat . ')) * POWER(SIN((RADIANS(sub_query.longitude) - RADIANS(' . $order->lng . ')) / 2), 2)
            ))) <=' . (Features::accessible('us-version') ? ' (2 / 0.6213712)' : ' 2') . ' ORDER BY distance ASC, score DESC, created_at DESC LIMIT 20'
        ));

        foreach ($results as $r) {
            $r->longitude = floatval($r->longitude);
            $r->latitude = floatval($r->latitude);
        }

        return $results;
    }

    public static function getFeatureFlag($feature)
    {
        $pattern = '/\$(\d+)\$/';

        if (preg_match($pattern, $feature, $matches)) {
            $driver_id = $matches[1];

            $driver = DB::table('kuaisong.ecs_staff')
                ->select('city_id')
                ->where('id', $driver_id)
                ->first();

            $feature = $driver ? preg_replace($pattern, $driver->city_id, $feature) : $feature;
        }

        return ['feature' => $feature,
            'state' => Features::accessible($feature)
        ];
    }

    public static function getAllFeaturesByDriverId($driver_id)
    {
        $driver = DB::table('kuaisong.ecs_staff')
            ->select('team_id')
            ->where('id', $driver_id)
            ->first();

        if (!$driver) {
            throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
        }

        $active_biz_flags = [];

        foreach (self::supported_biz_flags as $flag) {
            if (Features::accessible($driver->team_id . '-' . $flag)) {
                $active_biz_flags[] = $flag;
            }
        }

        return $active_biz_flags;
    }
}
