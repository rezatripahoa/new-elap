<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Commission;
use App\Models\Department;
use App\Models\ProgramKerja;
use App\Models\ProgramKerjaCategory;
use App\Models\ProgramKerjaCommission;
use App\Models\ProgramKerjaType;
use App\Models\YearCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use DateTime;
use Illuminate\Support\Facades\DB;

class ProgramKerjaImport implements ToCollection, WithStartRow
{
    /**
     * @param Collection $collection
     */
    private $message = "";
    protected $department;
    /**
     * @return \Illuminate\Support\Collection
     */

    function __construct($department)
    {
        $this->department = $department;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function getError()
    {
        return $this->message;
    }

    public function collection(Collection $rows)
    {
        $auth = Auth::user();
        foreach ($rows as $key => $row) {
            try {
                if ($row[0]) {
                    $year = YearCategory::where('year_name', trim($row[2]))->first();
                    $type = ProgramKerjaType::where('name', strtoupper($row[1]))->first();
                    $pjp = Department::where('department_name', $row[4])->first();
                    $tanggal_selesai = "";
                    $tanggal_mulai = "";

                    if ($row[8] != null) {
                        $date_tanggal_mulai = ExcelDate::excelToDateTimeObject($row[8])->format("Y-m-d");
                        $tanggal_mulai = new DateTime($date_tanggal_mulai);
                    }
                    if ($row[9] != null) {
                        $date_tanggal_selesai = ExcelDate::excelToDateTimeObject($row[9])->format("Y-m-d");
                        $tanggal_selesai = new DateTime($date_tanggal_selesai);
                    }
                    $category = explode(",", $row[3]);
                    $pp = explode(",", $row[5]);

                    $value = new ProgramKerja();
                    $value->departement_id = $this->department->id;
                    $value->year_id = $year->id;
                    $value->type_id = $type->id;
                    $value->pjp_id = $pjp->id;
                    $value->name = $row[0];
                    $value->tujuan = $row[6];
                    $value->lokasi = $row[7];
                    $value->rencana_penerimaan = $row[15];
                    $value->rencana_pengeluaran = $row[16];
                    $value->realisasi_penerimaan =  0;
                    $value->realisasi_pengeluaran = 0;
                    $value->inscope = $row[10];
                    $value->outscope = $row[11];
                    $value->indikator_kuantitatif = $row[13];
                    $value->indikator_kualitatif = $row[14];
                    $value->realisasi_kuantitatif = "";
                    $value->realisasi_kualitatif = "";
                    $value->evaluasi = "";
                    $value->frekuensi = $row[12];
                    $value->peserta = 0;
                    $value->waktu = null;
                    $value->jadwal_end = $tanggal_selesai;
                    $value->jadwal_start = $tanggal_mulai;
                    $value->tindak_lanjut = "";
                    $value->keterangan = $row[17];
                    $value->created_user = $auth->id;
                    $value->updated_user = $auth->id;
                    $value->save();

                    foreach ($category as $item) {
                        $cat = Category::where('category_name', $item)->first();

                        $pkc = new ProgramKerjaCategory();
                        $pkc->program_kerja_id = $value->id;
                        $pkc->category_id = $cat->id;
                        $pkc->save();
                    }

                    foreach ($pp as $item) {
                        $com = Commission::where('name', $item)->first();

                        $pkpp = new ProgramKerjaCommission();
                        $pkpp->program_kerja_id = $value->id;
                        $pkpp->commission_id = $com->id;
                        $pkpp->save();
                    }
                }
            } catch (\Throwable $th) {
                dd($th);
                $message = "Gagal";
                $this->message = $message;
                break;
            }
        }
        return true;
    }
}
