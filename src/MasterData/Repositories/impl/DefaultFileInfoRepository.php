<?php

namespace App\Domains\MasterData\Repositories\impl;

use App\Domains\MasterData\Repositories\FileInfoRepository;
use App\Domains\MasterData\Models\FileInfo;

class DefaultFileInfoRepository implements FileInfoRepository
{
    public function store($fileInfo)
    {
        $fileInfo->save();
    }

    public function findById($id)
    {
        return FileInfo::find($id);
    }
}
