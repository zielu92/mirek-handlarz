<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{

    protected $fillable = ['driver_id', 'plates', 'transport', 'transport_date', 'type', 'extra'];

    public function car() {
        return $this->hasMany('App\Car');
    }

    public function model() {
        return $this->belongsTo('App\CarModel');
    }

    public function brand() {
        return $this->belongsTo('App\Brand');
    }

    public function driver(){
        return $this->belongsTo('App\Driver');
    }

    public static function takeId($string) {
        $id = explode('#', $string);
        $id = explode(' ', $id[1]);
        $result = $id[0];

        return $result;
    }
}
