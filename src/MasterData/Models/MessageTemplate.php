<?php

namespace App\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    protected $connection = 'id_db';
    protected $table="uni_sms_template";
    protected $guarded = ['id', 'is_enabled'];
    public $timestamps = false;

    const DEFAULT_WAREHOUSE = 0;
    const DEFAULT_LANGUAGE = 'en-ca';
}
