<?php

namespace Uni\MasterData\Repositories;

interface DictionaryRepository
{
    public function findDictItemsByType($type);
}
