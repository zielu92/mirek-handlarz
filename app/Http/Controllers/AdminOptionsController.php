<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class AdminOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency =  Options::currencyList()->pluck('name', 'code')->all();

        $lastSettings = Options::all() ? Options::all()->last() : null;
        return view('admin.options.index', [
            'currencies' => $currency,
            'lastSettings' => $lastSettings,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = new Photo();

        $data['otherCurrency'] = implode(",", $request->otherCurrency);
        if (substr($data['otherCurrency'], 0, 1) == ',') {
            $data['otherCurrency'] = substr($data['otherCurrency'], 1);
        }

        if($file = $request->file('logo')){
            $data['photo_id'] = $photo->photoUpload($request->file('logo'), 'logo_', '0');
        }

        if($request->defaultLanguage != ''){
            App::setLocale($request->defaultLanguage);
        }

        Options::create($data);

        Session::flash('msg', Lang::get('admin/options.msgUpdated'));

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = new Photo();
        $data = $request->all();
        if(isset($data['otherCurrency'])) {
            $data['otherCurrency'] = implode(",", $request->otherCurrency);
            if (substr($data['otherCurrency'], 0, 1) == ',') {
                $data['otherCurrency'] = substr($data['otherCurrency'], 1);
            }
        }

        if($file = $request->file('logo')){
            $data['photo_id'] = $photo->photoUpload($request->file('logo'), 'logo_', '0');
        }

        if($request->defaultLanguage != ''){
            app()->setLocale($request->defaultLanguage);
            Carbon::setLocale($request->defaultLanguage);
            if(!Session::has('locale')) {
                Session::put('locale', Config::get('app.locale'));
            }else{
                Session::put('locale', Config::get('app.locale'));
            }
        }

        Options::findOrFail($id)->update($data);

        Session::flash('msg', Lang::get('admin/options.msgUpdated'));
        return redirect()->back();
    }

}
