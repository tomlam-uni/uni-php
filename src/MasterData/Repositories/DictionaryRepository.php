<?php

namespace App\Domains\MasterData\Repositories;

interface DictionaryRepository
{
    public function findDictItemsByType($type);
}
