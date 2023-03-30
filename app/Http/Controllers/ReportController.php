<?php

namespace App\Http\Controllers;

use App\Exports\ReportGabungan;
use App\Exports\ReportTriwulan;
use App\Models\Category;
use App\Models\Center;
use App\Models\Commission;
use App\Models\Department;
use App\Models\Document;
use App\Models\Head;
use App\Models\HeaderReport;
use App\Models\KetuaBidang;
use App\Models\ProgramKerja;
use App\Models\ProgramKerjaCategory;
use App\Models\ProgramKerjaCommission;
use App\Models\ProgramKerjaType;
use App\Models\YearCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    public function index()
    {
        $department = Department::orderBy('id')->get();

        $data = [];
        $data['list'] = $department;

        return view('admin.report.list_department', ['data' => $data]);
    }

    public function list_departement()
    {
        $department = Department::orderBy('id')->get();

        $data = [];
        $data['list'] = $department;

        return view('admin.report.list_department', ['data' => $data]);
    }

    public function list_report(Request $request, $id)
    {
        $auth = Auth::user();
        $centers = Center::where('user_id', $auth->id)->first();

        $department = Department::whereId($id)->first();
        $category = Category::orderBy('category_name', 'asc')->get();
        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $curr_year = YearCategory::where('year_name', $request->year)->first();

        $laporan = Document::with('attachment', 'year', 'category')->where('year_id', $curr_year->id)->get();

        $data = [];
        $data['list'] = $laporan;
        $data['category'] = $category;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['department'] = $department;
        $data['centers'] = $centers;

        return view('admin.report.list_report', ['data' => $data]);
    }

    public function list_report_new(Request $request, $id)
    {
        $auth = Auth::user();
        $department = Department::where('user_id', $auth->id)->first();

        $list = ProgramKerja::with('category', 'pp')->whereId($id)->first();
        $year = YearCategory::orderBy('year_name', 'asc')->get();
        $list_department = Department::orderBy('department_name', 'asc')->get();
        $commission = Commission::orderBy('name', 'asc')->get();
        $type = ProgramKerjaType::orderBy('name', 'asc')->get();
        $category = Category::orderBy('category_name', 'asc')->get();

        $data = [];
        $data['year'] = $year;
        $data['department'] = $department;
        $data['list_department'] = $list_department;
        $data['commission'] = $commission;
        $data['category'] = $category;
        $data['type'] = $type;
        $data['list'] = $list;

        return view('user.program_kerja.detail', ['data' => $data]);
    }

    public function report(Request $request, $id)
    {
        $auth = Auth::user();
        $centers = Center::where('user_id', $auth->id)->first();

        $department = Department::whereId($id)->first();
        $category = Category::orderBy('category_name', 'asc')->get();
        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $curr_year = YearCategory::where('year_name', $request->year)->first();

        $laporan = Document::with('attachment', 'year', 'category')->where('year_id', $curr_year->id)->get();

        $data = [];
        $data['list'] = $laporan;
        $data['category'] = $category;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['department'] = $department;
        $data['centers'] = $centers;

        return view('admin.report.list_report', ['data' => $data]);
    }

    public function report_narasi(Request $request)
    {
        $auth = Auth::user();
        $data = [];

        if ($auth->role == 4) {
            $head = Head::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } elseif ($auth->role == 5) {
            $head = KetuaBidang::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } else {
            $department = Department::where('user_id', $auth->id)->first();
        }

        $year = YearCategory::orderBy('year_name', 'asc')->get();
        $category = Category::orderBy('category_name', 'asc')->get();

        if (isset($request->year) && isset($request->category)) {
            $program_kerja_category = ProgramKerjaCategory::where('category_id', $request->category)->pluck('program_kerja_id');
            $program_kerja_id = array_unique($program_kerja_category->toArray());
            $program_kerja = ProgramKerja::where('departement_id', $department->id)
                ->where('year_id', $request->year)
                ->whereIn('id', $program_kerja_id)
                ->orderBy('id', 'desc')->get();
        } else {
            $program_kerja = [];
        }

        $data['list'] = $program_kerja;
        $data['year'] = $year;
        $data['category'] = $category;
        $data['curr_year'] = $request->year;
        $data['curr_category'] = $request->category;
        $data['department'] = $department;

        return view('user.laporan_narasi.index', ['data' => $data]);
    }

    public function report_narasi_admin($id, Request $request)
    {
        $department = Department::whereId($id)->first();
        $year = YearCategory::orderBy('year_name', 'asc')->get();
        $category = Category::orderBy('category_name', 'asc')->get();


        if (isset($request->year) && isset($request->category)) {
            $program_kerja_category = ProgramKerjaCategory::where('category_id', $request->category)->pluck('program_kerja_id');
            $program_kerja_id = array_unique($program_kerja_category->toArray());
            $program_kerja = ProgramKerja::where('departement_id', $department->id)
                ->where('year_id', $request->year)
                ->whereIn('id', $program_kerja_id)
                ->orderBy('id', 'desc')->get();
        } else {
            $program_kerja = [];
        }

        $data = [];
        $data['list'] = $program_kerja;
        $data['year'] = $year;
        $data['category'] = $category;
        $data['curr_year'] = $request->year;
        $data['curr_category'] = $request->category;
        $data['department'] = $department;

        return view('admin.laporan_narasi.index', ['data' => $data]);
    }

    public function report_narasi_generate($id, Request $request)
    {
        $auth = Auth::user();
        $data = [];
        if ($auth->role == 4) {
            $head = Head::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } elseif ($auth->role == 5) {
            $head = KetuaBidang::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } else {
            $department = Department::where('user_id', $auth->id)->first();
        }

        $program_kerja = ProgramKerja::with([
            'year',
            'type',
            'pjp',
            'category' => function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            }
        ])
            ->whereId($id)->first();

        $pp = ProgramKerjaCommission::where('program_kerja_id', $id)->pluck('commission_id');
        $commission = Commission::whereId($pp)->pluck('name');

        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['commission'] = implode(", ", $commission->toArray());


        $pdf = Pdf::loadView('generate.laporan_narasi', $data);
        return $pdf->download('Laporan Narasi Program Kerja ' . $program_kerja->name . '.pdf');

        // return view('generate.laporan_narasi', $data);
    }

    public function report_narasi_generate_admin($id, $department, Request $request)
    {
        $department = Department::whereId($department)->first();

        $program_kerja = ProgramKerja::with([
            'year',
            'type',
            'pjp',
            'category' => function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            }
        ])
            ->whereId($id)->first();

        $pp = ProgramKerjaCommission::where('program_kerja_id', $id)->pluck('commission_id');
        $commission = Commission::whereId($pp)->pluck('name');

        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['commission'] = implode(", ", $commission->toArray());


        $pdf = Pdf::loadView('generate.laporan_narasi', $data);
        return $pdf->download('Laporan Narasi Program Kerja ' . $program_kerja->name . '.pdf');

        // return view('generate.laporan_narasi', $data);
    }

    public function report_program_generate($id, Request $request)
    {
        $auth = Auth::user();

        if ($auth->role == 4) {
            $head = Head::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } elseif ($auth->role == 5) {
            $head = KetuaBidang::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } else {
            $department = Department::where('user_id', $auth->id)->first();
        }

        $program_kerja = ProgramKerja::with([
            'year',
            'type',
            'pjp',
            'category' => function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            }
        ])
            ->whereId($id)->first();

        $pp = ProgramKerjaCommission::where('program_kerja_id', $id)->pluck('commission_id');
        $commission = Commission::whereId($pp)->pluck('name');

        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['commission'] = implode(", ", $commission->toArray());


        $pdf = Pdf::loadView('generate.laporan_program', $data);
        return $pdf->download('Laporan Program Kerja ' . $program_kerja->name . '.pdf');

        // return view('generate.laporan_narasi', $data);
    }

    public function report_laporan_generate_admin($id, $department, Request $request)
    {
        $department = Department::whereId($department)->first();

        $program_kerja = ProgramKerja::with([
            'year',
            'type',
            'pjp',
            'category' => function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            }
        ])
            ->whereId($id)->first();

        $pp = ProgramKerjaCommission::where('program_kerja_id', $id)->pluck('commission_id');
        $commission = Commission::whereId($pp)->pluck('name');

        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['commission'] = implode(", ", $commission->toArray());


        $pdf = Pdf::loadView('generate.laporan_program', $data);
        return $pdf->download('Laporan Program Kerja ' . $program_kerja->name . '.pdf');

        // return view('generate.laporan_narasi', $data);
    }

    public function report_gabungan()
    {
        $auth = Auth::user();
        $data = [];

        if ($auth->role == 4) {
            $head = Head::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } elseif ($auth->role == 5) {
            $head = KetuaBidang::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } else {
            $department = Department::where('user_id', $auth->id)->first();
        }
        $year = YearCategory::orderBy('year_name', 'asc')->get();
        $category = Category::orderBy('category_name', 'asc')->get();

        $data['year'] = $year;
        $data['category'] = $category;
        $data['department'] = $department;

        return view('user.laporan_gabungan.index', ['data' => $data]);
    }

    public function report_gabungan_admin($id)
    {
        $department = Department::whereId($id)->first();
        $year = YearCategory::orderBy('year_name', 'asc')->get();
        $category = Category::orderBy('category_name', 'asc')->get();

        $data = [];
        $data['year'] = $year;
        $data['category'] = $category;
        $data['department'] = $department;

        return view('admin.laporan_gabungan.index', ['data' => $data]);
    }

    public function report_gabungan_generate(Request $request)
    {
        $auth = Auth::user();
        $department = Department::where('user_id', $auth->id)->first();

        $year = YearCategory::whereId($request->year)->first();

        $program_kerja = ProgramKerja::with('year', 'pp.commission', 'pjp', 'type')
            ->where('year_id', $request->year)
            ->where('departement_id', $department->id)->get();

        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['year'] = $year;

        $pdf = Pdf::loadView('generate.laporan_gabungan', $data)->setPaper('a4', 'landscape');;
        return $pdf->download('Laporan Program Kerja dan Anggaran ' . $department->name . '.pdf');
        // return view('generate.laporan_gabungan', $data);
    }

    public function report_gabungan_excel(Request $request)
    {
        $auth = Auth::user();

        if ($auth->role == 4) {
            $head = Head::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } elseif ($auth->role == 5) {
            $head = KetuaBidang::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } else {
            $department = Department::where('user_id', $auth->id)->first();
        }

        $year = YearCategory::whereId($request->year)->first();
        $header_reports = HeaderReport::orderBy('order', 'asc')->get();

        $program_kerja = ProgramKerja::with('year', 'pp.commission', 'pjp', 'type')
            ->where('year_id', $request->year)
            ->where('departement_id', $department->id)->get();

        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['year'] = $year;
        $data['header_reports'] = $header_reports;

        return Excel::download(new ReportGabungan($data), 'Laporan Program Kerja dan Anggaran ' . $department->name . '.xlsx');
        // return view('generate.laporan_gabungan', $data);
    }

    public function report_gabungan_excel_admin($id, Request $request)
    {
        $department = Department::whereId($id)->first();

        $year = YearCategory::whereId($request->year)->first();
        $header_reports = HeaderReport::orderBy('order', 'asc')->get();

        $program_kerja = ProgramKerja::with('year', 'pp.commission', 'pjp', 'type')
            ->where('year_id', $request->year)
            ->where('departement_id', $department->id)->get();

        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['year'] = $year;
        $data['header_reports'] = $header_reports;

        return Excel::download(new ReportGabungan($data), 'Laporan Program Kerja dan Anggaran ' . $department->name . '.xlsx');
        // return view('generate.laporan_gabungan', $data);
    }

    public function report_triwulan_generate(Request $request)
    {
        $auth = Auth::user();
        $department = Department::where('user_id', $auth->id)->first();

        $year = YearCategory::whereId($request->year)->first();

        $program_kerja = Category::with(['program_kerja_category.program_kerja' => function ($query) use ($request, $department) {
            $query->where('program_kerja.year_id', $request->year);
            $query->where('program_kerja.departement_id', $department->id);
        }])
            ->whereIn('id', $request->category)->get();
        // dd($program_kerja[0]->program_kerja_category[0]);
        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['year'] = $year;

        $pdf = Pdf::loadView('generate.laporan_triwulan', $data)->setPaper('a4', 'landscape');;
        return $pdf->download('Laporan Program Kerja dan Anggaran ' . $department->name . '.pdf');
        // return view('generate.laporan_triwulan', $data);
    }

    public function report_triwulan_excel(Request $request)
    {
        $auth = Auth::user();

        if ($auth->role == 4) {
            $head = Head::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } elseif ($auth->role == 5) {
            $head = KetuaBidang::where('user_id', $auth->id)->first();
            $department = Department::whereId($head->department_id)->first();
            $data['head'] = $head;
        } else {
            $department = Department::where('user_id', $auth->id)->first();
        }

        $year = YearCategory::whereId($request->year)->first();

        $program_kerja = Category::with(['program_kerja_category.program_kerja' => function ($query) use ($request, $department) {
            $query->where('program_kerja.year_id', $request->year);
            $query->where('program_kerja.departement_id', $department->id);
        }])
            ->whereIn('id', $request->category)->get();
        // dd($program_kerja[0]->program_kerja_category[0]);
        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['year'] = $year;

        // $pdf = Pdf::loadView('generate.laporan_triwulan', $data)->setPaper('a4', 'landscape');;
        // return $pdf->download('Laporan Program Kerja dan Anggaran ' . $department->name . '.pdf');
        return Excel::download(new ReportTriwulan($data), 'Laporan Program Kerja dan Anggaran ' . $department->name . '.xlsx');
        // return view('generate.laporan_triwulan', $data);
    }

    public function report_triwulan_excel_admin($id, Request $request)
    {
        $department = Department::whereId($id)->first();

        $year = YearCategory::whereId($request->year)->first();

        $program_kerja = Category::with(['program_kerja_category.program_kerja' => function ($query) use ($request, $department) {
            $query->where('program_kerja.year_id', $request->year);
            $query->where('program_kerja.departement_id', $department->id);
        }])
            ->whereIn('id', $request->category)->get();
        $data = [];
        $data['list'] = $program_kerja;
        $data['department'] = $department;
        $data['year'] = $year;

        return Excel::download(new ReportTriwulan($data), 'Laporan Program Kerja dan Anggaran ' . $department->name . '.xlsx');
    }
}
