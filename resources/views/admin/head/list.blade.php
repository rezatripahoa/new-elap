@extends('admin/index')

@section('content')
    <main>
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
                                <th>Nama Ketua 1</th>
                                <th>Username</th>
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
                                    <td>{{ $list->head_name }}</td>
                                    <td>{{ $list->username }}</td>
                                    <td>{{ $list->head_status }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm mr-2 mb-2 w-100" data-toggle="modal"
                                            data-target="#editModal{{ $list->heads_id }}">Edit</button>
                                        <form action="{{ url('admin/head', $list->heads_id) }}" method="POST"
                                            enctype=multipart/form-data>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mr-2 mb-2 w-100"
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
                    <form action="{{ url('admin/head') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" name="head_name" value=""
                                placeholder="Masukkan Nama Ketua 1" required>
                        </div>

                        <div class="form-group">
                            <select name="department_id" class="form-control" required>
                                @foreach ($data['department'] as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="text" name="username" value=""
                                placeholder="Masukkan Username" required>
                        </div>

                        {{-- <div class="form-group">
                            <input class="form-control" type="email" name="email" value=""
                                placeholder="Masukkan Email Departement">
                        </div> --}}

                        <div class="form-group">
                            <input class="form-control" type="password" name="password" value=""
                                placeholder="Masukkan Password" required>
                        </div>

                        <div class="form-group">
                            <select name="head_status" class="form-control">
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
        <div class="modal fade" id="editModal{{ $list->heads_id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModal{{ $list->heads_id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $list->heads_id }}">Edit {{ $data['title'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ url('admin/head', $list->heads_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input class="form-control" type="text" name="head_name"
                                    placeholder="Masukkan Nama Ketua 1" value="{{ $list->head_name }}" required>
                            </div>

                            <div class="form-group">
                                <select name="department_id" class="form-control" required>
                                    @foreach ($data['department'] as $department)
                                        <option value="{{ $department->id }}"
                                            @if ($department->id == $list->department_id) selected @endif>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input class="form-control" type="text" name="username"
                                    placeholder="Masukkan Username" value="{{ $list->username }}" required>
                            </div>

                            <div class="form-group">
                                <input class="form-control" type="password" name="password"
                                    placeholder="(Jangan diisi jika tidak ingin diganti)">
                            </div>

                            <div class="form-group">
                                <select name="head_status" class="form-control">
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
