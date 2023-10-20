<?php

namespace App\MasterData\Contracts;

interface BusinessLogService
{
    public function logDriverTrack($params);
    public function logDriverSession($params);
    public function logBusinessOperation($params);
    public function driverSessionRetrieval($order_id);
}
