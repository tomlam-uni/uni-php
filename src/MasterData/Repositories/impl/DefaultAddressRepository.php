<?php

namespace App\MasterData\Repositories\impl;

use App\MasterData\Models\AccessCode;
use App\MasterData\Models\Address;
use App\MasterData\Repositories\AddressRepository;
use App\Exceptions\AppException;
use App\Support\YlsIdeas\FeatureFlags\Facades\Features;
use Illuminate\Support\Facades\DB;

class DefaultAddressRepository implements AddressRepository
{
    public function store($address, $sub_enum)
    {
        switch ($sub_enum) {
            case Address::AGGREGATE_SUB_ACCESS_CODE:
                $this->storeAccessCode($address);
                break;
            default:
                throw new AppException(AppException::COMMON_MODEL_UNKNOWNSUB, 404);
        }
    }

    public function findByOrderId($order_id, $sub_enum)
    {
        switch ($sub_enum) {
            case Address::AGGREGATE_ROOT:
                return $this->findAddressByOrderId($order_id);
            case Address::AGGREGATE_SUB_ACCESS_CODE:
                return $this->findByOrderIdAttachAccessCode($order_id);
            default:
                throw new AppException(AppException::COMMON_MODEL_UNKNOWNSUB, 404);
        }
    }

    public function findByAccessCodeId($id)
    {
        if (!$access_code = AccessCode::find($id)) {
            throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
        }

        $address = new Address();

        $address->_addAccessCode($access_code);

        return $address;
    }

    protected function storeAccessCode($address)
    {
        foreach ($address->getAccessCodes() as $accessCode) {
            $accessCode->save();
        }
    }

    protected function findByOrderIdAttachAccessCode($order_id)
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

        $access_codes = DB::select(DB::raw(
            'SELECT sub_query.id,
            sub_query.longitude,
            sub_query.latitude,
            sub_query.address,
            sub_query.access_code,
            sub_query.comment,
            sub_query.driver_id AS creator,
            UNIX_TIMESTAMP(CONVERT_TZ(sub_query.created_at, \'Etc/UTC\', \'' . $order->time_zone . '\')) AS created_at,
            ROUND(6731 * 2 * ASIN(SQRT(POWER(SIN((RADIANS(sub_query.latitude) - RADIANS(' . $order->lat . ')) / 2), 2) +
            COS(RADIANS(sub_query.latitude)) * COS(RADIANS(' . $order->lat . ')) * POWER(SIN((RADIANS(sub_query.longitude) - RADIANS(' . $order->lng . ')) / 2), 2)
            ))' . (Features::accessible('us-version') ? ' * 0.6213712' : '') . ', 4) as distance
            FROM (' . $sub_query . ') AS sub_query
            WHERE (
            6731 * 2 * ASIN(SQRT(POWER(SIN((RADIANS(sub_query.latitude) - RADIANS(' . $order->lat . ')) / 2), 2) +
            COS(RADIANS(sub_query.latitude)) * COS(RADIANS(' . $order->lat . ')) * POWER(SIN((RADIANS(sub_query.longitude) - RADIANS(' . $order->lng . ')) / 2), 2)
            ))) <=' . (Features::accessible('us-version') ? ' (2 / 0.6213712)' : ' 2') . ' ORDER BY distance ASC, score DESC, created_at DESC LIMIT 1'
        ));

        foreach ($access_codes as $r) {
            $r->longitude = floatval($r->longitude);
            $r->latitude = floatval($r->latitude);
        }

        $address = new Address();

        $address->_addAccessCode($access_codes);

        return $address;
    }

    protected function findAddressByOrderId($order_id)
    {
        $order = DB::table('kuaisong.ecs_order_info')
            ->select('lat', 'lng', 'address')
            ->where('order_id', $order_id)
            ->first();

        if (!$order) {
            throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
        }

        return new Address($order->address, $order->lng, $order->lat);
    }
}
