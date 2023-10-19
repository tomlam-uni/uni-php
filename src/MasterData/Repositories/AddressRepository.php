<?php

namespace App\Domains\MasterData\Repositories;

interface AddressRepository
{
    public function store($access_code, $sub_enum);
    public function findByAccessCodeId($id);
    public function findByOrderId($order_id, $sub_enum);
}
