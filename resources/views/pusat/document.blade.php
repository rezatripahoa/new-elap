@extends('pusat/index')

@section('content')
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            List Laporan
        </p>

        <div class="p-2">
            <select class="form-select bg-realblue text-white p-2 font-weight-bold rounded" onchange="changeYear(this, {{$data['department']->id}})">
                @foreach ($data['year'] as $year)
                    <option value="{{ $year->year_name }}" @if ($year->year_name == $data['curr_year']) selected @endif>
                        {{ $year->year_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="container my-2" style="min-height: 50vh">
            <div class="row mt-3">
                <div class="col-md-12">
                    <table id="tableData" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kategori</th>
                                <th>Tahun</th>
                                <th class="text-center">Laporan Narasi</th>
                                <th class="text-center">Laporan Matriks Excel</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($data['category'] as $category)
                                @php
                                    $laporan = $data['list']->where('category_id', $category->id);
                                @endphp
                                <tr>
                                    <td>{{ $no }}.</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $data['curr_year'] }}</td>
                                    <td align="center">
                                        @foreach ($laporan as $val)
                                            @if ($val->department_id == $data['department']->id && $val->document_name == 'LAPORAN KEGIATAN ' . $category->id . ' ' . $data['curr_year'] . '')
                                                <button data-toggle="modal" data-target="#lihatKegiatan_{{ $val->id }}"
                                                    class="btn btn-realblue">Lihat</button>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td align="center">
                                        @foreach ($laporan as $val)
                                            @if ($val->department_id == $data['department']->id && $val->document_name == 'LAPORAN KEUANGAN ' . $category->id . ' ' . $data['curr_year'] . '')
                                                <button data-toggle="modal" data-target="#lihatKeuangan_{{ $val->id }}"
                                                    class="btn btn-realblue">Lihat</button>
                                            @endif
                                        @endforeach
                                    </td>
                                @php $no++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    @foreach ($data['list'] as $laporan)
        <!-- modal modalKegiatan -->
        <div class="modal fade" id="lihatKegiatan_{{ $laporan->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalKegiatan_{{ $laporan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalKegiatan_{{ $laporan->id }}">Laporan Narasi
                            {{ $laporan->category->category_name }} {{ $laporan->year->year_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="d-flex justify-content-between w-100">
                            <label class="mb-1">Download Laporan Narasi</label>
                            <a target="_blank"
                                href="{{ asset('files/reports') }}/{{ $data['department']->department_name }}/{{ $laporan->document_file }}"
                                class="btn btn-realblue">Download</a>
                        </div>

                        <table class="table table-stripped my-3" id="tableKegiatan_1_2022">
                            <thead>
                                <tr>
                                    <th>Nama Lampiran</th>
                                    <th>File Lampiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan->attachment as $attachment)
                                    <tr>
                                        <th>{{ $attachment->attachment_name }}</th>
                                        <th>
                                            <a target="_blank"
                                                href="{{ asset('files/reports') }}/{{ $data['department']->department_name }}/{{ $attachment->attachment_file }}"
                                                class="btn btn-realblue">Download</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal modalKegiatan -->

        <!-- modal modalKeuangan -->
        <div class="modal fade" id="lihatKeuangan_{{ $laporan->id }}" tabindex="-1" role="dialog"
            aria-labelledby="lihatKeuangan_{{ $laporan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lihatKeuangan_{{ $laporan->id }}">Laporan Matriks Excel
                            {{ $laporan->category->category_name }} {{ $laporan->year->year_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="d-flex justify-content-between w-100 mb-3">
                            <label class="mb-1">Download Laporan Matriks Excel</label>
                            <a target="_blank"
                                href="{{ asset('files/reports') }}/{{ $data['department']->department_name }}/{{ $laporan->document_file }}"
                                class="btn btn-realblue">Download</a>
                        </div>

                        {{-- <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Nama Lampiran</th>
                                    <th>File Lampiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan->attachment as $attachment)
                                    <tr>
                                        <th>{{ $attachment->attachment_name }}</th>
                                        <th>
                                            <a target="_blank"
                                                href="{{ asset('files/reports') }}/{{ $data['department']->department_name }}/{{ $attachment->attachment_file }}"
                                                class="btn btn-realblue">Download</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal modalKegiatan -->
    @endforeach
@endsection

@section('footerjs')
    <script>
        function addRow(e) {
            let target = $(e).attr('target');
            let html = ""
            html += "<tr>"
            html += `<td><input class="form-control" type="text" name="attachment_name[]"></td>`
            html +=
                `<td><input class="form-control-file" type="file" name="attachment_file[]"></td>`
            html += `<td><button class="btn btn-danger" onclick="deleteRow(this)">Delete</button></td>`
            html += "</tr>"

            $('#' + target + ' tbody').append(html)
        }

        function deleteRow(e) {
            $(e).parent().parent().remove()
        }

        function changeYear(e, department_id){
            let year = e.value;
            window.location.href="{{url('report/list_report')}}/"+department_id+"?year="+year
        }
    </script>
@endsection
