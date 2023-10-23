<?php

namespace Uni\Tests;

use Illuminate\Container\Container;
use Uni\MasterData\Contracts\FileStorageService;
use Uni\MasterData\Contracts\MDMQueryService;
use Uni\MasterData\Contracts\RankingService;

class MasterDataServiceTest extends TestCase
{
    protected $verificationService;
    protected $mdmQueryService;
    protected $rankingService;
    protected $fileStorageService;
    protected $proxyService;
    protected $miscService;

    public function setUp(): void
    {
        parent::setUp();
        $container = Container::getInstance();
        $this->mdmQueryService = $container->make(MDMQueryService::class);
        $this->fileStorageService = $container->make(FileStorageService::class);
        $this->rankingService = $container->make(RankingService::class);
    }

    /**
     * getRegionById test.
     *
     * @return void
     */
//    public function testGetRegionById()
//    {
//        $warehouse_id = 1;
//
//        $result =
//
//            $this->assertGreaterThan(0, $result);
//    }
}
