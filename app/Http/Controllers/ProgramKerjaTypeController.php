<?php

namespace App\Http\Controllers;

use App\Models\ProgramKerjaType;
use Illuminate\Http\Request;

class ProgramKerjaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $type = ProgramKerjaType::orderBy('id', 'desc')->get();

        $data = [];
        $data['title'] = 'Sifat Program Kerja';
        $data['list'] = $type;

        return view('admin.type.list', ['data' => $data]);
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
        $value = new ProgramKerjaType();
        $value->name = $request->name;
        $value->save();

        return redirect('admin/type')->with('status', 'Data Berhasil di Simpan');
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
        $value = ProgramKerjaType::whereId($id)->first();
        $value->name = $request->name;
        $value->save();

        return redirect('admin/type')->with('status', 'Data Berhasil di Update');
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
        ProgramKerjaType::whereId($id)->delete();

        return redirect('admin/type')->with('status', 'Data Berhasil Dihapus');
    }
}
