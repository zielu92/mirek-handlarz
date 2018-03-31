<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['code', 'name'];

    public function model() {
       return $this->hasMany('App\CarModel');
    }

    public function car() {
        return $this->hasMany('App\Car');
    }

}