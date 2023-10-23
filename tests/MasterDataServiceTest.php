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
    public function testGetRegionById()
    {
        $warehouse_id = 1;

        $result = $this->mdmQueryService->getRegionById($warehouse_id);

        $this->assertEquals('Canada', $result['name']);
    }

    /**
     * getRegionByCode test.
     *
     * @return void
     */
    public function testGetRegionByCode()
    {
        $test_data = [
            'code' => 'BC',
            'level' => 1
        ];

        $result = $this->mdmQueryService->getRegionByCode($test_data['code'], $test_data['level']);

        $this->assertEquals($test_data['code'], $result['code']);
    }

    /**
     * GetCountries test.
     *
     * @return void
     */
    public function testGetCountries()
    {
        $result = $this->mdmQueryService->getCountries();

        $this->assertEquals('CA', $result[0]['code']);
    }

    /**
     * getProvincesByCountryCode test.
     *
     * @return void
     */
    public function testGetProvincesByCountryCode()
    {
        $country_code = 'CA';

        $result = $this->mdmQueryService->getProvincesByCountryCode($country_code);

        $this->assertCount(9, $result);
    }

    /**
     * getCitiesByProvinceCode test.
     *
     * @return void
     */
    public function testGetCitiesByProvinceCode()
    {
        $province_code = 'BC';

        $result = $this->mdmQueryService->getCitiesByProvinceCode($province_code);

        $this->assertCount(0, $result);
    }

    /**
     * getDeliveryAreasByProvinceCode test.
     *
     * @return void
     */
    public function testGetDeliveryAreasByProvinceCode()
    {
        $province_code = 'BC';

        $result = $this->mdmQueryService->getDeliveryAreasByProvinceCode($province_code);

        $this->assertCount(23, $result);
    }

    /**
     * getWarehousesByProvinceCode test.
     *
     * @return void
     */
    public function testGetWarehousesByProvinceCode()
    {
        $province_code = 'BC';

        $result = $this->mdmQueryService->getWarehousesByProvinceCode($province_code);

        $this->assertCount(5, $result);
    }

    /**
     * getDeliveryAreasByWarehouseId test.
     *
     * @return void
     */
    public function testGetDeliveryAreasByWarehouseId()
    {
        $warehouse_id = 1;

        $result = $this->mdmQueryService->getDeliveryAreasByWarehouseId($warehouse_id);

        $this->assertCount(16, $result);
    }

    /**
     * getDeliveryAreaById test.
     *
     * @return void
     */
    public function testGetDeliveryAreaById()
    {
        $delivery_area_id = 1;

        $result = $this->mdmQueryService->getDeliveryAreaById($delivery_area_id);

        $this->assertEquals('North/West Vancouver', $result['name']);
    }

    /**
     * getVehicleTypes test.
     *
     * @return void
     */
    public function testGetVehicleTypes()
    {
        $result = $this->mdmQueryService->getVehicleTypes();

        $this->assertCount(9, $result);
    }

    /**
     * getAgreementById test.
     *
     * @return void
     */
    public function testGetAgreementById()
    {
        $agreement_id = 1;

        $result = $this->mdmQueryService->getAgreementById($agreement_id);

        $this->assertEquals($agreement_id, $result['id']);
    }

    /**
     * getAgreementsForDriver test.
     *
     * @return void
     */
    public function testGetAgreementsForDriver()
    {
        $province_code = 'BC';

        $result = $this->mdmQueryService->getAgreementsForDriver($province_code);

        $this->assertCount(1, $result);
    }

    /**
     * getDictionary test.
     *
     * @return void
     */
    public function testGetDictionary()
    {
        $test_type = 'APPLICATION.STATUS';

        $result = $this->mdmQueryService->getDictionary($test_type);

        $this->assertCount(5, $result);
    }

    /**
     * getMessageTemplateById test.
     *
     * @return void
     */
    public function testGetMessageTemplateById()
    {
        $id = 1;

        $result = $this->mdmQueryService->getMessageTemplateById($id);

        $this->assertEquals($id, $result['id']);
    }

    /**
     * getMessageTemplatesByWarehouseId test.
     *
     * @return void
     */
    public function testGetMessageTemplatesByWarehouseId()
    {
        $warehouse_id = 5;

        $result = $this->mdmQueryService->getMessageTemplatesByWarehouseId($warehouse_id);

        $this->assertCount(6, $result);
    }

    /**
     * getDefaultMessageTemplates test.
     *
     * @return void
     */
    public function testGetDefaultMessageTemplates()
    {
        $result = $this->mdmQueryService->getDefaultMessageTemplates();

        $this->assertCount(12, $result);
    }

    /**
     * getMessageTemplatesByConditions test.
     *
     * @return void
     */
    public function testGetMessageTemplatesByConditions()
    {
        $test_data = [
            'warehouse_id' => 5,
            'language' => 'fr-ca'
        ];

        $result = $this->mdmQueryService->getMessageTemplatesByConditions($test_data['warehouse_id'], $test_data['language']);

        $this->assertCount(6, $result);
    }

    /**
     * getDefaultMessageTemplatesByLanguage test.
     *
     * @return void
     */
    public function testGetDefaultMessageTemplatesByLanguage()
    {
        $language = 'fr-ca';

        $result = $this->mdmQueryService->getDefaultMessageTemplatesByLanguage($language);

        $this->assertCount(6, $result);
    }

    /**
     * getWarehouseById test.
     *
     * @return void
     */
    public function testGetWarehouseById()
    {
        $id = 1;

        $result = $this->mdmQueryService->getWarehouseById($id);

        $this->assertEquals($id, $result['id']);
    }

    /**
     * getLatestVersionByConditions test.
     *
     * @return void
     */
    public function testGetLatestVersionByConditions()
    {
        $test_data = [
            'product_type' => 'driver_app',
            'os_type' => 'ios',
            'region' => 'CA'
        ];

        $result = $this->mdmQueryService->getLatestVersionByConditions($test_data['product_type'], $test_data['os_type'], $test_data['region']);

        $this->assertNotNull($result);
    }

//    /**
//     * getTopOneAccessCodesByOrderId test.
//     *
//     * @return void
//     */
//    public function testGetTopOneAccessCodesByOrderId()
//    {
//        $order_id = 38275513;
//
//        $result = $this->mdmQueryService->getTopOneAccessCodesByOrderId($order_id);
//
//        Log::info($result);
//
//        $this->assertNotNull($result);
//    }
//
//    /**
//     * getMessageTemplateById test.
//     *
//     * @return void
//     */
//    public function testGetMessageTemplateById()
//    {
//        $id = 1;
//
//        $result = $this->mdmQueryService->getMessageTemplateById($id);
//
//        $this->assertEquals($id, $result['id']);
//    }

//    /**
//     * rankAccessCode test.
//     *
//     * @return void
//     */
//    public function testRankAccessCode()
//    {
//        $rank_id = 1;
//
//        $original_score = DB::table('uni_common_access_codes')->select('score')->where('id', $rank_id)->get()->toArray();
//
//        $this->mdmQueryService->rankAccessCode($rank_id);
//
//        $expected_score = DB::table('uni_common_access_codes')->select('score')->where('id', $rank_id)->get()->toArray();
//
//        $this->assertEquals($original_score['score'] + 1, $expected_score['score']);
//    }
}
