<?php

namespace App\Domains\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $table = "uni_common_dict";
    protected $guarded = ['id', 'status'];
    public $timestamps = false;

    const ADDRESS_TYPE = 'ADDRESS.TYPE';
    const LANGUAGE_NAME = 'LANGUAGE.NAME';
    const DELIVERY_FAILED_REASON = 'DELIVERY.FAILED.REASON';
}
