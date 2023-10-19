<?php

namespace App\Domains\MasterData\Repositories\impl;

use App\Domains\MasterData\Models\Ranking;
use App\Domains\MasterData\Repositories\RankingRepository;
use App\Exceptions\AppException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultRankingRepository implements RankingRepository
{
    public function store($ranking, $sub_enum)
    {
        switch ($sub_enum) {
            case Ranking::AGGREGATE_ROOT:
                $this->storeRoot($ranking);
                break;
            default:
                throw new AppException(AppException::COMMON_MODEL_UNKNOWNSUB, 404);
        }
    }

    public function findById($id, $sub_enum)
    {
        switch ($sub_enum) {
            case Ranking::AGGREGATE_ROOT:
                return Ranking::find($id);
            default:
                throw new AppException(AppException::COMMON_MODEL_UNKNOWNSUB, 404);
        }
    }

    public function deleteRanking($ranking)
    {
        $ranking->delete();

        if ($ranking->subject_type == Ranking::SUBJECT_TYPE_RANKING) {
            DB::table('uni_common_access_codes')
                ->where('id', $ranking->subject_id)
                ->update(['score' => DB::raw('GREATEST(0, score - 1)')]);
        }
    }

    public function findRankingById($subject_type, $subject_id, $timezone = null)
    {
        return DB::table('uni_common_ranking')
            ->select('id', 'driver_id', 'subject_type', 'subject_id', 'ranking_score', $timezone != null ? DB::raw('UNIX_TIMESTAMP(CONVERT_TZ(ranked_at, \'Etc/UTC\', \'' . $timezone . '\')) as ranked_at') : DB::raw('UNIX_TIMESTAMP(ranked_at) as ranked_at'))
            ->where([
                ['subject_type', '=', $subject_type],
                ['subject_id', '=', $subject_id]
            ])
            ->orderByDesc('ranked_at')
            ->get();
    }

    private function storeRoot($ranking)
    {
        $ranking->save();

        if ($ranking->subject_type == Ranking::SUBJECT_TYPE_RANKING) {
            DB::table('uni_common_access_codes')
                ->where('id', $ranking->subject_id)
                ->increment('score');
        }
    }

    public function findByDriverAndSubject($driver_id, $subject_type, $subject_id)
    {
        return Ranking::where([
            'driver_id' => $driver_id,
            'subject_type' => $subject_type,
            'subject_id' => $subject_id
        ])->first();
    }
}
