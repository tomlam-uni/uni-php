<?php

namespace App\Queries;

use Illuminate\Support\Facades\Log;

class FirstProjectQuery
{
    public static function testFunction()
    {
        Log::info('this is second-branch from github version 2.0.0');
    }
}
