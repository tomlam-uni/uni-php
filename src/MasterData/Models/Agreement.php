<?php

namespace App\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $table="uni_common_agreements";
    protected $guarded = ['id', 'status'];
    public $timestamps = false;
}
