<table>
    <tr>
        <td colspan="13" align="center" style="font-size: 14px; font-weight: bold;">
            GEREJA PROTESTAN di INDONESIA bagian BARAT
        </td>
    </tr>
    <tr>
        <td colspan="13" align="center" style="font-size: 14px; font-weight: bold;">
            {{ strtoupper($department->department_name) }}
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td colspan="13" align="center" style="font-size: 14px; font-weight: bold;">
            PROGRAM KERJA DAN ANGGARAN TAHUN {{ $year->year_name }}
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>
    @foreach ($header_reports as $item)
        <tr>
            <td colspan="13" align="center" style="font-size: 14px; font-weight: bold;">
                {{ $item->name }}
            </td>
        </tr>
        <tr>
            <td colspan="13" align="center" style="font-size: 14px; font-weight: bold;">
                {{ $item->description }}
            </td>
        </tr>
        @if ($item->surah && $item->surah != '')
            <tr>
                <td colspan="13" align="center" style="font-size: 14px; font-weight: bold;">
                    {{ $item->surah }}
                </td>
            </tr>
        @endif
        <tr>
            <td></td>
        </tr>
    @endforeach
    <tr>
        <td></td>
    </tr>
</table>
<table style="border:1px solid black;">
    <thead>
        <tr>
            <th rowspan="2" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">NO
            </th>
            <th rowspan="2" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                NAMA PROGRAM
            </th>
            <th rowspan="2" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                TUJUAN</th>
            <th rowspan="2" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                PENANGGUNG
                JAWAB PROGRAM</th>
            <th rowspan="2" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                PENOPANG
                PROGRAM</th>
            <th colspan="3" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                PELAKSANAAN
            </th>
            <th colspan="2" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                INDIKATOR
                KEBERHASILAN</th>
            <th colspan="2" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                ANGGARAN</th>
            <th rowspan="2" valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                KETERANGAN
            </th>
        </tr>
        <tr>
            <th valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                WAKTU</th>
            <th valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                TEMPAT</th>
            <th valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                FREKUENSI</th>
            <th valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                KUALITATIF</th>
            <th valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                KUANTITATIF</th>
            <th valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                PENERIMAAN</th>
            <th valign="middle" align="center" style="font-weight: bold; background-color: #90ee90;">
                PENGELUARAN</th>
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
            <tr>
                <td colspan="13" style="background-color: #00ffff; font-size: 20px; font-weight: bold;">
                    <h2>PROGRAM RUTIN</h2>
                </td>
            </tr>
        @endif
        @php
            $total_penerimaan_rutin = 0;
            $total_pengeluaran_rutin = 0;
        @endphp
        @foreach ($list as $val)
            @if ($val->type->name == 'RUTIN')
                <tr>
                    <td align="center">{{ $no }}</td>
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
                    <td>{{ $val->jadwal_start }}</td>
                    <td>{{ $val->lokasi }}</td>
                    <td>{{ $val->frekuensi }}</td>
                    <td>{{ $val->indicator_kualitatif }}</td>
                    <td>{{ $val->indicator_kuantitatif }}</td>
                    <td data-format="Rp#,##0_-" style="color: #00008b">{{ $val->rencana_penerimaan }}</td>
                    <td data-format="Rp#,##0_-" style="color:#dc143c">{{ $val->rencana_pengeluaran }}</td>
                    <td>{{ $val->keterangan }}</td>
                </tr>
                @php
                    $no++;
                    $total_pengeluaran_rutin += $val->rencana_pengeluaran;
                    $total_penerimaan_rutin += $val->rencana_penerimaan;
                @endphp
            @endif
        @endforeach
        <tr class="break-type">
            <td colspan="10" align="right" style="background-color: #808080; font-weight: bold;">
                TOTAL ANGGARAN RUTIN
            </td>
            <td data-format="Rp#,##0_-" style="background-color: #808080; font-weight: bold;color: #00008b;">
                {{ $total_pengeluaran_rutin }}
            </td>
            <td data-format="Rp#,##0_-" style="background-color: #808080; font-weight: bold;color:#dc143c">
                {{ $total_penerimaan_rutin }}
            </td>
            <td style="background-color: #808080;"></td>
        </tr>
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
                <td colspan="13" style="background-color: #00ffff; font-size: 20px; font-weight: bold;">
                    <h2>PROGRAM NON RUTIN</h2>
                </td>
            </tr>
        @endif
        @php
            $total_penerimaan_non_rutin = 0;
            $total_pengeluaran_non_rutin = 0;
        @endphp
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
                    <td>{{ $val->jadwal_start }}</td>
                    <td>{{ $val->lokasi }}</td>
                    <td>{{ $val->frekuensi }}</td>
                    <td>{{ $val->indicator_kualitatif }}</td>
                    <td>{{ $val->indicator_kuantitatif }}</td>
                    <td data-format="Rp#,##0_-" style="color: #00008b">{{ $val->rencana_penerimaan }}</td>
                    <td data-format="Rp#,##0_-" style="color:#dc143c">{{ $val->rencana_pengeluaran }}</td>
                    <td>{{ $val->keterangan }}</td>
                </tr>
                @php
                    $no++;
                    $total_pengeluaran_non_rutin += $val->rencana_pengeluaran;
                    $total_penerimaan_non_rutin += $val->rencana_penerimaan;
                @endphp
            @endif
        @endforeach
        <tr class="break-type">
            <td colspan="10" align="right" style="background-color: #808080; font-weight: bold;">
                TOTAL ANGGARAN NON RUTIN
            </td>
            <td data-format="Rp#,##0_-" style="background-color: #808080; font-weight: bold;color: #00008b;">
                {{ $total_pengeluaran_non_rutin }}
            </td>
            <td data-format="Rp#,##0_-" style="background-color: #808080; font-weight: bold;color:#dc143c">
                {{ $total_penerimaan_non_rutin }}
            </td>
            <td style="background-color: #808080;"></td>
        </tr>
        @php $no=1; @endphp
        @php
            $count_proyek = count(
                array_filter($list->toArray(), function ($p) {
                    return $p['type']['name'] == 'PROYEK';
                }),
            );
        @endphp
        @if ($count_proyek > 0)
            <tr>
                <td colspan="13" style="background-color: #00ffff; font-size: 20px; font-weight: bold;">
                    <h2>PROGRAM PROYEK</h2>
                </td>
            </tr>
        @endif
        @php
            $total_penerimaan_proyek = 0;
            $total_pengeluaran_proyek = 0;
        @endphp
        @foreach ($list as $val)
            @if ($val->type->name == 'PROYEK')
                <tr>
                    <td align="center">{{ $no }}</td>
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
                    <td>{{ $val->jadwal_start }}</td>
                    <td>{{ $val->lokasi }}</td>
                    <td>{{ $val->frekuensi }}</td>
                    <td>{{ $val->indicator_kualitatif }}</td>
                    <td>{{ $val->indicator_kuantitatif }}</td>
                    <td data-format="Rp#,##0_-" style="color: #00008b">{{ $val->rencana_penerimaan }}</td>
                    <td data-format="Rp#,##0_-" style="color:#dc143c">{{ $val->rencana_pengeluaran }}</td>
                    <td>{{ $val->keterangan }}</td>
                </tr>
                @php
                    $no++;
                    $total_pengeluaran_proyek += $val->rencana_pengeluaran;
                    $total_penerimaan_proyek += $val->rencana_penerimaan;
                @endphp
            @endif
        @endforeach
        <tr class="break-type">
            <td colspan="10" align="right" style="background-color: #808080; font-weight: bold;">
                TOTAL ANGGARAN PROYEK
            </td>
            <td data-format="Rp#,##0_-" style="background-color: #808080; font-weight: bold;color: #00008b;">
                {{ $total_pengeluaran_proyek }}
            </td>
            <td data-format="Rp#,##0_-" style="background-color: #808080; font-weight: bold;color:#dc143c">
                {{ $total_penerimaan_proyek }}
            </td>
            <td style="background-color: #808080;"></td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="9"></td>
            <td colspan="2" align="center" style="font-weight: bold; background-color: #add8e6">
                RANGKUMAN
            </td>
        </tr>
        <tr>
            <td colspan="9"></td>
            <td style="font-weight: bold;">
                PENERIMAAN
            </td>
            <td style="font-weight: bold;">
                PENGELUARAN
            </td>
        </tr>
        <tr>
            <td colspan="9"></td>
            <td data-format="Rp#,##0_-" style="font-weight: bold;color: #00008b;">
                {{ $total_penerimaan_rutin }}
            </td>
            <td data-format="Rp#,##0_-" style="font-weight: bold;color:#dc143c;">
                {{ $total_pengeluaran_rutin }}
            </td>
            <td style="font-weight: bold;">
                RUTIN
            </td>
        </tr>
        <tr>
            <td colspan="9"></td>
            <td data-format="Rp#,##0_-" style="font-weight: bold;color: #00008b;">
                {{ $total_penerimaan_non_rutin }}
            </td>
            <td data-format="Rp#,##0_-" style="font-weight: bold;color:#dc143c;">
                {{ $total_pengeluaran_non_rutin }}
            </td>
            <td style="font-weight: bold;">
                NON RUTIN
            </td>
        </tr>
        <tr>
            <td colspan="9"></td>
            <td data-format="Rp#,##0_-" style="font-weight: bold;color: #00008b;">
                {{ $total_penerimaan_proyek }}
            </td>
            <td data-format="Rp#,##0_-" style="font-weight: bold;color:#dc143c;">
                {{ $total_pengeluaran_proyek }}
            </td>
            <td style="font-weight: bold;">
                PROYEK
            </td>
        </tr>
        <tr>
            <td colspan="9"></td>
            <td data-format="Rp#,##0_-" style="font-weight: bold;color: #00008b;">
                {{ $total_penerimaan_proyek + $total_penerimaan_rutin + $total_penerimaan_non_rutin }}
            </td>
            <td data-format="Rp#,##0_-" style="font-weight: bold;color:#dc143c;">
                {{ $total_pengeluaran_proyek + $total_pengeluaran_rutin + $total_pengeluaran_non_rutin }}
            </td>
            <td style="font-weight: bold;">
                TOTAL
            </td>
        </tr>
    </tbody>
</table>
