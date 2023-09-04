@if (auth()->user()->role == 1)
    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/category') }}">Data Kategori</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/year') }}">Data Tahun</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/commission') }}">Data Penopang Program</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/type') }}">Data Tipe Program</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/center') }}">Data Admin</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/department') }}">Data Pusat, Mupel, Jemaat</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/head') }}">Data Ketua Bidang</a>
            </div>
        </div>
    </div>

    {{-- <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/ketua_bidang') }}">Data User</a>
            </div>
        </div>
    </div> --}}

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/header_report') }}">Setting Header Report</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/report_program') }}">Laporan</a>
            </div>
        </div>
    </div>
@endif

@if (auth()->user()->role == 2)
    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('report/report_program_report') }}">Laporan</a>
            </div>
        </div>
    </div>
    {{-- <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <p class="font-weight-bold">Realisasi</p>
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="ml-3" href="{{ url('report/report_program_kerja_acc?year=' . $year) }}">Program
                    Kerja</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <p class="font-weight-bold">Generate Laporan</p>
            <div class="mb-2 @if (isset($data['page']) && $data['page'] == 'Laporan Kegiatan Program Kerja') menu-active @endif">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="ml-3" href="{{ url('report/report_laporan_kegiatan') }}">Laporan Kegiatan</a>
            </div>
            <div class="mb-2 @if (isset($data['page']) && $data['page'] == 'Laporan Narasi Program Kerja') menu-active @endif">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="ml-3" href="{{ url('report/report_laporan_narasi') }}">Laporan Narasi</a>
            </div>
            <div class="@if (isset($data['page']) && $data['page'] == 'Laporan Gabungan') menu-active @endif">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="ml-3" href="{{ url('report/report_laporan_gabungan') }}">Laporan Gabungan</a>
            </div>
        </div>
    </div> --}}
@endif
