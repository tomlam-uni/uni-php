<?php

namespace App\MasterData\Repositories;

interface DictionaryRepository
{
    public function findDictItemsByType($type);
}
