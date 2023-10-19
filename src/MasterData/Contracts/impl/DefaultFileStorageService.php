<?php

namespace App\Domains\MasterData\Contracts\impl;

use App\Domains\MasterData\Models\FileInfo;
use App\Domains\MasterData\Repositories\FileInfoRepository;
use App\Exceptions\AppException;
use Illuminate\Container\Container;
use App\Domains\MasterData\Contracts\FileStorageService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DefaultFileStorageService implements FileStorageService
{
    protected $fileInfoRepository;

    public function __construct()
    {
        $container = Container::getInstance();
        $this->fileInfoRepository = $container->make(FileInfoRepository::class);
    }

    public function createFileInfo($provider, $store_path, $filename, $keywords = '', $summary = '')
    {
        try {
            $file = new FileInfo([
                'file_name' => $filename,
                'store_path' => $store_path,
                'storage_provider' => $provider,
                'keywords' => $keywords,
                'summary' => $summary
            ]);
            $file->upload_time = Carbon::now();

            $this->fileInfoRepository->store($file);
            return $file->id;
        } catch (\Exception $e) {
            Log::error('Create file info failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getFile($id)
    {
        try {
            $file = $this->fileInfoRepository->findById($id);
            if ($file != null)
                return $file->toArray();
            else
                throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
        } catch (AppException $e) {
            Log::error('Query file info failed, Caused by: ' . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query file info failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }
}
