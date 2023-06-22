<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $center = Center::join('users', 'users.id', 'centers.user_id')
            ->select('users.*', 'centers.*', 'centers.id as center_id')->orderBy('centers.id', 'desc')->get();

        $data = [];
        $data['title'] = 'Admin';
        $data['list'] = $center;

        return view('admin.center.list', ['data' => $data]);
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
    public function store(Request $request)
    {
        //
        $user = new User();
        $user->email = $request->username . '@gpib.com';
        $user->username = $request->username;
        $user->role = 2;
        $user->password = Hash::make($request->password);
        $user->save();

        $value = new Center();
        $value->user_id = $user->id;
        $value->center_name = $request->center_name;
        $value->center_status = $request->center_status;
        $value->save();

        return redirect('admin/center')->with('status', 'Data Berhasil di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $value = Center::whereId($id)->first();
        $value->department_name = $request->department_name;
        $value->department_status = $request->department_status;
        $value->save();

        $user = User::whereId($value->user_id)->first();
        $user->email = $request->username . '@gpib.com';
        $user->username = $request->username;
        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('admin/center')->with('status', 'Data Berhasil di Simpan');
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
        $center = Center::whereId($id)->first();
        User::whereId($center->user_id)->delete();
        $center->save();

        return redirect('admin/center')->with('status', 'Data Berhasil Dihapus');
    }
}
