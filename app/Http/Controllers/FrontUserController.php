<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentAttachment;
use App\Models\YearCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FrontUserController extends Controller
{
    //
    public function index(Request $request)
    {
        $auth = Auth::user();
        $department = Department::where('user_id', $auth->id)->first();
        $category = Category::orderBy('category_name', 'asc')->get();
        $year = YearCategory::orderBy('year_name', 'asc')->get();

        $curr_year = YearCategory::where('year_name', $request->year)->first();

        $laporan = Document::with('attachment', 'year', 'category')->where('year_id', $curr_year->id)
            ->where('department_id', $department->id)->get();

        $data = [];
        $data['list'] = $laporan;
        $data['category'] = $category;
        $data['year'] = $year;
        $data['curr_year'] = $request->year;
        $data['department'] = $department;

        return view('user.mydocument', ['data' => $data]);
    }

    public function laporan_kegiatan_submit(Request $request)
    {
        $auth = Auth::user();
        $department = Department::where('user_id', $auth->id)->first();
        $year = YearCategory::where('year_name', $request->curr_year)->first();
        $code = Str::random(12);

        $check_document = Document::where('document_name', 'LAPORAN KEGIATAN ' . $request->category_id . ' ' . $request->curr_year)->first();
        if ($check_document != null) {
            $check_document->delete();
        }
        $filename = '';

        if ($request->hasFile('laporan')) {
            $allowedfileExtension = ['doc', 'pdf', 'docx'];
            $files = $request->file('laporan');
            $filename = $files->getClientOriginalName();
            $extension = $files->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $filename = $code . "_lpkg." . $extension;
                $path = $filename;
                $move = $files->move('files/reports/' . $department->department_name, $filename);
            } else {
                return redirect('department/dashboard?year=' . $request->curr_year)->with('status', 'Gagal Upload Laporan');
            }
        }

        $document = new Document();
        $document->department_id = $department->id;
        $document->category_id = $request->category_id;
        $document->year_id = $year->id;
        $document->document_name = 'LAPORAN KEGIATAN ' . $request->category_id . ' ' . $request->curr_year;
        $document->document_file = $filename;
        $document->save();

        if ($request->attachment_name != null) {
            foreach ($request->attachment_name as $key => $attachment) {
                $filename = '';

                if ($request->hasFile('attachment_file.' . $key)) {
                    $allowedfileExtension = ['png', 'jpg', 'jpeg', 'pdf'];
                    $files = $request->file('attachment_file')[$key];
                    $filename = $files->getClientOriginalName();
                    $extension = $files->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $filename = $code . "_lpkgl" . $key . "." . $extension;
                        $path = $filename;
                        $move = $files->move('files/reports/' . $department->department_name, $filename);
                    } else {
                        return redirect('department/dashboard?year=' . $request->curr_year)->with('status', 'Gagal Upload Lampiran');
                    }
                }

                $attachment_db = new DocumentAttachment();
                $attachment_db->document_id = $document->id;
                $attachment_db->attachment_name = $attachment;
                $attachment_db->attachment_file = $filename;
                $attachment_db->save();
            }
        }

        return redirect('department/dashboard?year=' . $request->curr_year)->with('status', 'Dokumen Berhasil di simpan');
    }

    public function laporan_keuangan_submit(Request $request)
    {
        $auth = Auth::user();
        $department = Department::where('user_id', $auth->id)->first();
        $year = YearCategory::where('year_name', $request->curr_year)->first();
        $code = Str::random(12);

        $check_document = Document::where('document_name', 'LAPORAN KEUANGAN ' . $request->category_id . ' ' . $request->curr_year)->first();
        if ($check_document != null) {
            $check_document->delete();
        }

        $filename = '';

        if ($request->hasFile('laporan')) {
            $allowedfileExtension = ['xls', 'xlsx','pdf'];
            $files = $request->file('laporan');
            $filename = $files->getClientOriginalName();
            $extension = $files->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $filename = $code . "_lpke." . $extension;
                $path = $filename;
                $move = $files->move('files/reports/' . $department->department_name, $filename);
            } else {
                return redirect('department/dashboard?year=' . $request->curr_year)->with('status', 'Gagal Upload Laporan');
            }
        }

        $document = new Document();
        $document->department_id = $department->id;
        $document->category_id = $request->category_id;
        $document->year_id = $year->id;
        $document->document_name = 'LAPORAN KEUANGAN ' . $request->category_id . ' ' . $request->curr_year;
        $document->document_file = $filename;
        $document->save();

        if ($request->attachment_name != null) {
            foreach ($request->attachment_name as $key => $attachment) {
                $filename = '';

                if ($request->hasFile('attachment_file.' . $key)) {
                    $allowedfileExtension = ['png', 'jpg', 'jpeg', 'pdf'];
                    $files = $request->file('attachment_file')[$key];
                    $filename = $files->getClientOriginalName();
                    $extension = $files->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $filename = $code . "_lpkel" . $key . "." . $extension;
                        $path = $filename;
                        $move = $files->move('files/reports/' . $department->department_name, $filename);
                    } else {
                        return redirect('department/dashboard?year=' . $request->curr_year)->with('status', 'Gagal Upload Lampiran');
                    }
                }

                $attachment_db = new DocumentAttachment();
                $attachment_db->document_id = $document->id;
                $attachment_db->attachment_name = $attachment;
                $attachment_db->attachment_file = $filename;
                $attachment_db->save();
            }
        }


        return redirect('department/dashboard?year=' . $request->curr_year)->with('status', 'Dokumen Berhasil di simpan');
    }
}
