<?php

namespace App\Domains\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table="uni_common_regions";
    protected $guarded = ['id', 'status'];
    public $timestamps = false;

    const LEVEL_COUNTRY = 0;
    const LEVEL_PROVINCE = 1;
    const LEVEL_CITY = 2;
}
