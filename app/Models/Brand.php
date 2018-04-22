<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['code', 'name'];

    public function model() {
       return $this->hasMany('App\Models\CarModel');
    }

    public function cars() {
        return $this->hasManyThrough(Car::class, CarModel::class, 'brand_id', 'model_id', 'id', 'id');
    }

}