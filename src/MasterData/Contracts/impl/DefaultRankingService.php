<?php

namespace App\Domains\MasterData\Contracts\impl;

use App\Domains\MasterData\Contracts\RankingService;
use App\Domains\MasterData\Models\Ranking;
use App\Domains\MasterData\Repositories\RankingRepository;
use App\Exceptions\AppException;
use Illuminate\Container\Container;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultRankingService implements RankingService
{
    protected $rankingRepository;

    public function __construct()
    {
        $container = Container::getInstance();
        $this->rankingRepository = $container->make(RankingRepository::class);
    }

    public function rank($driver_id, $subject_type, $subject_id, $ranking_score)
    {
        try {
            if ($this->rankingRepository->findByDriverAndSubject($driver_id, $subject_type, $subject_id)) {
                throw new AppException(AppException::RECORD_ALREADY_EXISTS, 409);
            }

            $ranking = new Ranking([
                'driver_id' => $driver_id,
                'subject_type' => $subject_type,
                'subject_id' => $subject_id,
                'ranking_score' => $ranking_score,
                'ranked_at' => Carbon::now()
            ]);

            $this->rankingRepository->store($ranking, Ranking::AGGREGATE_ROOT);
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Create ranking failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }

        return $ranking->id;
    }

    public function cancelRank($id)
    {
        try {
            if (!$ranking = $this->rankingRepository->findById($id, Ranking::AGGREGATE_ROOT)) {
                throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
            }

            $this->rankingRepository->deleteRanking($ranking);
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Delete ranking failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getRankingList($subject_type, $subject_id, $timezone)
    {
        try {
            if (!$rankings = $this->rankingRepository->findRankingById($subject_type, $subject_id, $timezone)) {
                throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
            }
            return $rankings;
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Get ranking failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }
}
