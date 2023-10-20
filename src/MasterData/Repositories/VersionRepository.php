<?php

namespace App\MasterData\Repositories;

interface VersionRepository
{
    public function findLatestVersionByConditions($product_type, $os_type, $region);
}
