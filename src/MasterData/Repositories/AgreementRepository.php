<?php

namespace Uni\MasterData\Repositories;

interface AgreementRepository
{
    public function findById($id);
    public function findByTarget($province, $party);
}
