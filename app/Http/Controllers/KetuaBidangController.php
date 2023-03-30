<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\KetuaBidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KetuaBidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $head = KetuaBidang::join('users', 'users.id', 'ketua_bidang.user_id')
            ->select('users.*', 'ketua_bidang.*', 'ketua_bidang.id as ketua_bidang_id')->orderBy('ketua_bidang.id', 'desc')->get();
        $department = Department::orderBy('department_name', 'asc')->get();
        $data = [];
        $data['title'] = 'Ketua Bidang';
        $data['list'] = $head;
        $data['department'] = $department;

        return view('admin.ketua_bidang.list', ['data' => $data]);
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
        try {
            DB::beginTransaction();

            $user = new User();
            $user->email = $request->username . '@gpib.com';
            $user->username = $request->username;
            $user->role = 5;
            $user->password = Hash::make($request->password);
            $user->save();

            $value = new KetuaBidang();
            $value->user_id = $user->id;
            $value->department_id = $request->department_id;
            $value->name = $request->name;
            $value->active = $request->active;
            $value->save();

            DB::commit();

            return redirect('admin/ketua_bidang')->with('status', 'Data Berhasil di Simpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('admin/ketua_bidang')->with('status', 'Data Gagal di Simpan');
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
        try {
            DB::beginTransaction();

            $check = KetuaBidang::whereId($id)->first();

            $user = User::whereId($check->user_id)->first();
            $user->email = $request->username . '@gpib.com';
            $user->username = $request->username;
            if ($request->password && $request->password != "")
                $user->password = Hash::make($request->password);
            $user->save();

            $value = KetuaBidang::whereId($id)->first();
            $value->user_id = $user->id;
            $value->name = $request->name;
            $value->active = $request->active;
            $value->save();

            DB::commit();

            return redirect('admin/ketua_bidang')->with('status', 'Data Berhasil Diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect('admin/ketua_bidang')->with('status', 'Data Gagal Diubah');
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
        //
        try {
            DB::beginTransaction();

            $value = KetuaBidang::whereId($id)->first();
            User::whereId($value->user_id)->delete();
            $value->delete();

            DB::commit();
            return redirect('admin/ketua_bidang')->with('status', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('admin/ketua_bidang')->with('status', 'Data Gagal Dihapus');
            //throw $th;
        }
    }
}
