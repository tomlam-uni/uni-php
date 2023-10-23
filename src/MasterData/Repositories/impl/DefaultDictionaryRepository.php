<?php

namespace Uni\MasterData\Repositories\impl;

use Uni\MasterData\Models\Dictionary;
use Uni\MasterData\Repositories\DictionaryRepository;

class DefaultDictionaryRepository implements DictionaryRepository
{
    public function findDictItemsByType($type)
    {
        return Dictionary::where('type', $type)->orderBy('display_order','asc')->get();
    }
}
