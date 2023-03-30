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

    table {
        margin-top: 20px;
        width: 100%;
    }

    table tr :nth-child(1) {
        font-weight: bold;
    }

    .page_break {
        page-break-before: always;
    }

    .img-width {
        width: 200px;
    }
</style>

<body>
    <h3 class="mb-5 p-0">DEPARTEMEN/PELKAT : {{ strtoupper($department->department_name) }}</h3>
    <h3 class="mb-5 p-0">LAPORAN PELAKSANAAN PROGRAM KERJA</h3>
    <h3 class="mb-5 p-0">TAHUN PROGRAM {{ $list->year->year_name }}</h3>
    <h3 class="mb-5 p-0">{{ strtoupper($list->category[0]->category->category_name) }}
        ({{ $list->category[0]->category->description }})</h3>

    <table border="1" class="mt-20">
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td>{{ $list->name }}</td>
        </tr>
        <tr>
            <td>SIFAT</td>
            <td>:</td>
            <td>{{ $list->type->name }}</td>
        </tr>
        <tr>
            <td>TUJUAN</td>
            <td>:</td>
            <td>{{ $list->tujuan }}</td>
        </tr>
        <tr>
            <td>JADWAL</td>
            <td>:</td>
            <td>{{ $list->waktu }}</td>
        </tr>
        <tr>
            <td>LOKASI</td>
            <td>:</td>
            <td>{{ $list->lokasi }}</td>
        </tr>
        <tr>
            <td>FREKUENSI</td>
            <td>:</td>
            <td>{{ $list->frekuensi }}</td>
        </tr>

        <tr>
            <td>RENCANA</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> - PENERIMAAN</td>
            <td>:</td>
            <td>{{ $list->rencana_penerimaan }}</td>
        </tr>
        <tr>
            <td> - PENGELUARAN</td>
            <td>:</td>
            <td>{{ $list->rencana_pengeluaran }}</td>
        </tr>
        <tr>
            <td>REALISASI</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> - PENERIMAAN</td>
            <td>:</td>
            <td>{{ $list->realisasi_penerimaan }}</td>
        </tr>
        <tr>
            <td> - PENGELUARAN</td>
            <td>:</td>
            <td>{{ $list->realisasi_pengeluaran }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> - PENERIMAAN</td>
            <td>:</td>
            <td>{{ $list->rencana_penerimaan - $list->realisasi_penerimaan }}</td>
        </tr>
        <tr>
            <td> - PENGELUARAN</td>
            <td>:</td>
            <td>{{ $list->realisasi_pengeluaran - $list->rencana_pengeluaran }}</td>
        </tr>
        <tr>
            <td>KETERANGAN</td>
            <td>:</td>
            <td>{{ $list->keterangan }}</td>
        </tr>
    </table>

    @foreach ($list->attachment as $key => $attachment)
        <div class="page_break"></div>
        <h3>{{ $key+1 }}. {{ $attachment->name }}</h3>
        <img class="img-width" src="{{ url('assets/images/attachments/' . $list->id . '/' . $attachment->file) }}"
            alt="image">
    @endforeach
</body>

</html>
