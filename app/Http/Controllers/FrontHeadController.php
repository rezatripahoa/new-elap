<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Document;
use App\Models\Head;
use App\Models\KetuaBidang;
use App\Models\YearCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontHeadController extends Controller
{
    //
    public function index(Request $request)
    {
        $auth = Auth::user();
        $head = Head::where('user_id', $auth->id)->first();
        $department = Department::whereId($head->department_id)->first();
        $category = Category::orderBy('category_name', 'asc')->get();
        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $curr_year = YearCategory::where('year_name', $request->year)->first();

        $laporan = Document::with('attachment', 'year', 'category')->where('year_id', $curr_year->id)
            ->where('department_id', $head->department_id)->get();

        $data = [];
        $data['list'] = $laporan;
        $data['category'] = $category;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['head'] = $head;
        $data['department'] = $department;

        return view('head.mydocument', ['data' => $data]);
    }

    public function index_kabid(Request $request)
    {
        $auth = Auth::user();
        $head = KetuaBidang::where('user_id', $auth->id)->first();
        $department = Department::whereId($head->department_id)->first();
        $category = Category::orderBy('category_name', 'asc')->get();
        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $curr_year = YearCategory::where('year_name', $request->year)->first();

        $laporan = Document::with('attachment', 'year', 'category')->where('year_id', $curr_year->id)
            ->where('department_id', $head->department_id)->get();

        $data = [];
        $data['list'] = $laporan;
        $data['category'] = $category;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['head'] = $head;
        $data['department'] = $department;

        return view('user.mydocument', ['data' => $data]);
    }
}
