<?php

namespace App\MasterData\Repositories\impl;

use App\MasterData\Models\Agreement;
use App\MasterData\Repositories\AgreementRepository;

class DefaultAgreementRepository implements AgreementRepository
{
    public function findById($id)
    {
        return Agreement::find($id);
    }

    public function findByTarget($province, $party)
    {
        return Agreement::where(['province' => $province, 'party' => $party, 'status' => 1])->get();
    }
}
