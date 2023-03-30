@extends('user/index')

@section('content')
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            List Laporan
        </p>

        <div class="p-2">
            <select class="form-select bg-realblue text-white p-2 font-weight-bold rounded" onchange="changeYear(this)">
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
                                        <button data-toggle="modal" data-target="#modalKegiatan_{{ $category->id }}"
                                            class="btn btn-realblue">Upload</button>
                                        @foreach ($laporan as $val)
                                            @if ($val->document_name == 'LAPORAN KEGIATAN ' . $category->id . ' ' . $data['curr_year'] . '')
                                                <button data-toggle="modal" data-target="#lihatKegiatan_{{ $val->id }}"
                                                    class="btn btn-realblue">Lihat</button>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td align="center">
                                        <button class="btn btn-realblue" data-toggle="modal"
                                            data-target="#modalKeuangan_{{ $category->id }}">Upload</button>
                                        @foreach ($laporan as $val)
                                            @if ($val->document_name == 'LAPORAN KEUANGAN ' . $category->id . ' ' . $data['curr_year'] . '')
                                                <button data-toggle="modal" data-target="#lihatKeuangan_{{ $val->id }}"
                                                    class="btn btn-realblue">Lihat</button>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                @php $no++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- modal modalKegiatan -->
    @foreach ($data['category'] as $category)
        <div class="modal fade" id="modalKegiatan_{{ $category->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalKegiatan_{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalKegiatan_{{ $category->id }}">Upload Laporan Narasi
                            {{ $category->category_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ url('department/laporan_kegiatan') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $data['curr_year'] }}" name="curr_year">
                            <input type="hidden" value="{{ $category->id }}" name="category_id">
                            <div class="form-group">
                                <label class="mb-1">Upload Laporan Narasi (.doc atau .pdf)</label>
                                <input class="form-control-file" type="file" name="laporan">
                            </div>

                            <button type="button" class="btn btn-realblue" target="tableKegiatan_{{ $category->id }}"
                                onclick="addRow(this)">+ Lampiran</button>

                            <table class="table table-stripped my-3" id="tableKegiatan_{{ $category->id }}">
                                <thead>
                                    <tr>
                                        <th>Nama Lampiran</th>
                                        <th>File Lampiran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <div>
                                <button type="submit" class="btn btn-realblue w-100">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal modalKegiatan -->

        <!-- modal modalKeuangan -->
        <div class="modal fade" id="modalKeuangan_{{ $category->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalKeuangan_{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalKeuangan_{{ $category->id }}">Upload Laporan Matriks Excel
                            {{ $category->category_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ url('department/laporan_keuangan') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $data['curr_year'] }}" name="curr_year">
                            <input type="hidden" value="{{ $category->id }}" name="category_id">
                            <div class="form-group">
                                <label class="mb-1">Upload Laporan Matriks Excel (.xls atau .xlsx)</label>
                                <input class="form-control-file" type="file" name="laporan"
                                    accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/pdf">
                            </div>

                            {{-- <button type="button" class="btn btn-realblue mb-3"
                                target="tableKeuangan_{{ $category->id }}" onclick="addRow(this)">+ Lampiran</button> --}}

                            {{-- <table class="table table-stripped" id="tableKeuangan_{{ $category->id }}">
                                <thead>
                                    <tr>
                                        <th>Nama Lampiran</th>
                                        <th>File Lampiran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table> --}}

                            <div>
                                <button type="submit" class="btn btn-realblue w-100">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal modalKegiatan -->
    @endforeach

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

                        <table class="table table-stripped">
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

        function changeYear(e){
            let year = e.value;
            window.location.href="{{url('department/dashboard')}}?year="+year
        }
    </script>
@endsection
