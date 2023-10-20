<?php

namespace App\MasterData\Repositories;

interface AgreementRepository
{
    public function findById($id);
    public function findByTarget($province, $party);
}
