@extends('admin/index')

@section('content')
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            List Laporan
        </p>

        <div class="p-2">
            <select class="form-select bg-realblue text-white p-2 font-weight-bold rounded">
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
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
                                <th>Laporan Narasi</th>
                                <th>Laporan Matriks Excel</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1. </td>
                                <td>Triwulan 1</td>
                                <td>2022 - 2023</td>
                                <td>
                                    <button data-toggle="modal" data-target="#modalKegiatan_1_2022"
                                        class="btn btn-realblue">Lihat</button>
                                </td>
                                <td>
                                    <button class="btn btn-realblue" data-toggle="modal"
                                        data-target="#modalKeuangan_1_2022">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2. </td>
                                <td>Triwulan 2</td>
                                <td>2022 - 2023</td>
                                <td>
                                    <button class="btn btn-realblue">Lihat</button>
                                </td>
                                <td>
                                    <button class="btn btn-realblue">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3. </td>
                                <td>Triwulan 3</td>
                                <td>2022 - 2023</td>
                                <td>
                                    <button class="btn btn-realblue">Lihat</button>
                                </td>
                                <td>
                                    <button class="btn btn-realblue">Lihat</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4. </td>
                                <td>Triwulan 4</td>
                                <td>2022 - 2023</td>
                                <td>
                                    <button class="btn btn-realblue">Lihat</button>
                                </td>
                                <td>
                                    <button class="btn btn-realblue">Lihat</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- modal modalKegiatan -->
    <div class="modal fade" id="modalKegiatan_1_2022" tabindex="-1" role="dialog" aria-labelledby="modalKegiatan_1_2022"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKegiatan_1_2022">Upload Laporan Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('user/ausbildung_document_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="" name="member_id">
                        <div class="form-group">
                            <label class="mb-1">Upload Laporan Narasi (.xlsx)</label>
                            <input class="form-control-file" type="file" name="ktp">
                        </div>

                        <button type="button" class="btn btn-realblue" target="tableKegiatan_1_2022"
                            onclick="addRow(this)">+ Lampiran</button>

                        <table class="table table-stripped my-3" id="tableKegiatan_1_2022">
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
    <div class="modal fade" id="modalKeuangan_1_2022" tabindex="-1" role="dialog" aria-labelledby="modalKeuangan_1_2022"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKeuangan_1_2022">Upload Laporan Matriks Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('user/ausbildung_document_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="" name="member_id">
                        <div class="form-group">
                            <label class="mb-1">Upload Laporan Matriks Excel</label>
                            <input class="form-control-file" type="file" name="ktp">
                        </div>

                        <table class="table table-stripped">
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
@endsection

@section('footerjs')
    <script>
        function addRow(e) {
            let target = $(e).attr('target');
            let html = ""
            html += "<tr>"
            html += `<td><input class="form-control-file" type="text" name="title[]"></td>`
            html += `<td><input class="form-control-file" type="file" name="lampiran[]"></td>`
            html += `<td><button class="btn btn-danger" onclick="deleteRow(this)">Delete</button></td>`
            html += "</tr>"

            $('#' + target + ' tbody').append(html)
        }

        function deleteRow(e) {
            $(e).parent().parent().remove()
        }
    </script>
@endsection
