<?php

namespace App\Domains\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $connection = 'id_db';
    protected $table="uni_warehouses";
    protected $guarded = ['id'];
    public $timestamps = false;
}
