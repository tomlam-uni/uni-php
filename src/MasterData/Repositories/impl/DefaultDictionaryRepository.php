<?php

namespace App\MasterData\Repositories\impl;

use App\MasterData\Models\Dictionary;
use App\MasterData\Repositories\DictionaryRepository;

class DefaultDictionaryRepository implements DictionaryRepository
{
    public function findDictItemsByType($type)
    {
        return Dictionary::where('type', $type)->orderBy('display_order','asc')->get();
    }
}
