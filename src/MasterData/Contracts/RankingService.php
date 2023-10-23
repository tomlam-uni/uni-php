<?php

namespace Uni\MasterData\Contracts;

interface RankingService
{
    public function rank($driver_id, $subject_type, $subject_id, $ranking_score);
    public function cancelRank($id);
    public function getRankingList($subject_type, $subject_id, $timezone);
}
