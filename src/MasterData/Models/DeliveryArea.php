<?php

namespace Uni\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    protected $table="uni_common_delivery_areas";
    protected $guarded = ['id', 'region_id'];
    public $timestamps = false;
}
