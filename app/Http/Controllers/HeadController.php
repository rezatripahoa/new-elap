<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Head;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $head = Head::join('users', 'users.id', 'heads.user_id')
            ->select('users.*', 'heads.*', 'heads.id as heads_id')->orderBy('heads.id', 'desc')->get();
        $department = Department::orderBy('department_name', 'asc')->get();

        $data = [];
        $data['title'] = 'Ketua Departemen';
        $data['list'] = $head;
        $data['department'] = $department;

        return view('admin.head.list', ['data' => $data]);
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
        $user->role = 4;
        $user->password = Hash::make($request->password);
        $user->save();

        $value = new Head();
        $value->user_id = $user->id;
        $value->department_id = $request->department_id;
        $value->head_name = $request->head_name;
        $value->head_status = $request->head_status;
        $value->save();

        return redirect('admin/head')->with('status', 'Data Berhasil di Simpan');
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
            $check = Head::whereId($id)->first();

            DB::beginTransaction();
            $user = User::whereId($check->user_id)->first();
            $user->email = $request->username . '@gpib.com';
            $user->username = $request->username;
            if ($user->password && $user->password != "") {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $value = Head::whereId($id)->first();
            $value->department_id = $request->department_id;
            $value->head_name = $request->head_name;
            $value->head_status = $request->head_status;
            $value->save();
            DB::commit();

            return redirect('admin/head')->with('status', 'Data Berhasil di Simpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('admin/head')->with('status', 'Data Gagal di Update');
            //throw $th;
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
        $value = Head::whereId($id)->first();
        User::whereId($value->user_id)->delete();
        $value->delete();

        return redirect('admin/head')->with('status', 'Data Berhasil Dihapus');
    }
}
