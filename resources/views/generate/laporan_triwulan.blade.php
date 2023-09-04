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
        <h3 class="mb-5 p-0">{{ strtoupper($department->department_name) }}</h3>
        <h3 class="mb-5 p-0">LAPORAN REALISASI ANGGARAN TAHUN PROGRAM {{ $year->year_name }}</h3>
    </center>
    @foreach ($list as $item)
        <center>
            <h3 class="mb-5 p-0 mt-20">{{ strtoupper($item->category_name) }}</h3>
        </center>

        <table border="1">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">NAMA PROGRAM</th>
                    <th rowspan="2">TUJUAN</th>
                    <th rowspan="2">JADWAL</th>
                    <th rowspan="2">LOKASI</th>
                    <th rowspan="2">FREKUENSI</th>
                    <th colspan="2">RENCANA</th>
                    <th colspan="2">REALISASI</th>
                    <th rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th>PENERIMAAN</th>
                    <th>PENGELUARAN</th>
                    <th>PENERIMAAN</th>
                    <th>PENGELUARAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_rencana_penerimaan = 0;
                    $total_rencana_pengeluaran = 0;
                    $total_realisasi_penerimaan = 0;
                    $total_realisasi_pengeluaran = 0;
                @endphp
                @php $no=1; @endphp
                @php
                    $count_rutin = count(
                        array_filter($item->program_kerja_category->toArray(), function ($p) {
                            return $p['program_kerja']['type'] && $p['program_kerja']['type']['name'] == 'RUTIN';
                        }),
                    );
                @endphp
                @if ($count_rutin > 0)
                    <tr class="break-type">
                        <td colspan="11">
                            <h2>PROGRAM RUTIN</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11" align="center">
                            <h5>PROGRAM RUTIN {{ strtoupper($item->category_name) }}</h5>
                        </td>
                    </tr>
                @endif
                @foreach ($item->program_kerja_category as $val)
                    @if ($val->program_kerja->type->name == 'RUTIN')
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $val->program_kerja->name }}</td>
                            <td>{{ $val->program_kerja->tujuan }}</td>
                            <td>{{ $val->program_kerja->waktu }}</td>
                            <td>{{ $val->program_kerja->lokasi }}</td>
                            <td>{{ $val->program_kerja->frekuensi }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->rencana_penerimaan, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->rencana_pengeluaran, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->realisasi_penerimaan, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->realisasi_pengeluaran, '2', ',', '.') }}</td>
                            <td>{{ $val->program_kerja->keterangan }}</td>
                        </tr>
                        @php $no++; @endphp
                        @php
                            $total_rencana_penerimaan += $val->program_kerja->rencana_penerimaan;
                            $total_rencana_pengeluaran += $val->program_kerja->rencana_pengeluaran;
                            $total_realisasi_penerimaan = $val->program_kerja->realisasi_penerimaan;
                            $total_realisasi_pengeluaran = $val->program_kerja->realisasi_pengeluaran;
                        @endphp
                    @endif
                @endforeach

                @php $no=1; @endphp
                @php
                    $count_non_rutin = count(
                        array_filter($item->program_kerja_category->toArray(), function ($p) {
                            return $p['program_kerja']['type'] && $p['program_kerja']['type']['name'] == 'NON RUTIN';
                        }),
                    );
                @endphp
                @if ($count_non_rutin > 0)
                    <tr class="break-type">
                        <td colspan="11">
                            <h2>PROGRAM NON RUTIN</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11" align="center">
                            <h5>PROGRAM NON RUTIN {{ strtoupper($item->category_name) }}</h5>
                        </td>
                    </tr>
                @endif
                @foreach ($item->program_kerja_category as $val)
                    @if ($val->program_kerja->type->name == 'NON RUTIN')
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $val->program_kerja->name }}</td>
                            <td>{{ $val->program_kerja->tujuan }}</td>
                            <td>{{ $val->program_kerja->waktu }}</td>
                            <td>{{ $val->program_kerja->lokasi }}</td>
                            <td>{{ $val->program_kerja->frekuensi }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->rencana_penerimaan, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->rencana_pengeluaran, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->realisasi_penerimaan, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->realisasi_pengeluaran, '2', ',', '.') }}</td>
                            <td>{{ $val->program_kerja->keterangan }}</td>
                        </tr>
                        @php $no++; @endphp
                        @php
                            $total_rencana_penerimaan += $val->program_kerja->rencana_penerimaan;
                            $total_rencana_pengeluaran += $val->program_kerja->rencana_pengeluaran;
                            $total_realisasi_penerimaan = $val->program_kerja->realisasi_penerimaan;
                            $total_realisasi_pengeluaran = $val->program_kerja->realisasi_pengeluaran;
                        @endphp
                    @endif
                @endforeach

                @php $no=1; @endphp
                @php
                    $count_proyek = count(
                        array_filter($item->program_kerja_category->toArray(), function ($p) {
                            return $p['program_kerja']['type'] && $p['program_kerja']['type']['name'] == 'PROYEK';
                        }),
                    );
                @endphp
                @if ($count_proyek > 0)
                    <tr class="break-type">
                        <td colspan="11">
                            <h2>PROYEK</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11" align="center">
                            <h5>PROYEK {{ strtoupper($item->category_name) }}</h5>
                        </td>
                    </tr>
                @endif
                @foreach ($item->program_kerja_category as $val)
                    @if ($val->program_kerja->type->name == 'PROYEK')
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $val->program_kerja->name }}</td>
                            <td>{{ $val->program_kerja->tujuan }}</td>
                            <td>{{ $val->program_kerja->waktu }}</td>
                            <td>{{ $val->program_kerja->lokasi }}</td>
                            <td>{{ $val->program_kerja->frekuensi }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->rencana_penerimaan, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->rencana_pengeluaran, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->realisasi_penerimaan, '2', ',', '.') }}</td>
                            <td>Rp. {{ number_format($val->program_kerja->realisasi_pengeluaran, '2', ',', '.') }}</td>
                            <td>{{ $val->program_kerja->keterangan }}</td>
                        </tr>
                        @php $no++; @endphp
                        @php
                            $total_rencana_penerimaan += $val->program_kerja->rencana_penerimaan;
                            $total_rencana_pengeluaran += $val->program_kerja->rencana_pengeluaran;
                            $total_realisasi_penerimaan = $val->program_kerja->realisasi_penerimaan;
                            $total_realisasi_pengeluaran = $val->program_kerja->realisasi_pengeluaran;
                        @endphp
                    @endif
                    <tr class="footer-total">
                        <td colspan="6">
                            <h3>TOTAL {{ strtoupper($item->category_name) }}</h3>
                        </td>
                        <td>Rp. {{ number_format($total_rencana_penerimaan, '2', ',', '.') }}</td>
                        <td>Rp. {{ number_format($total_rencana_pengeluaran, '2', ',', '.') }}</td>
                        <td>Rp. {{ number_format($total_realisasi_penerimaan, '2', ',', '.') }}</td>
                        <td>Rp. {{ number_format($total_realisasi_pengeluaran, '2', ',', '.') }}</td>
                        <td></td>
                    </tr>
                    <div class="page_break"></div>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>

</html>
