<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['name', 'company', 'phone', 'extra'];

    public function transport() {
        return $this->hasMany('App\Transport');
    }
}
