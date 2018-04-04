<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['code', 'name'];

    public function model() {
       return $this->hasMany('App\CarModel');
    }

    public function cars() {
        return $this->hasManyThrough(Car::class, CarModel::class, 'brand_id', 'model_id', 'id', 'id');
    }


}