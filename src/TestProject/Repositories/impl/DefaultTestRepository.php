<?php

namespace App\TestProject\Repositories\impl;

use App\TestProject\Repositories\TestRepository;
use Illuminate\Support\Facades\Log;

class DefaultTestRepository implements TestRepository
{
    public function testRepo() {
        Log::info('testing repo');
    }
}
