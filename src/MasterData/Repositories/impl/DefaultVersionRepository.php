<?php

namespace App\Domains\MasterData\Repositories\impl;

use App\Domains\MasterData\Models\Version;
use App\Domains\MasterData\Repositories\VersionRepository;

class DefaultVersionRepository implements VersionRepository
{
    public function findLatestVersionByConditions($product_type, $os_type, $region)
    {
        return Version::where([
            'product_type' => $product_type,
            'os_type' => $os_type,
            'region' => $region,
            'status' => Version::PRODUCT_RELEASED
        ])
            ->orderBy('major_version', 'DESC')
            ->orderBy('minor_version','DESC')
            ->orderBy('patch_version', 'DESC')
            ->first();
    }
}
