<?php

namespace App\Http\Controllers;

use App\Models\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Swap\Laravel\Facades\Swap;

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
        $data['otherCurrency'] = implode(",", $request->otherCurrency);
        if (substr($data['otherCurrency'], 0, 1) == ',') {
            $data['otherCurrency'] = substr($data['otherCurrency'], 1);
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
        $data = $request->all();
        if(isset($data['otherCurrency'])) {
            $data['otherCurrency'] = implode(",", $request->otherCurrency);
            if (substr($data['otherCurrency'], 0, 1) == ',') {
                $data['otherCurrency'] = substr($data['otherCurrency'], 1);
            }
        }

        Options::findOrFail($id)->update($data);

        Session::flash('msg', Lang::get('admin/options.msgUpdated'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
