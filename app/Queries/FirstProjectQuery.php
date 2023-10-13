<?php

namespace App\Queries;

use Illuminate\Support\Facades\Log;

class FirstProjectQuery
{
    public static function testFunction()
    {
        Log::info('this is from github');
    }
}
