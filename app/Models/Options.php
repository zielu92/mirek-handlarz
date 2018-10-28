<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected  $fillable = ['defaultCurrency', 'otherCurrency', 'ratesOnline', 'defaultLanguage'];

    public static function currencyList() {

        include(app_path() . '/Services/Currency/list.php');

        return $currency = getCurrencyList();
    }
}
