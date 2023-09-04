@extends('admin/index')

@section('content')
    @php
        $url_base = 'program_kerja';
        $url_lampiran = 'program_kerja_attachment';
        $add = true;
        $edit = true;
        $delete = true;
        if (auth()->user()->role == 4) {
            $url_base_acc = 'head/' . $url_base . '_acc_head';
            $url_base = 'head/' . $url_base . '_head';
            $url_lampiran = 'head/' . $url_lampiran . '_head';
            $add = false;
            $edit = false;
            $delete = false;
        } elseif (auth()->user()->role == 3) {
            $url_base_acc = 'department/' . $url_base . '_acc';
            $url_base = 'department/' . $url_base;
            $url_lampiran = 'department/' . $url_lampiran;
        }
    @endphp
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            Rencana Program Kerja Anggaran
        </p>

        @if (Session::has('status'))
            <div class="alert alert-success mt-3 text-center">
                {{ Session::get('status') }}
                @php
                    Session::forget('status');
                @endphp
            </div>
        @endif

        <div class="row px-4 justify-content-between">
            <select class="form-select bg-realblue text-white p-2 font-weight-bold rounded" onchange="changeYear(this)">
                @foreach ($data['year'] as $year)
                    <option value="{{ $year->year_name }}" @if ($year->year_name == $data['curr_year']) selected @endif>
                        {{ $year->year_name }}</option>
                @endforeach
            </select>
            @if ($add == true)
                <div>
                    <a class="btn btn-realgreen mr-2" data-toggle="modal" data-target="#uploadModal">Upload Program Kerja</a>
                    <a class="btn btn-realblue" href="{{ url($url_base . '/create') }}">Tambah Program Kerja</a>
                </div>
            @endif
        </div>

        <div class="container my-2" style="min-height: 50vh">
            <div class="row mt-3">
                <div class="col-md-12">
                    <table id="tableData" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Program</th>
                                <th>Tahun</th>
                                <th>Status ACC</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($data['list']) == 0)
                                <tr>
                                    <td colspan="6" align="center">TIDAK ADA DATA</td>
                                </tr>
                            @endif
                            @php $no=1; @endphp
                            @foreach ($data['list'] as $item)
                                <tr>
                                    <td>{{ $no }}.</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->year->year_name }}</td>
                                    <td>{{ $item->acc == 1 ? 'Sudah ACC' : 'Belum ACC' }}</td>
                                    <td>
                                        <a class="btn btn-realgreen w-100 mb-2"
                                            href="{{ url($url_base . '/' . $item->id) }}">Detail</a>
                                        <a class="btn btn-realblue w-100 mb-2"
                                            href="{{ url($url_base_acc . '/' . $item->id) }}">{{ $item->acc == 1 ? 'Batalkan ACC' : 'ACC' }}</a>
                                        @if ($delete == true)
                                            <form action="{{ url($url_base, $item->id) }}" method="POST"
                                                enctype=multipart/form-data>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-realred w-100"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                        @endif
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

    <!-- modal addModal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModal">Upload Program Kerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('department/program-kerja-upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Upload File</label>
                            <input type="file" class="form-control-file" name="uploaded_file">
                        </div>

                        <a target="_blank" href="{{ url('assets/template/template-program-kerja.xls') }}">Download Template</a>

                        <button type="submit" class="btn btn-realblue w-100 mt-4">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal addModal -->
@endsection

@section('footerjs')
    <script>
        function changeYear(e) {
            let year = e.value;
            window.location.href = "{{ url($url_base) }}?year=" + year
        }
    </script>
@endsection
