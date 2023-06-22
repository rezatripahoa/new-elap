<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $commission = Commission::orderBy('id', 'desc')->get();

        $data = [];
        $data['title'] = 'Penopang Program (PP)';
        $data['list'] = $commission;

        return view('admin.commission.list', ['data' => $data]);
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
        $value = new Commission();
        $value->name = $request->name;
        $value->code = $request->code;
        $value->jenis = $request->jenis;
        $value->save();

        return redirect('admin/commission')->with('status', 'Data Berhasil di Simpan');
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
        $value = Commission::whereId($id)->first();
        $value->name = $request->name;
        $value->code = $request->code;
        $value->jenis = $request->jenis;
        $value->save();

        return redirect('admin/commission')->with('status', 'Data Berhasil di Update');
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
        Commission::whereId($id)->delete();

        return redirect('admin/commission')->with('status', 'Data Berhasil Dihapus');
    }
}
