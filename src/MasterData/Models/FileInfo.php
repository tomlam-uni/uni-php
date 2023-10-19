<?php

namespace App\Domains\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class FileInfo extends Model
{
    protected $table="uni_common_files";
    protected $guarded = ['id', 'upload_time'];
    public $timestamps = false;
}
