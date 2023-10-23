<?php

namespace Uni\MasterData\Models;

use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    protected $table = "uni_common_access_codes";
    protected $guarded = ['id'];
    public $timestamps = false;
    const DEFAULT_RANKING_SCORE = 0;

    public function rank()
    {
        $this->ranking_score += 1;
    }
}
