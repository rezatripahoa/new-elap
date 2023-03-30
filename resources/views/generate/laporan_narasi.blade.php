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

    table{
        margin-top: 20px;
        width: 100%;
    }

    table tr :nth-child(1){
        font-weight: bold;
    }
</style>

<body>
    <h3 class="mb-5 p-0">DEPARTEMEN/PELKAT : {{strtoupper($department->department_name)}}</h3>
    <h3 class="mb-5 p-0">LAPORAN PELAKSANAAN PROGRAM KERJA</h3>
    <h3 class="mb-5 p-0">TAHUN PROGRAM {{$list->year->year_name}}</h3>
    <h3 class="mb-5 p-0">{{strtoupper($list->category[0]->category->category_name)}}
        ({{$list->category[0]->category->description}})</h3>

    <table border="1" class="mt-20">
        <tr>
            <td>NAMA PROGRAM</td>
            <td>:</td>
            <td>{{$list->name}}</td>
        </tr>
        <tr>
            <td>SIFAT PROGRAM</td>
            <td>:</td>
            <td>{{$list->type->name}}</td>
        </tr>
        <tr>
            <td>TUJUAN</td>
            <td>:</td>
            <td>{{$list->tujuan}}</td>
        </tr>
        <tr>
            <td>PJP</td>
            <td>:</td>
            <td>{{$list->pjp->department_name}}</td>
        </tr>
        <tr>
            <td>PP</td>
            <td>:</td>
            <td>{{$commission}}</td>
        </tr>
        <tr>
            <td>RUANG LINGKUP</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> - INSCOPE</td>
            <td>:</td>
            <td>{{$list->inscope}}</td>
        </tr>
        <tr>
            <td> - OUTSCOPE</td>
            <td>:</td>
            <td>{{$list->outscope}}</td>
        </tr>
        <tr>
            <td>INDIKATOR KEBERHASILAN</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> - KUANTITATIF</td>
            <td>:</td>
            <td>{{$list->indikator_kuantitatif}}</td>
        </tr>
        <tr>
            <td> - KUALITATIF</td>
            <td>:</td>
            <td>{{$list->indikator_kualitatif}}</td>
        </tr>
        <tr>
            <td>REALISASI PROGRAM</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> - KUANTITATIF</td>
            <td>:</td>
            <td>{{$list->realisasi_kuantitatif}}</td>
        </tr>
        <tr>
            <td> - KUALITATIF</td>
            <td>:</td>
            <td>{{$list->realisasi_kualitatif}}</td>
        </tr>
        <tr>
            <td>EVALUASI</td>
            <td>:</td>
            <td>{{$list->evaluasi}}</td>
        </tr>
        <tr>
            <td>TINDAK LANJUT</td>
            <td>:</td>
            <td>{{$list->tindak_lanjut}}</td>
        </tr>
    </table>
</body>

</html>