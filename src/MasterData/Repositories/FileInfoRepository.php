<?php

namespace App\Domains\MasterData\Repositories;

interface FileInfoRepository
{
    public function store($fileInfo);
    public function findById($id);
}
