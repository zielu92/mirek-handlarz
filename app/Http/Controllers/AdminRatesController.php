<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatesStoreRequest;
use App\Models\Options;
use App\Models\Rates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Swap\Laravel\Facades\Swap;

class AdminRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = new Rates();
        $currencyRates = [];
        if (Options::all()) {
            $otherCurrencies = Options::get()->first()->otherCurrency;
            $otherCurrencies = explode(",", $otherCurrencies);
            $mainCurrency = Options::select('defaultCurrency')->get()->pluck('defaultCurrency');
            //If there are options about another curriences it creates a array which hold all rates and last value
            if($otherCurrencies[0] != null) {
                for($j=0; $j<count($otherCurrencies); $j++) {
                    $currencyRates[] = ['pair'=>$mainCurrency[0] . '/' . $otherCurrencies[$j],
                        'lastRate'=> $currency->getLastRate($mainCurrency[0], $otherCurrencies[$j]) ];
                    $currencyRates[] = ['pair'=>$otherCurrencies[$j] . '/' . $mainCurrency[0],
                        'lastRate'=> $currency->getLastRate($otherCurrencies[$j], $mainCurrency[0]) ];
                    //loop for more pairs
                    for($i=0; $i<=count($otherCurrencies)-$j-1; $i++) {
                        if($otherCurrencies[$j] != $otherCurrencies[$j+$i]) {
                            $currencyRates[] = ['pair'=>$otherCurrencies[$j] . '/' . $otherCurrencies[$j + $i],
                                'lastRate' => $currency->getLastRate($otherCurrencies[$j],$otherCurrencies[$j + $i])];
                            $currencyRates[] = ['pair'=>$otherCurrencies[$j + $i] . '/' . $otherCurrencies[$j],
                                'lastRate' => $currency->getLastRate($otherCurrencies[$j + $i],$otherCurrencies[$j])];
                        }
                    }
                }
            }
        }
        return view('admin.rates.index', ['rates'=>$currencyRates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->rate as $key=>$value) {
            $data['pair'] = $key;
            $data['rate'] = $value;
            //checking if number contain , and replace it by ., to decimal format.
            if(strpos($data['rate'], ",")) {
                $data['rate'] = str_replace(',', '.', $data['rate']);
            }
            if($value!=null && is_numeric($data['rate'])) {
                Rates::create($data);
            }
        }

        Session::flash('msg', Lang::get('admin/options.msgSaved'));
        return redirect()->back();
    }

    /**
     * @param $pair
     * Controller for ajax, which is based on getRatesOnline function.
     * It will return page with result for current currency.
     * @return null or current rate
     */
    public function getRate($pair)
    {
        $rate = new Rates();
        $afterFix = str_replace('_', '/',$pair);
        return $rate->getRatesOnline($afterFix);
    }
}
