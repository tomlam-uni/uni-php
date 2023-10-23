<?php

namespace Uni\MasterData\Repositories\impl;

use Uni\MasterData\Repositories\FileInfoRepository;
use Uni\MasterData\Models\FileInfo;

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
