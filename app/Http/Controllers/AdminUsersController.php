<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserStoreRequired;
use App\Models\Photo;
use App\Models\User;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.users.index', [
            'users' => User::paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(UserStoreRequired $request)
    {
        $photo = new Photo();
        if(trim($request->password) == ''){
            $data = $request->except('password');
        } else
        {
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo')){
            $data['photo_id'] = $photo->photoUpload($request->file('photo'), 'user_', '0');
        }

        User::create($data);

        Session::flash('msg', Lang::get('admin/users.userHasBeenAdded'));

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $photo = new Photo();

        $user = User::findOrFail($id);

        if(trim($request->password) == ''){
            $data = $request->except('password');
        } else
        {
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
        }

        if($file = $request->file('photo')){
            $data['photo_id'] = $photo->photoUpload($request->file('photo'), 'user_', '0');
        }

        $user->update($data);

        Session::flash('returnMsg', Lang::get('admin/users.userHasBeenUpdated'));

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user  = User::findOrFail($id);

        $user->delete();

        Session::flash('msg', Lang::get('admin/users.userHasBeenDeleted'));

        return redirect('/admin/users');
    }
}