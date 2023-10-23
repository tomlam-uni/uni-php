<?php

namespace Uni\MasterData\Repositories\impl;

use Uni\MasterData\Models\MessageTemplate;
use Uni\MasterData\Repositories\MessageTemplateRepository;

class DefaultMessageTemplateRepository implements MessageTemplateRepository
{
    public function findById($id)
    {
        return MessageTemplate::find($id);
    }

    public function findByWarehouseId($warehouse_id)
    {
        return MessageTemplate::where(['city_id' => $warehouse_id, 'is_enabled' => 1, 'app_showing' => 1])->get();
    }

    public function findByConditions($warehouse_id, $language)
    {
        return MessageTemplate::where(['city_id' => $warehouse_id, 'language' => $language, 'is_enabled' => 1, 'app_showing' => 1])->orderBy('type')->get();
    }
}
