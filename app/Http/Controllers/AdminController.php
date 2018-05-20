<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Car;
use App\Models\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index()
    {
        //stats for cards
        $date = new Carbon();
        $date->subWeek();
        $carsBought = Car::where('bought_date', '>', $date->toDateTimeString())->get()->count();
        $carsSold = Car::where('sold_date', '>', $date->toDateTimeString())->get()->count();
        $notSold = Car::where('bought_date','>',$date->toDateTimeString())->whereNull('sold_date')->get()->count();
        $transports = Transport::where('created_at', '>', $date->toDateTimeString())->get()->count();

        $mustCheck = Car::where('bought_date','<',$date->toDateTimeString())->whereNull('sold_date')->get();

        // generate date for buy/sell chart
        $cars = Car::where('created_at', '>', $date->toDateTimeString())->get();
        $dates = Admin::getXDaysDate(7, 'Y-m-d');
        foreach ($dates as $date) {
            $soldBought[] = [
                'date' => date("d", strtotime($date)),
                'sold' => $cars->where('sold_date', '=', $date)->count(),
                'bought' => $cars->where('bought_date', '=', $date)->count()];
        }

        //generate date for status car chart
        $status1 = 0;
        $status2 = 0;
        $status3 = 0;
        $status4 = 0;
        $status5 = 0;
        $status6 = Car::limit(100)->where('bought_date','<',Carbon::now()->subDays(30)->toDateTimeString())
            ->whereNull('sold_date')->get()->sortByDesc('id')->count();

        foreach (Car::limit(100)->get()->sortByDesc('id') as $carStat) {

            if(isset($carStat->bought_date) && !isset($carStat->in_warehouse_date) && !isset($carStat->sold_date)
                && !isset($carStat->left_warehouse_date)){
                $status1 = $status1 + 1;
            }
            if(isset($carStat->bought_date) && isset($carStat->in_warehouse_date) && !isset($carStat->sold_date)
                && !isset($carStat->left_warehouse_date)){
                $status2 = $status2 + 1;
            }
            if(isset($carStat->bought_date) && isset($carStat->in_warehouse_date) && isset($carStat->sold_date)
                && !isset($carStat->left_warehouse_date)){
                $status3 = $status3 + 1;
            }
            if(isset($carStat->bought_date) && !isset($carStat->in_warehouse_date) && isset($carStat->sold_date)
                && !isset($carStat->left_warehouse_date)){
                $status4 = $status4 + 1;
            }
            if(isset($carStat->bought_date) && isset($carStat->in_warehouse_date) && isset($carStat->sold_date)
                && isset($carStat->left_warehouse_date)){
                $status5 = $status5 + 1;
            }
        }
        $status = ['status1' => $status1, 'status2' => $status2, 'status3' => $status3,
            'status4' => $status4, 'status5' => $status5, 'status6' => $status6];

        // cars older than and never sold
        $carsNeverSold = Car::limit(35)->where('bought_date','<',Carbon::now()->subDays(30)->toDateTimeString())
            ->where(function ($query) {
                $query->whereNull('sold_date')->orWhereNull('in_warehouse_date');
                })->get();

        return view('admin.index', compact('soldBought', 'status', 'transports', 'carsBought',
            'carsSold', 'notSold', 'carsNeverSold'));
    }

    public function search(){
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('cars')
            ->where('vin', 'LIKE', '%'.$term.'%')
            ->orwhere('id', 'LIKE', '%'.$term.'%')
            ->orwhere('bought_date', 'LIKE', '%'.$term.'%')
            ->take(10)->get();

        foreach ($queries as $query)
        {
            $car = Car::find($query->id);
            $results[] = [
                'id' => $query->id,
                'value' => '#'.$query->id.' '.$car->model->brand->name.' '.$car->model->model.' ('.$query->vin.')'
            ];
        }
        return Response::json($results);
    }

    public function about() {
        return view('admin.about');
    }

    public function find(Request $request)
    {
        $term = $request->search;


        $CustomersResult = Admin::searchResults('customers', $term, '/admin/customer/',
            Lang::get('search.typeCustomer').':');
        $BrandsResults = Admin::searchResults('brands', $term, '/admin/brand/',
            Lang::get('search.typeModel').':');
        $Carsresults = [];
        $queries = DB::table('cars')
            ->where('vin', 'LIKE', '%'.$term.'%')
            ->orwhere('id', 'LIKE', '%'.$term.'%')
            ->orwhere('bought_date', 'LIKE', '%'.$term.'%')
            ->take(10)->get()->sortByDesc('id');

        foreach ($queries as $query)
        {
            $car = Car::find($query->id);
            $Carsresults[] = [
                'link' => '/admin/car/'.$query->id,
                'id' => $query->id,
                'value' => Lang::get('search.typCar').': #'.$query->id.' '.$car->model->brand->name.' 
                '.$car->model->model.' ('.$query->vin.')'
            ];
        }

        $results = array_merge($CustomersResult, $BrandsResults, $Carsresults);

        $articles =  $results;

        return view('admin.searchResults', compact('articles', 'query'));
    }

    public function autocomplete(){
        $term = trim(Input::get('term'));

        $CustomersResult = Admin::searchResults('customers', $term, '/admin/customer/',
            Lang::get('search.typeCustomer').':');
        $BrandsResults = Admin::searchResults('brands', $term, '/admin/brand/',
            Lang::get('search.typeModel').':');
        $Carsresults = [];
        $queries = DB::table('cars')
            ->where('vin', 'LIKE', '%'.$term.'%')
            ->orwhere('id', 'LIKE', '%'.$term.'%')
            ->orwhere('bought_date', 'LIKE', '%'.$term.'%')
            ->take(10)->get()->sortByDesc('id');

        foreach ($queries as $query)
        {
            $car = Car::find($query->id);
            $Carsresults[] = [
                'link' => '/admin/car/'.$query->id,
                'id' => $query->id,
                'value' => Lang::get('search.typeCar').': #'.$query->id.' '.$car->model->brand->name.' '.$car->model->model.' ('.$query->vin.')'
            ];
        }

        $results = array_merge($CustomersResult, $BrandsResults, $Carsresults);

        return  json_encode($results);
    }
}
