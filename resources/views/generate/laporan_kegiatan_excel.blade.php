<table>
    <tr>
        <td colspan="11" align="center" style="font-size: 14px; font-weight: bold;">
            {{ strtoupper($department->department_name) }}
        </td>
    </tr>
    <tr>
        <td colspan="11" align="center" style="font-size: 14px; font-weight: bold;">
            LAPORAN REALISASI ANGGARAN TAHUN PROGRAM {{ $year->year_name }}
        </td>
    </tr>
    <tr></tr>
</table>
@foreach ($list as $item)
    <table>
        <tr>
            <td colspan="11" align="center" style="font-size: 14px; font-weight: bold;">
                {{ strtoupper($item->category_name) }}
            </td>
        </tr>
    </table>

    <table style="border:1px solid black;">
        <thead>
            <tr>
                <th rowspan="2" valign="middle" align="center" style="font-weight: bold;">NO</th>
                <th rowspan="2" valign="middle" align="center" style="font-weight: bold;">NAMA PROGRAM</th>
                <th rowspan="2" valign="middle" align="center" style="font-weight: bold;">TUJUAN</th>
                <th rowspan="2" valign="middle" align="center" style="font-weight: bold;">JADWAL</th>
                <th rowspan="2" valign="middle" align="center" style="font-weight: bold;">LOKASI</th>
                <th rowspan="2" valign="middle" align="center" style="font-weight: bold;">FREKUENSI</th>
                <th colspan="2" valign="middle" align="center" style="font-weight: bold;">RENCANA</th>
                <th colspan="2" valign="middle" align="center" style="font-weight: bold;">REALISASI</th>
                <th rowspan="2" valign="middle" align="center" style="font-weight: bold;">KETERANGAN</th>
            </tr>
            <tr>
                <th valign="middle" align="center" style="font-weight: bold;">PENERIMAAN</th>
                <th valign="middle" align="center" style="font-weight: bold;">PENGELUARAN</th>
                <th valign="middle" align="center" style="font-weight: bold;">PENERIMAAN</th>
                <th valign="middle" align="center" style="font-weight: bold;">PENGELUARAN</th>
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
                        return $p['program_kerja']['type']['name'] == 'RUTIN';
                    }),
                );
            @endphp
            @if ($count_rutin > 0)
                <tr class="break-type">
                    <td colspan="11" style="background-color: #7fff00; font-size: 20px; font-weight: bold;">
                        <h2>PROGRAM RUTIN</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="11" align="center" style="font-weight: bold;">
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
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->rencana_penerimaan }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->rencana_pengeluaran }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->realisasi_penerimaan }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->realisasi_pengeluaran }}</td>
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
                        return $p['program_kerja']['type']['name'] == 'NON RUTIN';
                    }),
                );
            @endphp
            @if ($count_non_rutin > 0)
                <tr class="break-type">
                    <td colspan="11" style="background-color: #7fff00; font-size: 20px; font-weight: bold;">
                        <h2>PROGRAM NON RUTIN</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="11" align="center" style="font-weight: bold;">
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
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->rencana_penerimaan }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->rencana_pengeluaran }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->realisasi_penerimaan }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->realisasi_pengeluaran }}</td>
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
                        return $p['program_kerja']['type']['name'] == 'PROYEK';
                    }),
                );
            @endphp
            @if ($count_proyek > 0)
                <tr class="break-type">
                    <td colspan="11" style="background-color: #7fff00; font-size: 20px; font-weight: bold;">
                        <h2>PROYEK</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="11" align="center" style="font-weight: bold;">
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
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->rencana_penerimaan }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->rencana_pengeluaran }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->realisasi_penerimaan }}</td>
                        <td data-format="Rp#,##0_-">{{ $val->program_kerja->realisasi_pengeluaran }}</td>
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
            <tr class="footer-total">
                <td colspan="6" align="center" style="font-size: 20px; font-weight: bold; background-color: #00ffff">
                    TOTAL {{ strtoupper($item->category_name) }}
                </td>
                <td data-format="Rp#,##0_-" style="font-size: 20px; font-weight: bold; background-color: #00ffff">
                    {{ $total_rencana_penerimaan }}</td>
                <td data-format="Rp#,##0_-" style="font-size: 20px; font-weight: bold; background-color: #00ffff">
                    {{ $total_rencana_pengeluaran }}</td>
                <td data-format="Rp#,##0_-" style="font-size: 20px; font-weight: bold; background-color: #00ffff">
                    {{ $total_realisasi_penerimaan }}</td>
                <td data-format="Rp#,##0_-" style="font-size: 20px; font-weight: bold; background-color: #00ffff">
                    {{ $total_realisasi_pengeluaran }}</td>
                <td data-format="Rp#,##0_-" style="font-size: 20px; font-weight: bold; background-color: #00ffff">
                </td>
            </tr>
        </tbody>
    </table>
@endforeach
</body>

</html>
