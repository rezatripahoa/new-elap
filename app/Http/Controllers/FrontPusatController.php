<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Center;
use App\Models\Department;
use App\Models\Document;
use App\Models\YearCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPusatController extends Controller
{
    //
    public function index(Request $request)
    {
        $auth = Auth::user();
        $centers = Center::where('user_id', $auth->id)->first();
        $department = Department::orderBy('id')->get();

        $data = [];
        $data['list'] = $department;
        $data['centers'] = $centers;

        return view('pusat.list_department', ['data' => $data]);
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

        return view('pusat.document', ['data' => $data]);
    }
}
