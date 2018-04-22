<?php

namespace App\Models;

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
      return $this->hasMany('App\Models\Car');
    }

    public function model() {
        return $this->belongsTo('App\Models\CarModel');
    }

    public function brand() {
        return $this->belongsTo('App\Models\Brand');
    }

    public function profit($bought, $sold) {
        if(!empty($sold) && !empty($bought)) {
            return $sold - $bought;
        }
        return 0.00;
    }

}
