<?php

namespace Uni\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = "uni_common_ranking";
    protected $guarded = ['id'];
    public $timestamps = false;

    const AGGREGATE_ROOT = 'Ranking';

    const SUBJECT_TYPE_RANKING = 1;
}
