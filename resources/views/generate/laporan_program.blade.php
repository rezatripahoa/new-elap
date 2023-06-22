<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate Laporan Narasi</title>
</head>
<style>
    * {
        padding: 10px;
        margin: 0px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    .p-0 {
        padding: 0;
    }

    .m-0 {
        margin: 0;
    }

    .mb-5 {
        margin-bottom: 5px;
    }

    .mt-20 {
        margin-top: 20px;
    }

    .page_break {
        page-break-before: always;
    }

    .img-width {
        width: 200px;
    }

    .header {
        margin-bottom: 20px;
    }

    h4 {
        font-weight: lighter;
    }
</style>

<body>
    <center class="header">
        <h3 class="mb-5 p-0">LAPORAN KEGIATAN DAN KEUANGAN PROGRAM KERJA</h3>
        <h3 class="mb-5 p-0">{{ strtoupper($list->category[0]->category->category_name) }}
            ({{ $list->category[0]->category->description }})</h3>
        <h3 class="mb-5 p-0">TAHUN PROGRAM {{ $list->year->year_name }}</h3>
        <h3 class="mb-5 p-0">{{ strtoupper($department->department_name) }}</h3>
    </center>

    <div>
        <h3>NAMA PROGRAM</h3>
        <h4>{{ $list->name }}</h4>
    </div>

    <div>
        <h3>SIFAT PROGRAM</h3>
        <h4>{{ $list->type->name }}</h4>
    </div>

    <div>
        <h3>TUJUAN PROGRAM</h3>
        <h4>{{ $list->tujuan }}</h4>
    </div>

    <div>
        <h3>JADWAL KEGIATAN</h3>
        <h4>{{ \Carbon\Carbon::parse($list->jadwal_start)->isoFormat('dddd, D MMMM Y') }}</h4>
    </div>

    <div>
        <h3>LOKASI KEGIATAN</h3>
        <h4>{{ $list->lokasi }}</h4>
    </div>

    <div>
        <h3>FREKUENSI KEGIATAN</h3>
        <h4>{{ $list->frekuensi }}</h4>
    </div>

    <div>
        <h3>RENCANA ANGGARAN BIAYA</h3>
        <div>
            <h3>A. PENERIMAAN</h3>
            <h4>IDR {{ number_format($list->rencana_penerimaan, 2, ',', '.') }}</h4>
            <h3>B. PENGELUARAN</h3>
            <h4>IDR {{ number_format($list->rencana_pengeluaran, 2, ',', '.') }}</h4>
        </div>
    </div>
    <div>
        <h3>REALISASI ANGGARAN BIAYA</h3>
        <div>
            <h3>A. PENERIMAAN</h3>
            <h4>IDR {{ number_format($list->realisasi_penerimaan, 2, ',', '.') }}</h4>
            <h3>B. PENGELUARAN</h3>
            <h4>IDR {{ number_format($list->realisasi_pengeluaran, 2, ',', '.') }}</h4>
        </div>
    </div>
    <div>
        <h3>KETERANGAN</h3>
        <h4>{{ $list->keterangan }}</h4>
    </div>

    <div class="page_break"></div>
    <h3 class="mb-5">(LAMPIRAN BUKTI PENERIMAAN & PENGELUARAN)</h3>
    <h3 class="mb-5">BUKTI PENERIMAAN :</h3>

    @foreach ($list->attachment as $key => $attachment)
        @if ($attachment->category == 2)
            <h3>{{ $key + 1 }}. {{ $attachment->name }}</h3>
            <img class="img-width" src="{{ url('assets/images/attachments/' . $list->id . '/' . $attachment->file) }}"
                alt="image">
        @endif
    @endforeach

    <h3 class="mb-5 mt-20">BUKTI PENGELUARAN :</h3>
    @foreach ($list->attachment as $keys => $attachment)
        @if ($attachment->category == 1)
            <h3>{{ $keys + 1 }}. {{ $attachment->name }}</h3>
            <img class="img-width" src="{{ url('assets/images/attachments/' . $list->id . '/' . $attachment->file) }}"
                alt="image">
        @endif
    @endforeach
</body>

</html>
