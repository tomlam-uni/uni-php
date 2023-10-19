<?php

namespace App\Domains\MasterData\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Address extends Model
{
    const AGGREGATE_ROOT = 'Address';
    const AGGREGATE_ALL = 'All';
    const AGGREGATE_SUB_RANK = 'Rank';
    const AGGREGATE_SUB_ACCESS_CODE = 'AccessCode';
    const AGGREGATE_SUB_INFO = 'Info';


    protected $address;
    protected $longitude;
    protected $latitude;

    protected $access_codes = [];

    public function __construct($address = null, $longitude = null, $latitude = null)
    {
        parent::__construct();

        $address != null ? $this->address = $address : $this->address = null;
        $latitude != null ? $this->latitude = $latitude : $this->latitude = null;
        $longitude != null ? $this->longitude = $longitude : $this->longitude = null;
    }

    public function createAccessCode($driver_id, $access_code = null, $comment = null) {
        $ac = new AccessCode([
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'address' => $this->address,
            'access_code' => $access_code,
            'comment' => $comment,
            'driver_id' => $driver_id,
            'score' => AccessCode::DEFAULT_RANKING_SCORE,
            'created_at' => Carbon::now()
        ]);

        $this->access_codes[] = $ac;
    }

    public function getAccessCodes()
    {
        return $this->access_codes;
    }

    public function _addAccessCode($access_code)
    {
        $this->access_codes[] = $access_code;
    }
}
