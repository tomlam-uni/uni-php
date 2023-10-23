<?php

namespace Uni\MasterData\Repositories;

interface VersionRepository
{
    public function findLatestVersionByConditions($product_type, $os_type, $region);
}
