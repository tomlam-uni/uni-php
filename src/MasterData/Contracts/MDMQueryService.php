<?php

namespace App\Domains\MasterData\Contracts;

interface MDMQueryService
{
    public function getRegionById($id);
    public function getRegionByCode($code, $level);
    public function getCountries();
    public function getProvincesByCountryCode($country_code);
    public function getCitiesByProvinceCode($province_code);
    public function getDeliveryAreasByProvinceCode($province_code);
    public function getWarehousesByProvinceCode($province_code);
    public function getDeliveryAreasByWarehouseId($warehouse_id);
    public function getDeliveryAreaById($id);
    public function getVehicleTypes();
    public function getAgreementById($id);
    public function getAgreementsForDriver($province);
    public function getDictionary($type);
    public function getMessageTemplateById($id);
    public function getMessageTemplatesByWarehouseId($warehouse_id);
    public function getDefaultMessageTemplates();
    public function getMessageTemplatesByConditions($warehouse_id, $language);
    public function getDefaultMessageTemplatesByLanguage($language);
    public function getWarehouseById($id);
    public function getLatestVersionByConditions($product_type, $os_type, $region);
    public function getTopOneAccessCodesByOrderId($order_id);
    public function createAddressAccessCode($driver_id, $order_id, $access_code, $comment);
    public function rankAccessCode($id);
}
