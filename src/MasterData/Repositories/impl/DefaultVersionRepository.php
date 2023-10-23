<?php

namespace Uni\MasterData\Repositories\impl;

use Uni\MasterData\Models\Version;
use Uni\MasterData\Repositories\VersionRepository;

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
