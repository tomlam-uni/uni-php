<?php

namespace App\TestProject\Contracts\impl;

use App\TestProject\Contracts\TestService;
use App\TestProject\Repositories\TestRepository;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Log;

class DefaultTestService implements TestService
{
    protected $testRepository;

    public function __construct() {
        $container = Container::getInstance();
        $this->testRepository = $container->make(TestRepository::class);
    }
    public function testServiceProvider() {
        Log::info('testing ddd');
    }

    public function testRepository()
    {
        $this->testRepository->testRepo();
    }
}
