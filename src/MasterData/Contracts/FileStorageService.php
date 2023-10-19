<?php

namespace App\Domains\MasterData\Contracts;

interface FileStorageService
{
    public function createFileInfo($provider, $store_path, $filename, $keywords='', $summary='');
    public function getFile($id);
}
