<?php

namespace App\Domains\MasterData\Repositories\impl;

use App\Domains\MasterData\Models\Dictionary;
use App\Domains\MasterData\Repositories\DictionaryRepository;

class DefaultDictionaryRepository implements DictionaryRepository
{
    public function findDictItemsByType($type)
    {
        return Dictionary::where('type', $type)->orderBy('display_order','asc')->get();
    }
}
