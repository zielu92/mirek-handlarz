<?php

namespace App\Console\Commands;

use App\Models\Options;
use App\Models\Rates;
use Illuminate\Console\Command;


class CurrencyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency rates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (Options::isRatesOnline()) {
            $currency = new Rates();
            if (Options::all()) {
                $otherCurrencies = Options::get()->first()->otherCurrency;
                $otherCurrencies = explode(",", $otherCurrencies);
                $mainCurrency = Options::select('defaultCurrency')->get()->pluck('defaultCurrency');
                //If there are options about another curriences it creates a array which hold all rates and last value
                if ($otherCurrencies[0] != null) {
                    for ($j = 0; $j < count($otherCurrencies); $j++) {

                        $data['pair'] = $mainCurrency[0] . '/' . $otherCurrencies[$j];
                        $data['rate'] = $currency->getRatesOnline($mainCurrency[0] . '/' . $otherCurrencies[$j]);
                        $data['rate'] != null ? Rates::create($data) : null;
                        $data['pair'] = $otherCurrencies[$j] . '/' . $mainCurrency[0];
                        $data['rate'] = $currency->getRatesOnline($otherCurrencies[$j] . '/' . $mainCurrency[0]);
                        $data['rate'] != null ? Rates::create($data) : null;
                        //loop for more pairs
                        for ($i = 0; $i <= count($otherCurrencies) - $j - 1; $i++) {
                            if ($otherCurrencies[$j] != $otherCurrencies[$j + $i]) {

                                $data['pair'] = $otherCurrencies[$j] . '/' . $otherCurrencies[$j + $i];
                                $data['rate'] = $currency->getRatesOnline($otherCurrencies[$j] . '/' . $otherCurrencies[$j + $i]);
                                $data['rate'] != null ? Rates::create($data) : null;
                                $data['pair'] = $otherCurrencies[$j + $i] . '/' . $otherCurrencies[$j];
                                $data['rate'] = $currency->getRatesOnline($otherCurrencies[$j + $i] . '/' . $otherCurrencies[$j]);
                                $data['rate'] != null ? Rates::create($data) : null;
                            }
                        }
                    }
                }
            }
        }
    }

}
