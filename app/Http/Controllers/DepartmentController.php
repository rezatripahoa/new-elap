<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $department = Department::join('users', 'users.id', 'departments.user_id')
            ->select('users.*', 'departments.*', 'departments.id as department_id')->orderBy('departments.id', 'desc')->get();

        $data = [];
        $data['title'] = 'Pusat, Mupel, dan Jemaat';
        $data['list'] = $department;

        return view('admin.department.list', ['data' => $data]);
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
        $user->role = 3;
        $user->password = Hash::make($request->password);
        $user->save();

        $value = new Department();
        $value->user_id = $user->id;
        $value->department_name = $request->department_name;
        $value->department_status = $request->department_status;
        $value->jenis = $request->jenis;
        $value->save();

        return redirect('admin/department')->with('status', 'Data Berhasil di Simpan');
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
        $value = Department::whereId($id)->first();
        $value->department_name = $request->department_name;
        $value->department_status = $request->department_status;
        $value->jenis = $request->jenis;
        $value->save();

        $user = User::whereId($value->user_id)->first();
        $user->email = $request->username . '@gpib.com';
        $user->username = $request->username;
        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('admin/department')->with('status', 'Data Berhasil di Simpan');
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
        $value = Department::whereId($id)->first();
        User::whereId($value->user_id)->delete();
        $value->delete();

        return redirect('admin/department')->with('status', 'Data Berhasil Dihapus');
    }
}
