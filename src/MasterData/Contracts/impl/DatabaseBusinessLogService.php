<?php

namespace impl;

use BusinessLogService;
use Illuminate\Support\Facades\Log;

class DatabaseBusinessLogService implements BusinessLogService
{
    public function testSrc() {
        Log::info('first src');
    }
}
