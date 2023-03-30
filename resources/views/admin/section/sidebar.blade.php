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
                <a class="text-dark ml-3" href="{{ url('admin/commission') }}">Data Komisi</a>
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
                <a class="text-dark ml-3" href="{{ url('admin/center') }}">Data Pusat</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/department') }}">Data Department</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/head') }}">Data Ketua Department</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('admin/ketua_bidang') }}">Data Ketua Bidang</a>
            </div>
        </div>
    </div>

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
@endif
