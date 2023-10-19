<?php

namespace App\Domains\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $table="uni_common_versions";
    protected $guarded = ['id', 'status'];
    public $timestamps = false;

    const PRODUCT_BUILT = 0;
    const PRODUCT_REVIEWED = 1;
    const PRODUCT_RELEASED = 2;
    const PRODUCT_REMOVED = 9;
}
