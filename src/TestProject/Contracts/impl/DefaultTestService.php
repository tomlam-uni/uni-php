<?php

namespace App\TestProject\Contracts\impl;

use App\TestProject\Contracts\TestService;
use Illuminate\Support\Facades\Log;

class DefaultTestService implements TestService
{
    public function testServiceProvider() {
        Log::info('testing ddd');
    }
}
