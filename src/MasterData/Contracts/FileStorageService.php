<?php

namespace App\MasterData\Contracts;

interface FileStorageService
{
    public function createFileInfo($provider, $store_path, $filename, $keywords='', $summary='');
    public function getFile($id);
}
