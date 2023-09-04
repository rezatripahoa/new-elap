@php $year = date('Y') . ' - ' . date('Y') + 1; @endphp

@if (auth()->user()->role == 4)
    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <p class="font-weight-bold">Master</p>
            <div class="mb-2">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('head/program_kerja_head?year=' . $year) }}">RPKA</a>
            </div>
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('head/program_kerja_acc_head?year=' . $year) }}">PKA</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <p class="font-weight-bold">Realisasi</p>
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('head/program_kerja_realisasi_head?year=' . $year) }}">Program
                    Kerja</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <p class="font-weight-bold">Generate Laporan</p>
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('head/laporan_kegiatan_head') }}">Laporan Kegiatan</a>
            </div>
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('head/laporan_narasi_head') }}">Laporan Narasi</a>
            </div>
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('head/laporan_gabungan_head') }}">Laporan Gabungan</a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded d-none d-md-block">
        <div class="p-3 h6 font-weight-bold">
            <div class="">
                <i class="fa fa-book" style="font-size:20px;"></i>
                <a class="text-dark ml-3" href="{{ url('change_password') }}">Ganti Password</a>
            </div>
        </div>
    </div>
@endif

<div class="float-right d-block d-md-none">
    <button data-toggle="modal" data-target="#modal-menu" class="bg-white rounded"
        style="width:50px; text-align:center">
        <div class="p-1">
            <i class="fa fa-bars" style="font-size:24px;"></i>
        </div>
    </button>
</div>
