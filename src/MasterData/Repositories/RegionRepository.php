<?php

namespace App\Domains\MasterData\Repositories;

interface RegionRepository
{
    public function findById($id);
    public function findByLevel($level);
    public function findByParent($parent, $level);
    public function findDeliveryAreasByRegion($region);
    public function findWarehousesByProvinceCode($province_code);
    public function findDeliveryAreasByWarehouse($warehouse_id);
    public function findDeliveryAreaById($id);
    public function findWarehouseById($id);
    public function findRegionByCode($code, $level);
}
