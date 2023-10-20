<?php

namespace App\MasterData\Repositories\impl;

use App\MasterData\Repositories\FileInfoRepository;
use App\MasterData\Models\FileInfo;

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
