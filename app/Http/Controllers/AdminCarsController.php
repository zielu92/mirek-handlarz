<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Customer;
use App\Http\Requests\CarStoreRequest;
use App\Models\Photo;
use App\Models\Options;
use App\Models\Rates;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class AdminCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cars.index',['cars'=>Car::paginate(25)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cars.create', [
            'brands'=> Brand::pluck('name', 'id')->all(),
            'currencies' => Rates::getCurrencyList()->pluck('currency', 'currency')->all(),
        ]);
    }

    /**
     * Showing model list by brand id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function modelList($id)
    {
        $carmodels = CarModel::where('brand_id', '=', $id)->get();
        foreach ($carmodels as $carmodel) {
            $output[] = ["id" => $carmodel->id, "model" => $carmodel->model];
        }
        return json_encode($output);

    }

    /**
     * autocomplete to find customers in customer field
     * @return mixed
     */
    public function autocomplete(){
        $term = trim(Input::get('term'));

        $results = array();
   
        $queries = DB::table('customers')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => '#'.$query->id.' '.$query->name];
        }
        return Response::json($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarStoreRequest $request)
    {
        $data = $request->all();
        if(!empty($request->customer_id)) {
            if (str_contains($request->customer_id, '#')) {
                $data['customer_id'] = Car::takeId($request->customer_id);
            } else {
                $customer['name'] = $data['customer_id'];
                $data['customer_id'] = Customer::create($customer)->id;
            }
        }
          $lastId = Car::create($data)->id;

        Session::flash('msg', Lang::get('admin/cars.addedRecord'));
        if($request->pics) {
            return redirect('admin/createCar/'.$lastId);
        }
        else {
            return redirect('admin/cars');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);
        $transportIn = Transport::where('transport', 'LIKE', '%'.$id.'%')->where('type', '=', '1')
            ->where('transport_date', '=', $car->in_warehouse_date)->get();
        $transportOut = Transport::where('transport', 'LIKE', '%'.$id.'%')->where('type', '=', '2')
            ->where('transport_date', '=', $car->left_warehouse_date)->get();

        return view('admin.cars.show', [
            'car' => $car,
            'pictures' => Photo::whereCar_id($id)->get(),
            'transportIn' => $transportIn,
            'transportOut' => $transportOut
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.cars.edit', [
            'car'=>Car::findOrFail($id),
            'brands'=> Brand::pluck('name', 'id')->all(),
            'pictures' => Photo::whereCar_id($id)->get(),
            'currencies' => Rates::getCurrencyList()->pluck('currency', 'currency')->all(),
        ]);
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
        $car = Car::findOrFail($id);

        $data = $request->all();
        if (!empty($request->customer_id)) {
            if (str_contains($request->customer_id, '#')) {
                $customerId = explode('#', $request->customer_id);
                $customerId = explode(' ', $customerId[1]);
                $data['customer_id'] = $customerId[0];
            } else {
                $customer['name'] = $data['customer_id'];
                $data['customer_id'] = Customer::create($customer)->id;
            }

            $car->update($data);
            if($request->pics) {
                return redirect('admin/createCar/'.$id);
            }
            else {
                return redirect('admin/cars');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::destroy($id);
        Session::flash('msg', Lang::get('admin/cars.deleteRecord'));
        return redirect('admin/cars/');
    }

}
