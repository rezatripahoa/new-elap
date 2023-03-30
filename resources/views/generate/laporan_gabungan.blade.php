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
        margin-bottom: 20px;
        width: 2000px;
    }

    table tr :nth-child(1) {
        font-weight: bold;
    }

    .break-type {
        background-color: chartreuse;
        font-weight: bold;
    }

    .footer-total {
        background-color: aqua;
        font-weight: bold;
    }

    .page_break {
        page-break-before: always;
    }
</style>

<body>
    <center>
        <h3 class="mb-5 p-0">GEREJA PROTESTAN di INDONESIA bagian BARAT</h3>
        <h3 class="mb-5 p-0">{{ strtoupper($department->department_name) }}</h3>
        <div class="mb-5"></div>
        <h3 class="mb-5 p-0">PROGRAM KERJA DAN ANGGARAN TAHUN {{ $year->year_name }}</h3>
        <div class="mb-5"></div>
        <h3 class="mb-5 p-0">TEMA SENTRAL</h3>
        <h3 class="mb-5 p-0">Yesus Kristus Sumber Damai Sejahtera</h3>
        <h3 class="mb-5 p-0">(Yoh. 14 : 27)</h3>
        <div class="mb-5"></div>
        <h3 class="mb-5 p-0">TEMA KUPPG JANGKA PENDEK IV</h3>
        <h3 class="mb-5 p-0">Membangun sinergi dalam hubungan gereja dan masyarakat untuk mewujudkan Kasih Allah yang
            meliputi seluruh ciptaan-Nya</h3>
        <h3 class="mb-5 p-0">(Mat. 22 ; 37 - 39; Ul, 6 : 5; Im. 19 : 18)</h3>
        <div class="mb-5"></div>
        <h3 class="mb-5 p-0">TEMA TAHUN 2023 - 2024</h3>
        <h3 class="mb-5 p-0">Memberdayakan Warga Gereja secara Intergenerasional Guna Merawat Jejaring Sosial dan
            Ekologis di Konteks Budaya Digita</h3>
        <h3 class="mb-5 p-0">(Ef. 4 : 11 - 16)</h3>
        <div class="mb-5"></div>
        <h3 class="mb-5 p-0">BIDANG PRIORITAS :</h3>
        <h3 class="mb-5 p-0">GERMASA & TEOLOGI - PERSIDANGAN GEREJA</h3>

    </center>

    <table border="1" class="mt-20">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">NAMA PROGRAM</th>
                <th rowspan="2">TUJUAN</th>
                <th rowspan="2">PENANGGUNG JAWAB PROGRAM</th>
                <th rowspan="2">PENOPANG PROGRAM</th>
                <th colspan="3">PELAKSANAAN</th>
                <th colspan="2">INDIKATOR KEBERHASILAN</th>
                <th colspan="2">ANGGARAN</th>
                <th rowspan="2">KETERANGAN</th>
            </tr>
            <tr>
                <th>WAKTU</th>
                <th>TEMPAT</th>
                <th>FREKUENSI</th>
                <th>KUALITATIF</th>
                <th>KUANTITATIF</th>
                <th>PENERIMAAN</th>
                <th>PENGELUARAN</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @php
                $count_rutin = count(
                    array_filter($list->toArray(), function ($p) {
                        return $p['type']['name'] == 'RUTIN';
                    }),
                );
            @endphp
            @if ($count_rutin > 0)
                <tr class="break-type">
                    <td colspan="11">
                        <h2>PROGRAM RUTIN</h2>
                    </td>
                </tr>
            @endif
            @foreach ($list as $val)
                @if ($val->type->name == 'RUTIN')
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->tujuan }}</td>
                        <td>{{ $val->pjp->department_name }}</td>
                        @php
                            $commission_name = [];
                            foreach ($val->pp as $item) {
                                array_push($commission_name, $item->commission->name);
                            }
                        @endphp
                        <td>{{ implode(', ', $commission_name) }}</td>
                        <td>{{ $val->waktu }}</td>
                        <td>{{ $val->tempat }}</td>
                        <td>{{ $val->frekuensi }}</td>
                        <td>{{ $val->indicator_kualitatif }}</td>
                        <td>{{ $val->indicator_kuantitatif }}</td>
                        <td>{{ $val->rencana_penerimaan }}</td>
                        <td>{{ $val->rencana_pengeluaran }}</td>
                        <td>{{ $val->keterangan }}</td>
                    </tr>
                    @php $no++; @endphp
                @endif
            @endforeach

            @php $no=1; @endphp
            @php
                $count_non_rutin = count(
                    array_filter($list->toArray(), function ($p) {
                        return $p['type']['name'] == 'NON RUTIN';
                    }),
                );
            @endphp
            @if ($count_non_rutin > 0)
                <tr class="break-type">
                    <td colspan="11">
                        <h2>PROGRAM NON RUTIN</h2>
                    </td>
                </tr>
            @endif
            @foreach ($list as $val)
                @if ($val->type->name == 'NON RUTIN')
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->tujuan }}</td>
                        <td>{{ $val->pjp->department_name }}</td>
                        @php
                            $commission_name = [];
                            foreach ($val->pp as $item) {
                                array_push($commission_name, $item->commission->name);
                            }
                        @endphp
                        <td>{{ implode(', ', $commission_name) }}</td>
                        <td>{{ $val->waktu }}</td>
                        <td>{{ $val->tempat }}</td>
                        <td>{{ $val->frekuensi }}</td>
                        <td>{{ $val->indicator_kualitatif }}</td>
                        <td>{{ $val->indicator_kuantitatif }}</td>
                        <td>{{ $val->rencana_penerimaan }}</td>
                        <td>{{ $val->rencana_pengeluaran }}</td>
                        <td>{{ $val->keterangan }}</td>
                    </tr>
                    @php $no++; @endphp
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>
