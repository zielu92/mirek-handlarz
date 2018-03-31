<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public static function getXDaysDate($days, $format = 'd/m'){
        $m = date("m"); $de= date("d"); $y= date("Y");
        $dateArray = array();
        for($i=0; $i<=$days-1; $i++){
            $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y));
        }
        return array_reverse($dateArray);
    }
}
