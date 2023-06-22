@extends('admin/index')

@section('content')
    @php
        $arrJenis = ['PUSAT', 'MUPEL', 'JEMAAT'];
    @endphp
    <main>
        @if (Session::has('status'))
            <div class="alert alert-success mt-3 text-center">
                {{ Session::get('status') }}
                @php
                    Session::forget('status');
                @endphp
            </div>
        @endif

        <div class="row justify-content-between align-items-center p-3">
            <p class="text-center text-secondary font-weight-bold h2">
                List {{ $data['title'] }}
            </p>
            <button data-toggle="modal" data-target="#addModal"
                class="btn btn-realblue btn-sm p-3 font-weight-bold h3 text-uppercase">
                Add {{ $data['title'] }}
            </button>
        </div>


        <div class="container my-2" style="min-height: 50vh">
            <div class="row mt-3">
                <div class="col-md-12">
                    <table id="tableData" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pusat/Mupel/Jemaat</th>
                                <th>Username</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data['list'] as $list)
                                <tr>
                                    <td>{{ $no }} </td>
                                    <td>{{ $list->department_name }}</td>
                                    <td>{{ $list->username }}</td>
                                    <td>{{ $list->jenis }}</td>
                                    <td>{{ $list->department_status }}</td>
                                    <td>
                                        <button class="btn btn-realgreen btn-sm mr-2 mb-2 w-100" data-toggle="modal"
                                            data-target="#editModal{{ $list->department_id }}">Edit</button>
                                        <form action="{{ url('admin/department', $list->department_id) }}" method="POST"
                                            enctype=multipart/form-data>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-realred btn-sm mr-2 mb-2 w-100"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <!-- modal addModal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModal">Tambah {{ $data['title'] }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('admin/department') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="department_name" value=""
                                placeholder="Masukkan Nama Pusat/Mupel/Jemaat" required>
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="text" name="username" value=""
                                placeholder="Masukkan Username" required>
                        </div>

                        <div class="form-group">
                            <select name="jenis" class="form-control" required>
                                <option value="">= Pilih Jenis =</option>
                                @foreach ($arrJenis as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="password" name="password" value=""
                                placeholder="Masukkan Password" required>
                        </div>

                        <div class="form-group">
                            <select name="department_status" class="form-control" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-realblue w-100">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal addModal -->

    @foreach ($data['list'] as $list)
        <!-- modal editModal -->
        <div class="modal fade" id="editModal{{ $list->department_id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel{{ $list->department_id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLable{{ $list->department_id }}">Tambah {{ $data['title'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ url('admin/department', $list->department_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input class="form-control" type="text" name="department_name"
                                    value="{{ $list->department_name }}" placeholder="Masukkan Nama Pusat/Mupel/Jemaat">
                            </div>

                            <div class="form-group">
                                <input class="form-control" type="text" name="username"
                                    value="{{ $list->username }}" placeholder="Masukkan Username">
                            </div>

                            <div class="form-group">
                                <select name="jenis" class="form-control" required>
                                    <option value="">= Pilih Jenis =</option>
                                    @foreach ($arrJenis as $item)
                                        <option value="{{ $item }}"
                                            @if ($list->jenis == $item) selected @endif>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input class="form-control" type="password" name="password"
                                    placeholder="(Jangan diisi jika tidak ingin diganti)">
                            </div>

                            <div class="form-group">
                                <select name="department_status" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-realblue w-100">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal editModal -->
    @endforeach
@endsection
