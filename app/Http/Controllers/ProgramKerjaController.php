<?php

namespace App\Http\Controllers;

use App\Imports\ProgramKerjaImport;
use App\Models\Category;
use App\Models\Commission;
use App\Models\Department;
use App\Models\Head;
use App\Models\ProgramKerja;
use App\Models\ProgramKerjaCategory;
use App\Models\ProgramKerjaCommission;
use App\Models\ProgramKerjaType;
use App\Models\YearCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ProgramKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $year_query = "";
        if ($request->get('year')) {
            $year_query = YearCategory::where('year_name', $request->get('year'))->first();
        }

        $program_kerja = ProgramKerja::with('year')->orderBy('id', 'desc')
            ->where('departement_id', $department->id)
            ->when($year_query != "", function ($q) use ($year_query) {
                $q->where('year_id', $year_query->id);
            })
            ->get();

        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $data['page'] = "RPKA";
        $data['list'] = $program_kerja;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['department'] = $department;


        return view('user.program_kerja.index', ['data' => $data]);
    }

    public function program_kerja_acc(Request $request)
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

        $program_kerja = ProgramKerja::with('year')->orderBy('id', 'desc')
            ->where('departement_id', $department->id)
            ->where('acc', 1)->get();
        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $data['page'] = "PKA";
        $data['list'] = $program_kerja;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['department'] = $department;


        return view('user.program_kerja.acc', ['data' => $data]);
    }

    public function program_kerja_realisasi(Request $request)
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
        
        $year_query = "";
        if ($request->get('year')) {
            $year_query = YearCategory::where('year_name', $request->get('year'))->first();
        }

        $program_kerja = ProgramKerja::with('year')->orderBy('id', 'desc')
            ->where('departement_id', $department->id)
             ->when($year_query != "", function ($q) use ($year_query) {
                $q->where('year_id', $year_query->id);
            })
            ->where('acc', 1)->get();
        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $data['page'] = "Realisasi PKA";
        $data['list'] = $program_kerja;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['department'] = $department;


        return view('user.program_kerja.realisasi', ['data' => $data]);
    }

    public function program_kerja_acc_admin($id, Request $request)
    {
        //
        $data = [];

        $department = Department::whereId($id)->first();
        $program_kerja = ProgramKerja::with('year')->orderBy('id', 'desc')
            ->where('departement_id', $department->id)
            ->where('acc', 1)->get();
        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $data['page'] = "PKA";
        $data['list'] = $program_kerja;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['department'] = $department;


        return view('admin.program_kerja.acc', ['data' => $data]);
    }

    public function program_kerja_acc_submit($id)
    {
        //
        $auth = Auth::user();
        $url_base = 'program_kerja';
        if ($auth->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
        } elseif ($auth->role == 3) {
            $url_base = 'department/' . $url_base;
        }

        $value = ProgramKerja::whereId($id)->first();
        if ($value->acc == 0) {
            $value->acc = 1;
        } else {
            $value->acc = 0;
        }
        $value->save();

        if ($value->acc == 1) {
            return redirect($url_base)->with('status', 'Data Berhasil di ACC');
        }
        return redirect($url_base)->with('status', 'ACC Berhasil di Dibatalkan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $year = YearCategory::orderBy('year_name', 'asc')->get();
        $list_department = Department::orderBy('department_name', 'asc')
            ->when($department->jenis, function ($q) use ($department) {
                $q->where('jenis', $department->jenis);
            })
            ->get();
        $commission = Commission::orderBy('name', 'asc')
            ->when($department->jenis, function ($q) use ($department) {
                $q->where('jenis', $department->jenis);
            })
            ->get();
        $type = ProgramKerjaType::orderBy('name', 'asc')->get();
        $category = Category::orderBy('category_name', 'asc')->get();

        $data['page'] = "RPKA";
        $data['year'] = $year;
        $data['department'] = $department;
        $data['list_department'] = $list_department;
        $data['commission'] = $commission;
        $data['category'] = $category;
        $data['type'] = $type;

        return view('user.program_kerja.create', ['data' => $data]);
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
        $url_base = 'program_kerja';
        if ($auth->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
        } elseif ($auth->role == 3) {
            $url_base = 'department/' . $url_base;
        }
        try {
            DB::beginTransaction();

            if ($auth->role == 4) {
                $head = Head::where('user_id', $auth->id)->first();
                $department = Department::whereId($head->department_id)->first();
            } else {
                $department = Department::where('user_id', $auth->id)->first();
            }

            $value = new ProgramKerja();
            $value->departement_id = $department->id;
            $value->year_id = $request->year_id;
            $value->type_id = $request->type_id;
            $value->pjp_id = $request->pjp_id;
            $value->name = $request->name;
            $value->tujuan = $request->tujuan;
            $value->lokasi = $request->lokasi;
            $value->rencana_penerimaan = str_replace(',', '', $request->rencana_penerimaan == "" ? 0 :  $request->rencana_penerimaan);
            $value->rencana_pengeluaran = str_replace(',', '', $request->rencana_pengeluaran == "" ? 0 :  $request->rencana_pengeluaran);
            $value->realisasi_penerimaan =  str_replace(',', '', $request->realisasi_penerimaan == "" ? 0 :  $request->realisasi_penerimaan);
            $value->realisasi_pengeluaran = str_replace(',', '', $request->realisasi_pengeluaran == "" ? 0 :  $request->realisasi_pengeluaran);
            $value->inscope = $request->inscope;
            $value->outscope = $request->outscope;
            $value->indikator_kuantitatif = $request->indikator_kuantitatif;
            $value->indikator_kualitatif = $request->indikator_kualitatif;
            $value->realisasi_kuantitatif = $request->realisasi_kuantitatif;
            $value->realisasi_kualitatif = $request->realisasi_kualitatif;
            $value->evaluasi = $request->evaluasi;
            $value->frekuensi = $request->frekuensi;
            $value->peserta = $request->peserta;
            // $value->waktu = $request->waktu;
            $value->waktu = "";
            $value->jadwal_end = $request->jadwal_end;
            $value->jadwal_start = $request->jadwal_start;
            $value->tindak_lanjut = $request->tindak_lanjut;
            $value->keterangan = $request->keterangan;
            $value->created_user = $auth->id;
            $value->updated_user = $auth->id;
            $value->save();

            $category = $request->category;
            foreach ($category as $item) {
                $pkc = new ProgramKerjaCategory();
                $pkc->program_kerja_id = $value->id;
                $pkc->category_id = $item;
                $pkc->save();
            }

            $pp = $request->pp ?? [];
            foreach ($pp as $item) {
                $pkpp = new ProgramKerjaCommission();
                $pkpp->program_kerja_id = $value->id;
                $pkpp->commission_id     = $item;
                $pkpp->save();
            }

            DB::commit();

            return redirect($url_base)->with('status', 'Data Berhasil di Simpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect($url_base)->with('status', 'Data Gagal di Simpan');
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

        $list = ProgramKerja::with('category', 'pp')->whereId($id)->first();
        $year = YearCategory::orderBy('year_name', 'asc')->get();
        $list_department = Department::orderBy('department_name', 'asc')
            ->when($department->jenis, function ($q) use ($department) {
                $q->where('jenis', $department->jenis);
            })
            ->get();
        $commission = Commission::orderBy('name', 'asc')
            ->when($department->jenis, function ($q) use ($department) {
                $q->where('jenis', $department->jenis);
            })
            ->get();
        // $list_department = Department::orderBy('department_name', 'asc')->get();
        // $commission = Commission::orderBy('name', 'asc')->get();
        $type = ProgramKerjaType::orderBy('name', 'asc')->get();
        $category = Category::orderBy('category_name', 'asc')->get();

        $category_program = [];
        foreach ($list->category as $item) {
            array_push($category_program, $item->category_id);
        }

        $pp_program = [];
        foreach ($list->pp as $item) {
            array_push($pp_program, $item->commission_id);
        }

        $data['year'] = $year;
        $data['department'] = $department;
        $data['list_department'] = $list_department;
        $data['commission'] = $commission;
        $data['category'] = $category;
        $data['category_program'] = $category_program;
        $data['pp_program'] = $pp_program;
        $data['type'] = $type;
        $data['list'] = $list;
        $data['program_kerja_id'] = $id;

        if ($auth->role != 2) {
            return view('user.program_kerja.detail', ['data' => $data]);
        } else {
            return view('admin.program_kerja.detail', ['data' => $data]);
        }
    }

    public function show_realisasi($id)
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

        $list = ProgramKerja::with('category', 'pp')->whereId($id)->first();
        $year = YearCategory::orderBy('year_name', 'asc')->get();
        $list_department = Department::orderBy('department_name', 'asc')
            ->when($department->jenis, function ($q) use ($department) {
                $q->where('jenis', $department->jenis);
            })
            ->get();
        $commission = Commission::orderBy('name', 'asc')->get();
        $type = ProgramKerjaType::orderBy('name', 'asc')->get();
        $category = Category::orderBy('category_name', 'asc')->get();

        $category_program = [];
        foreach ($list->category as $item) {
            array_push($category_program, $item->category_id);
        }

        $pp_program = [];
        foreach ($list->pp as $item) {
            array_push($pp_program, $item->commission_id);
        }

        $data['year'] = $year;
        $data['department'] = $department;
        $data['list_department'] = $list_department;
        $data['commission'] = $commission;
        $data['category'] = $category;
        $data['category_program'] = $category_program;
        $data['pp_program'] = $pp_program;
        $data['type'] = $type;
        $data['list'] = $list;
        $data['program_kerja_id'] = $id;

        if ($auth->role != 2) {
            return view('user.program_kerja.detail_realisasi', ['data' => $data]);
        } else {
            return view('admin.program_kerja.detail_realisasi', ['data' => $data]);
        }
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
        $auth = Auth::user();
        $url_base = 'program_kerja';
        if ($auth->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
        } elseif ($auth->role == 3) {
            $url_base = 'department/' . $url_base;
        }

        try {
            DB::beginTransaction();

            if ($auth->role == 4) {
                $head = Head::where('user_id', $auth->id)->first();
                $department = Department::whereId($head->department_id)->first();
            } else {
                $department = Department::where('user_id', $auth->id)->first();
            }

            $value = ProgramKerja::whereId($id)->first();
            $value->departement_id = $department->id;
            $value->year_id = $request->year_id;
            $value->type_id = $request->type_id;
            $value->pjp_id = $request->pjp_id;
            $value->name = $request->name;
            $value->tujuan = $request->tujuan;
            $value->lokasi = $request->lokasi;
            $value->rencana_penerimaan = str_replace(',', '', $request->rencana_penerimaan == "" ? 0 :  $request->rencana_penerimaan);
            $value->rencana_pengeluaran = str_replace(',', '', $request->rencana_pengeluaran == "" ? 0 :  $request->rencana_pengeluaran);
            $value->realisasi_penerimaan =  str_replace(',', '', $request->realisasi_penerimaan == "" ? 0 :  $request->realisasi_penerimaan);
            $value->realisasi_pengeluaran = str_replace(',', '', $request->realisasi_pengeluaran == "" ? 0 :  $request->realisasi_pengeluaran);
            $value->inscope = $request->inscope;
            $value->outscope = $request->outscope;
            $value->indikator_kuantitatif = $request->indikator_kuantitatif;
            $value->indikator_kualitatif = $request->indikator_kualitatif;
            $value->realisasi_kuantitatif = $request->realisasi_kuantitatif;
            $value->realisasi_kualitatif = $request->realisasi_kualitatif;
            $value->evaluasi = $request->evaluasi;
            $value->frekuensi = $request->frekuensi;
            $value->peserta = $request->peserta;
            // $value->waktu = $request->waktu;
            $value->waktu = "";
            $value->jadwal_end = $request->jadwal_end;
            $value->jadwal_start = $request->jadwal_start;
            $value->tindak_lanjut = $request->tindak_lanjut;
            $value->keterangan = $request->keterangan;
            $value->updated_user = $auth->id;
            $value->save();

            $category = $request->category;
            ProgramKerjaCategory::where('program_kerja_id', $value->id)->delete();

            if (!$category) {
                return redirect($url_base)->with('Kategori Harus Dipilih');
            }
            foreach ($category as $item) {
                $pkc = new ProgramKerjaCategory();
                $pkc->program_kerja_id = $value->id;
                $pkc->category_id = $item;
                $pkc->save();
            }

            $pp = $request->pp ?? [];
            ProgramKerjaCommission::where('program_kerja_id', $value->id)->delete();
            foreach ($pp as $item) {
                $pkpp = new ProgramKerjaCommission();
                $pkpp->program_kerja_id = $value->id;
                $pkpp->commission_id     = $item;
                $pkpp->save();
            }

            DB::commit();

            return redirect($url_base)->with('status', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect($url_base)->with('status', 'Data Gagal Disimpan');
        }
    }

    public function program_kerja_realisasi_update(Request $request, $id)
    {
        //
        $auth = Auth::user();
        $url_base = 'program_kerja_realisasi';
        if ($auth->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
        } elseif ($auth->role == 3) {
            $url_base = 'department/' . $url_base;
        }

        try {
            DB::beginTransaction();

            if ($auth->role == 4) {
                $head = Head::where('user_id', $auth->id)->first();
                $department = Department::whereId($head->department_id)->first();
            } else {
                $department = Department::where('user_id', $auth->id)->first();
            }

            $value = ProgramKerja::whereId($id)->first();
            $value->departement_id = $department->id;
            $value->year_id = $request->year_id;
            $value->type_id = $request->type_id;
            $value->pjp_id = $request->pjp_id;
            $value->name = $request->name;
            $value->tujuan = $request->tujuan;
            $value->lokasi = $request->lokasi;
            $value->rencana_penerimaan = str_replace(',', '', $request->rencana_penerimaan == "" ? 0 :  $request->rencana_penerimaan);
            $value->rencana_pengeluaran = str_replace(',', '', $request->rencana_pengeluaran == "" ? 0 :  $request->rencana_pengeluaran);
            $value->realisasi_penerimaan =  str_replace(',', '', $request->realisasi_penerimaan == "" ? 0 :  $request->realisasi_penerimaan);
            $value->realisasi_pengeluaran = str_replace(',', '', $request->realisasi_pengeluaran == "" ? 0 :  $request->realisasi_pengeluaran);
            $value->inscope = $request->inscope;
            $value->outscope = $request->outscope;
            $value->indikator_kuantitatif = $request->indikator_kuantitatif;
            $value->indikator_kualitatif = $request->indikator_kualitatif;
            $value->realisasi_kuantitatif = $request->realisasi_kuantitatif;
            $value->realisasi_kualitatif = $request->realisasi_kualitatif;
            $value->evaluasi = $request->evaluasi;
            $value->frekuensi = $request->frekuensi;
            $value->peserta = $request->peserta;
            // $value->waktu = $request->waktu;
            $value->waktu = "";
            $value->jadwal_end = $request->jadwal_end;
            $value->jadwal_start = $request->jadwal_start;
            $value->tindak_lanjut = $request->tindak_lanjut;
            $value->keterangan = $request->keterangan;
            $value->updated_user = $auth->id;
            $value->save();

            $category = $request->category;
            ProgramKerjaCategory::where('program_kerja_id', $value->id)->delete();

            if (!$category) {
                return redirect($url_base)->with('Kategori Harus Dipilih');
            }
            foreach ($category as $item) {
                $pkc = new ProgramKerjaCategory();
                $pkc->program_kerja_id = $value->id;
                $pkc->category_id = $item;
                $pkc->save();
            }

            $pp = $request->pp ?? [];
            ProgramKerjaCommission::where('program_kerja_id', $value->id)->delete();
            foreach ($pp as $item) {
                $pkpp = new ProgramKerjaCommission();
                $pkpp->program_kerja_id = $value->id;
                $pkpp->commission_id     = $item;
                $pkpp->save();
            }

            DB::commit();

            return redirect($url_base)->with('status', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect($url_base)->with('status', 'Data Gagal Disimpan');
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
        $auth = Auth::user();
        $url_base = 'program_kerja';
        if ($auth->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
        } elseif ($auth->role == 3) {
            $url_base = 'department/' . $url_base;
        }

        try {
            DB::beginTransaction();
            ProgramKerjaCategory::where('program_kerja_id', $id)->delete();
            ProgramKerjaCommission::where('program_kerja_id', $id)->delete();
            ProgramKerja::whereId($id)->delete();
            DB::commit();
            return redirect($url_base)->with('status', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect($url_base)->with('status', 'Data Gagal Dihapus');
        }
    }

    public function importFromExcel(Request $request)
    {
        // Validate the uploaded file
    $validator = Validator::make($request->all(), [
        'uploaded_file' => 'required|mimes:xls,xlsx|max:10240', // Adjust max file size as needed
    ]);

    if ($validator->fails()) {
        return redirect('department/dashboard')
            ->withErrors($validator)
            ->withInput();
    }

    $auth = Auth::user();
    $department = Department::where('user_id', $auth->id)->first();

    // Get the uploaded file
    $file = $request->file('uploaded_file');

    // Generate a unique file name
    $nama_file = uniqid() . '_' . $file->getClientOriginalName();

    // Move the file to the specified directory
    $file->move(public_path('assets/uploads'), $nama_file);

    // Import data using Laravel Excel
    $import = new ProgramKerjaImport($department);

    try {
        Excel::import($import, public_path('assets/uploads/' . $nama_file));
    } catch (\Exception $e) {
        // Handle import exceptions if needed
        return redirect('department/dashboard')->with('status', 'Error during import: ' . $e->getMessage());
    }

    // Check if there were any import errors
    if ($import->getError() != "") {
        return redirect('department/dashboard')->with('status', $import->getError());
    }

    // If successful, you might want to delete the uploaded file
    // Uncomment the line below if you want to delete the file after import
    // unlink(public_path('assets/uploads/' . $nama_file));

    return redirect('department/dashboard')->with('status', 'Import successful');
    }
}
