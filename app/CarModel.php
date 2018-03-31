<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'car_models';

    protected $fillable = ['brand_id','mode_code', 'model', 'type'];

    public function brand() {
       return $this->hasOne('App\Brand', 'id', 'brand_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function car() {
        return $this->hasMany('App\Car', 'model_id');
    }

    public function getTypeAttribute() {
        if($this->attributes['type']==1) {                 $result = 'samochod';
        }elseif($this->attributes['type']==2) {            $result = 'Motocykl';
        }elseif($this->attributes['type']==3) {            $result = 'Rower';
        }elseif($this->attributes['type']==4) {            $result = 'Maszyna rolnicza';
        }elseif($this->attributes['type']==5) {            $result = 'Inne';
        }else {                                $result = 'inne';
        }

        return $result;
    }
}
