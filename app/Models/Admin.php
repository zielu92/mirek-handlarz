<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function searchResults($table, $term, $link, $type) {

        $queries = DB::table($table)
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [
                'link' => $link.$query->id,
                'id' => $query->id,
                'value' => $type.' '.$query->name
            ];
        }

        return isset($results) ? $results : [];
    }
}
