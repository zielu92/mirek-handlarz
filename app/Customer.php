<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'extra'
    ];

    public function car() {
      return $this->hasMany('App\Car');
    }

    public function model() {
        return $this->belongsTo('App\CarModel');
    }

    public function brand() {
        return $this->belongsTo('App\Brand');
    }

    public function profit($bought, $sold) {
        if(!empty($sold) && !empty($bought)) {
            return $sold - $bought;
        }
        return 0.00;
    }

}
