<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{

    protected $fillable = ['driver_id', 'plates', 'transport', 'transport_date', 'type', 'extra'];

    public function car() {
        return $this->hasMany('App\Models\Car');
    }

    public function model() {
        return $this->belongsTo('App\Models\CarModel');
    }

    public function brand() {
        return $this->belongsTo('App\Models\Brand');
    }

    public function driver(){
        return $this->belongsTo('App\Models\Driver');
    }

    public static function takeId($string) {
        $id = explode('#', $string);
        $id = explode(' ', $id[1]);
        $result = $id[0];

        return $result;
    }
}
