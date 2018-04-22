<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use App\Http\Requests\BrandModelReqest;
use Illuminate\Http\Request;

class AdminModelBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brands.index', [
            'brands' => Brand::orderBy('name', 'asc')->get(),
            'brand' => Brand::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandModelReqest $request)
    {
        $data = $request->all();

        if(!empty($request->name)) {
           $brandData['code'] = strtoupper($request->name);
           $brandData['name'] = $request->name;
           $data['brand_id'] = Brand::create($brandData)->id;
        }
        CarModel::create($data);

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
        return view('admin.brands.show',[
            'models'=>CarModel::whereBrand_id($id)->get(),
            'brand'=>Brand::whereId($id)->first()
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
        return view('admin.brands.edit', [
            'model' => CarModel::findOrFail($id),
            'brand' => Brand::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandModelReqest $request, $id)
    {
        $data = $request->all();
        $model = CarModel::findOrFail($id);
        if(!empty($request->name)) {
            $brandData['code'] = strtoupper($request->name);
            $brandData['name'] = $request->name;
            $data['brand_id'] = Brand::create($brandData)->id;
        }
        $model->update($data);

        return redirect('admin/brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CarModel::destroy($id);
        return redirect('admin/brand');
    }
}
