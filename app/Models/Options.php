<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected  $fillable = [
        'name', 'photo_id', 'email', 'phone1', 'address',
        'defaultCurrency', 'otherCurrency', 'ratesOnline', 'defaultLanguage', 'multiLanguage'];

    /**
     * getting currency list
     * @return \Illuminate\Support\Collection
     */
    public static function currencyList() {

        include(app_path() . '/Services/Currency/list.php');

        return $currency = getCurrencyList();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo() {
        return $this->belongsTo('App\Models\Photo');
    }

    /**
     * Checking if page supports multilanguage or not
     * @return bool
     */
    public static function isMultiLanguage() {
        $lastSettings = Options::all() ? Options::all()->last() : null;
        return $lastSettings->multiLanguage==1 ? true : false;
    }

    /**
     * Getting name of page
     * @return mixed
     */
    public static function getPageName() {
        $lastSettings = Options::all() ? Options::all()->last() : null;
        return $lastSettings ? $lastSettings->name : env('APP_NAME', 'Mirek Handlarz');
    }
}
