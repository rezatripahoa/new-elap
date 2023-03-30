<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FrontHeadController;
use App\Http\Controllers\FrontPusatController;
use App\Http\Controllers\FrontUserController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\HeaderReportController;
use App\Http\Controllers\KetuaBidangController;
use App\Http\Controllers\ProgramKerjaController;
use App\Http\Controllers\ProgramKerjaTypeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index']);
Route::get('login', [AuthController::class, 'index']);
Route::post('login_submit', [AuthController::class, 'login_submit']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('change_password', [AuthController::class, 'changePassword']);
Route::post('change_password_submit', [AuthController::class, 'changePasswordSubmit']);

Route::group(['middleware' => 'role:1'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::resource('category', CategoryController::class);
        Route::resource('year', YearController::class);
        Route::resource('center', CenterController::class);
        Route::resource('department', DepartmentController::class);
        Route::resource('head', HeadController::class);
        Route::resource('commission', CommissionController::class);
        Route::resource('type', ProgramKerjaTypeController::class);
        Route::resource('header_report', HeaderReportController::class);
        Route::resource('ketua_bidang', KetuaBidangController::class);
        Route::get('department_report', [ReportController::class, 'index']);
        Route::get('report/{id}', [ReportController::class, 'report']);

        Route::get('report_program', [ReportController::class, 'list_departement']);
        Route::get('report_program/{id}', [ReportController::class, 'list_report']);
        Route::get('report_program_narasi/{id}', [ReportController::class, 'report_program_narasi']);
        Route::get('report_program_kegiatan/{id}', [ReportController::class, 'report_program_kegiatan']);

        Route::get('laporan_narasi_admin/{id}', [ReportController::class, 'report_narasi_admin']);
        Route::get('laporan_narasi_generate_admin/{id}/{department}', [ReportController::class, 'report_narasi_generate_admin']);
        Route::get('laporan_program_generate_admin/{id}/{department}', [ReportController::class, 'report_laporan_generate_admin']);

        Route::get('laporan_gabungan_admin/{id}', [ReportController::class, 'report_gabungan_admin']);
        Route::get('laporan_gabungan_generate_admin/{id}', [ReportController::class, 'report_gabungan_excel_admin']);
        Route::get('laporan_triwulan_generate_admin/{id}', [ReportController::class, 'report_triwulan_excel_admin']);

        Route::get('report_gabungan/', [ReportController::class, 'report_gabungan_index']);
        Route::get('report_gabungan/{id}', [ReportController::class, 'report_gabungan']);
        Route::get('report_triwulan/{id}', [ReportController::class, 'report_triwulan']);
        Route::get('report_summary/{id}', [ReportController::class, 'report_summary']);
    });
});

Route::group(['middleware' => 'role:2'], function () {
    Route::prefix('report')->group(function () {
        Route::get('dashboard', [FrontPusatController::class, 'index']);
        // Route::get('list_report/{id}', [FrontPusatController::class, 'report']);

        Route::get('report_program_report', [ReportController::class, 'list_departement']);

        Route::get('laporan_narasi_admin_report/{id}', [ReportController::class, 'report_narasi_admin']);
        Route::get('laporan_narasi_generate_admin_report/{id}/{department}', [ReportController::class, 'report_narasi_generate_admin']);
        Route::get('laporan_program_generate_admin_report/{id}/{department}', [ReportController::class, 'report_laporan_generate_admin']);

        Route::get('laporan_gabungan_admin_report/{id}', [ReportController::class, 'report_gabungan_admin']);
        Route::get('laporan_gabungan_generate_report/{id}', [ReportController::class, 'report_gabungan_excel_admin']);
        Route::get('laporan_triwulan_generate_report/{id}', [ReportController::class, 'report_triwulan_excel_admin']);
    });
});

Route::group(['middleware' => 'role:3'], function () {
    Route::prefix('department')->group(function () {
        Route::get('dashboard', [FrontUserController::class, 'index']);

        Route::post('laporan_kegiatan', [FrontUserController::class, 'laporan_kegiatan_submit']);
        Route::post('laporan_keuangan', [FrontUserController::class, 'laporan_keuangan_submit']);

        Route::resource('program_kerja', ProgramKerjaController::class);
        Route::get('laporan_narasi', [ReportController::class, 'report_narasi']);
        Route::get('laporan_narasi_generate/{id}', [ReportController::class, 'report_narasi_generate']);
        Route::get('laporan_program_generate/{id}', [ReportController::class, 'report_program_generate']);

        Route::get('laporan_gabungan', [ReportController::class, 'report_gabungan']);
        Route::get('laporan_gabungan_generate', [ReportController::class, 'report_gabungan_excel']);
        Route::get('laporan_triwulan_generate', [ReportController::class, 'report_triwulan_excel']);
    });
});

Route::group(['middleware' => 'role:4'], function () {
    Route::prefix('head')->group(function () {
        Route::get('dashboard', [FrontHeadController::class, 'index']);

        Route::resource('program_kerja_head', ProgramKerjaController::class);

        Route::get('laporan_narasi_head', [ReportController::class, 'report_narasi']);
        Route::get('laporan_narasi_generate_head/{id}', [ReportController::class, 'report_narasi_generate']);
        Route::get('laporan_program_generate_head/{id}', [ReportController::class, 'report_program_generate']);

        Route::get('laporan_gabungan_head', [ReportController::class, 'report_gabungan']);
        Route::get('laporan_gabungan_generate_head', [ReportController::class, 'report_gabungan_excel']);
        Route::get('laporan_triwulan_generate_head', [ReportController::class, 'report_triwulan_excel']);
    });
});

Route::group(['middleware' => 'role:5'], function () {
    Route::prefix('kabid')->group(function () {
        Route::get('dashboard', [FrontHeadController::class, 'index_kabid']);

        Route::get('laporan_narasi_kabid', [ReportController::class, 'report_narasi']);
        Route::get('laporan_narasi_generate_kabid/{id}', [ReportController::class, 'report_narasi_generate']);
        Route::get('laporan_program_generate_kabid/{id}', [ReportController::class, 'report_program_generate']);

        Route::get('laporan_gabungan_kabid', [ReportController::class, 'report_gabungan']);
        Route::get('laporan_gabungan_generate_kabid', [ReportController::class, 'report_gabungan_excel']);
        Route::get('laporan_triwulan_generate_kabid', [ReportController::class, 'report_triwulan_excel']);
    });
});