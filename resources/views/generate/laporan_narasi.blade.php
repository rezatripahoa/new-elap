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

    .header{
        margin-bottom: 20px;
    }

    h4{
        font-weight: lighter;
    }
</style>

<body>
    <center class="header">
        <h3 class="mb-5 p-0">LAPORAN NARASI PELAKSANAAN PROGRAM KERJA</h3>
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
        <h3>PJP</h3>
        <h4>{{ $list->pjp->department_name }}</h4>
    </div>

    <div>
        <h3>PP</h3>
        <h4>{{ $commission }}</h4>
    </div>
    <div>
        <h3>RUANG LINGKUP</h3>
        <div>
            <h3>A. INSCOPE</h3>
            <h4>{{ $list->inscope }}</h4>
            <h3>B. OUTSCOPE</h3>
            <h4>{{ $list->outscope }}</h4>
        </div>
    </div>
    <div>
        <h3>INDIKATOR KEBERHASILAN</h3>
        <div>
            <h3>A. KUANTITATIF</h3>
            <h4>{{ $list->indikator_kuantitatif }}</h4>
            <h3>B. KUALITATIF</h3>
            <h4>{{ $list->indikator_kualitatif }}</h4>
        </div>
    </div>
    <div>
        <h3>REALISASI PROGRAM</h3>
        <div>
            <h3>A. KUANTITATIF</h3>
            <h4>{{ $list->realisasi_kuantitatif }}</h4>
            <h3>B. KUALITATIF</h3>
            <h4>{{ $list->realisasi_kualitatif }}</h4>
        </div>
    </div>
    <div>
        <h3>EVALUASI</h3>
        <h4>{{ $list->evaluasi }}</h4>
    </div>
    <div>
        <h3>TINDAK LANJUT</h3>
        <h4>{{ $list->tindak_lanjut }}</h4>
    </div>
</body>

</html>
