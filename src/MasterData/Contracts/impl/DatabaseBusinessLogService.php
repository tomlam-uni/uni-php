<?php

namespace Uni\MasterData\Contracts\impl;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Uni\MasterData\Contracts\BusinessLogService;

class DatabaseBusinessLogService implements BusinessLogService
{

    public function logDriverTrack($params)
    {
        \DB::table('uni_driver_tracklog')->insert([
            'account_id' => $params['account_id'],
            'longitude' => $params['longitude'],
            'latitude' => $params['latitude'],
            'altitude' => $params['altitude'],
            'course' => $params['course'],
            'speed' => $params['speed'],
            'record_time' => Carbon::now()
        ]);
    }

    public function logDriverSession($params) {
        if (!array_key_exists('order_id', $params) || sizeof($params['order_ids']) == 1) {
            \DB::table('uni_driver_sessions')->insert([
                'driver_id' => $params['driver_id'],
                'order_id' => array_key_exists('order_id', $params) ? $params['order_id'] : null,
                'session_id' => $params['session_id'],
                'session_channel' => $params['session_channel'],
                'session_type' => $params['session_type'],
                'provider' => $params['provider'],
                'created_at' => Carbon::now()
            ]);
        } else {
            foreach ($params['order_ids'] as $order_id) {
                \DB::table('uni_driver_sessions')->insert([
                    'driver_id' => $params['driver_id'],
                    'order_id' => $order_id == null ? null : $order_id,
                    'session_id' => $params['session_id'],
                    'session_channel' => $params['session_channel'],
                    'session_type' => $params['session_type'],
                    'provider' => $params['provider'],
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }

    public function logBusinessOperation($params) {
        \DB::table('uni_common_logs')->insert([
            'driver_id' => $params['driver_id'],
            'operator' => $params['operator'],
            'operation_type' => $params['operation_type'],
            'data_type' => $params['data_type'],
            'data' => json_encode($params['param']),
            'created_at' => Carbon::now()
        ]);
    }

    public function driverSessionRetrieval($order_id)
    {
        return DB::table('uni_driver_sessions')
            ->select('order_id', 'driver_id', 'session_channel', 'session_type', 'created_at as session_time')
            ->where('order_id', $order_id)
            ->orderByDesc('created_at')
            ->get();
    }
}
