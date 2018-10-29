<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Swap\Laravel\Facades\Swap;


class Rates extends Model
{
    protected $fillable = ['pair', 'rate'];

    /**
     * @param $pair
     * Function, which trying to download current currency rates based on SWAP service.
     * If is there no result, it will try 2 another times to catch result, after that result will be null.
     * @return null or rate value
     */
    public function getRatesOnline($pair) {
        for($try = 0; $try < 3; $try++) {
            try {
                $rate = Swap::latest($pair)->getValue();
                break;
            } catch (\Exception $e) {
                $rate = null;
            }
        }
    return $rate;
    }

    /**
     * @param $pair1
     * @param $pair2
     * Getting last value or rate from database
     * @return null or value or value of rate
     */
    public function getLastRate($pair1, $pair2){
        if(Rates::where('pair', $pair1 . '/' . $pair2)->first()) {
            $result = Rates::where('pair', $pair1 . '/' . $pair2)->orderBy('id', 'DESC')->first()->rate;
        } else {
            $result = null;
        }
        return $result;
    }

    /**
     * Function which generate a collection of setted currencies by user in settings.
     * @return \Illuminate\Support\Collection
     */
    public static function getCurrencyList() {
        $otherCurrencies = explode(",", Options::get()->first()->otherCurrency);
        $currencies = collect([['currency'=>Options::get()->first()->defaultCurrency]]);
        for($j=0; $j<count($otherCurrencies); $j++) {
            $currencies->push(['currency'=>$otherCurrencies[$j]]);
        }
        return $currencies;
    }
}
