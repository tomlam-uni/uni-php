<?php

namespace Uni\MasterData\Repositories;

interface MessageTemplateRepository
{
    public function findById($id);
    public function findByWarehouseId($warehouse_id);
    public function findByConditions($warehouse_id, $language);
}
