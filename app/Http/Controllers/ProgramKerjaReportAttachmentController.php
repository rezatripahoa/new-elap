<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Head;
use App\Models\ProgramKerja;
use App\Models\ProgramKerjaReportAttachment;
use App\Models\YearCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProgramKerjaReportAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $auth = Auth::user();
        $url_base = 'program_kerja_attachment';
        if ($auth->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
        } elseif ($auth->role == 3) {
            $url_base = 'department/' . $url_base;
        }

        try {
            DB::beginTransaction();
            if ($request->hasFile('file')) {
                $allowedfileExtension = ['jpg', 'jpeg', 'png', 'webp'];

                $files = $request->file('file');
                $proker_id = $request->program_kerja;
                $names = $request->name;
                $description = $request->description;
                $category = $request->category;

                $program_kerja = ProgramKerjaReportAttachment::where('program_kerja_id', $proker_id)->get();
                foreach ($program_kerja as $item) {
                    File::delete('assets/images/attachments/' . $proker_id . '/' . $item->file);
                }
                ProgramKerjaReportAttachment::where('program_kerja_id', $proker_id)->delete();
                foreach ($names as $key => $name) {
                    if (isset($files[$key]) && $files[$key]) {
                        $file = $files[$key];
                        $code = Str::random(24);
                        $imagename = "";
                        $imagename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);
                        if ($check) {
                            $imagename = $code . "." . $extension;
                            $path = public_path() . $imagename;
                            $move = $file->move('assets/images/attachments/' . $proker_id, $imagename);
                        } else {
                            return redirect($url_base . '/' . $proker_id)->with('status', 'Gagal Upload Gambar');
                        }
                    } else {
                        $file_old = $request->file_old;
                        $imagename = $file_old[$key] ?? "";
                    }
                    $db = new ProgramKerjaReportAttachment();
                    $db->program_kerja_id = $proker_id;
                    $db->name = $name;
                    $db->category = $category;
                    $db->description = $description[$key];
                    $db->file = $imagename;
                    $db->save();
                }
            }

            DB::commit();
            return redirect($url_base . '/' . $proker_id)->with('status', 'Data Berhasil di Simpan');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
            return redirect($url_base . '/' . $proker_id)->with('status', 'Data Gagal di Simpan');
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
        $auth = Auth::user();
        $data = [];

        if ($auth->role == 4) {
            $head = Head::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } else {
            $department = Department::where('user_id', $auth->id)->first();
        }

        $program_kerja = ProgramKerja::with('attachment')->whereId($id)->orderBy('id', 'desc')->first();

        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['program_kerja'] = $program_kerja;

        return view('user.program_kerja.attachment', ['data' => $data]);
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
}
