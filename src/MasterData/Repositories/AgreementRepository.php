<?php

namespace App\Domains\MasterData\Repositories;

interface AgreementRepository
{
    public function findById($id);
    public function findByTarget($province, $party);
}
