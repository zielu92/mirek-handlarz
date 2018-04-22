<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use App\Http\Requests\TransportStoreRequest;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class AdminTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transports.index', [
            'transports' => Transport::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransportStoreRequest $request)
    {
        $data = $request->all();

        if(!empty($request->driver_id)) {
            if (str_contains($request->driver_id, '#')) {
                $data['driver_id'] = Car::takeId($request->driver_id);
            } else {
                $driver['name'] = $data['driver_id'];
                $data['driver_id'] = Driver::create($driver)->id;
            }
        }

        foreach ($request->transport as $transport) {
            $cars[] = Transport::takeId($transport);
        }
        $data['transport'] = implode(",",$cars);

        $carsUp = Car::findOrFail($cars);
        foreach ($carsUp as $carUp) {
            if($request->type == 1) {
                $carUp->in_warehouse_date = $data['transport_date'];
            } else {
                $carUp->left_warehouse_date = $data['transport_date'];
            }
            $carUp->save();
        }

        Transport::create($data);
        Session::flash('msg', 'Dodano nowy transport');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transport = Transport::findOrFail($id);

        $carsId['id'] = explode(",",$transport['transport']);
        $cars = Car::findOrFail($carsId['id']);

        return view('admin.transports.show', compact('cars', 'transport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function findCar() {
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('cars')
            ->where('vin', 'LIKE', '%'.$term.'%')
            ->orwhere('id', 'LIKE', '%'.$term.'%')
            ->orwhere('bought_date', 'LIKE', '%'.$term.'%')
            ->take(25)->get()->sortByDesc('id');

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

    public function findDriver() {
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('drivers')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->orwhere('company', 'LIKE', '%'.$term.'%')
            ->take(6)->get();

        foreach ($queries as $query)
        {
            $results[] = [
                'id' => $query->id,
                'value' => '#'.$query->id.' '.$query->name.'('.$query->company.')'
            ];
        }
        return Response::json($results);
    }
}
