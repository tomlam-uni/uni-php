<?php

namespace App\Domains\MasterData\Repositories;

interface RankingRepository
{
    public function store($ranking, $sub_enum);
    public function findById($ranking_id, $sub_enum);
    public function findByDriverAndSubject($driver_id, $subject_type, $subject_id);
    public function deleteRanking($ranking);
    public function findRankingById($subject_type, $subject_id);
}
