<?php

namespace Uni\MasterData\Repositories\impl;

use Uni\MasterData\Models\Region;
use Uni\MasterData\Models\DeliveryArea;
use Uni\MasterData\Models\Warehouse;
use Uni\MasterData\Repositories\RegionRepository;
use Uni\Exceptions\AppException;

class DefaultRegionRepository implements RegionRepository
{
    public function findById($id)
    {
        return Region::find($id);
    }

    public function findByLevel($level)
    {
        return Region::where('level', $level)->orderBy('display_order', 'asc')->get();
    }

    public function findByParent($parent, $level)
    {
        $p = Region::where(['code' => $parent, 'level' => $level - 1])->first();
        if ($p == null)
            throw new AppException(AppException::MASTERDATA_REGION_INVALID, 400);
        return Region::where(['parent' => $p->id, 'level' => $level])->orderBy('display_order', 'asc')->get();
    }

    public function findDeliveryAreasByRegion($region)
    {
        $r = Region::where('code', $region)->first();
        if ($r == null)
            throw new AppException(AppException::MASTERDATA_REGION_INVALID, 400);
        return DeliveryArea::where('region_id', $r->id)->orderBy('display_order', 'asc')->get();
    }

    public function findWarehousesByProvinceCode($province_code)
    {
        return Warehouse::where(['belong_province' => $province_code, 'visible_to_driver' => 1])->orderBy('id', 'asc')->get();
    }

    public function findDeliveryAreasByWarehouse($warehouse_id)
    {
        return DeliveryArea::where('warehouse_id', $warehouse_id)->orderBy('display_order', 'asc')->get();
    }

    public function findDeliveryAreaById($id)
    {
        return DeliveryArea::find($id);
    }

    public function findWarehouseById($id)
    {
        return Warehouse::find($id);
    }

    public function findRegionByCode($code, $level)
    {
        return Region::where(['code' => $code, 'level' => $level])->first();
    }
}
