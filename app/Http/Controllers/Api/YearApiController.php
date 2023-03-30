<?php

namespace App\Http\Controllers\Api;

use App\Models\YearCategory;
use Illuminate\Http\Request;

class YearApiController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $data = YearCategory::orderBy('id', 'desc')->get();
            if ($data) {
                return $this->sendResponse($data, "Berhasil Menampilkan Data");
            } else {
                return $this->sendError("Gagal Menampilkan Data", ['error' => "Gagal"]);
            }
        } catch (\Exception $e) {
            return $this->sendError("Gagal Menampilkan Data", ['error' => $e->getMessage()]);
        }
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
            $db = new YearCategory();
            $db->year_name = $request->year_name;
            $db->year_status = $request->year_status;
            $db->save();

            if ($db) {
                return $this->sendResponse($db, "Berhasil Menyimpan Data");
            } else {
                return $this->sendError("Gagal Menyimpan Data", ['error' => "Gagal"]);
            }
        } catch (\Exception $e) {
            return $this->sendError("Gagal Menyimpan Data", ['error' => $e->getMessage()]);
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
            $db = YearCategory::whereId($id)->first();
            $db->year_name = $request->year_name;
            $db->year_status = $request->year_status;
            $db->save();

            if ($db) {
                return $this->sendResponse($db, "Berhasil Mengubah Data");
            } else {
                return $this->sendError("Gagal Mengubah Data", ['error' => "Gagal"]);
            }
        } catch (\Exception $e) {
            return $this->sendError("Gagal Mengubah Data", ['error' => $e->getMessage()]);
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
            $data = YearCategory::whereId($id)->delete();
            if ($data) {
                return $this->sendResponse($data, "Berhasil Menghapus Data");
            } else {
                return $this->sendError("Gagal Menghapus Data", ['error' => "Gagal"]);
            }
        } catch (\Exception $e) {
            return $this->sendError("Gagal Menghapus Data", ['error' => $e->getMessage()]);
        }
    }
}
