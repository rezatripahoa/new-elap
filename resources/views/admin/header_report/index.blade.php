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
                                <th>Title</th>
                                <th>Code</th>
                                <th>Deskripsi</th>
                                <th>Surah</th>
                                <th>Order</th>
                                <th>Aktif</th>
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
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->code }}</td>
                                    <td>{{ $list->description }}</td>
                                    <td>{{ $list->surah ?? '' }}</td>
                                    <td>{{ $list->order }}</td>
                                    <td>{{ $list->active }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm mr-2 mb-2 w-100" data-toggle="modal"
                                            data-target="#editModal{{ $list->id }}">Edit</button>
                                        <form action="{{ url('admin/header_report', $list->id) }}" method="POST"
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
                    <form action="{{ url('admin/header_report') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Masukkan Judul</label>
                            <input class="form-control" type="text" name="name" value=""
                                placeholder="Masukkan Judul" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input class="form-control" type="text" name="description" value=""
                                placeholder="Masukkan Deskripsi" required>
                        </div>

                        <div class="form-group">
                            <label>Surah</label>
                            <input class="form-control" type="text" name="surah" value=""
                                placeholder="Masukkan Surah">
                        </div>

                        <div class="form-group">
                            <label>Masukkan Kode</label>
                            <input class="form-control" type="text" name="code" value=""
                                placeholder="Masukkan Kode" required>
                        </div>

                        <div class="form-group">
                            <label>Urutan Tampil</label>
                            <input class="form-control" type="number" name="order" value=""
                                placeholder="Masukkan Urutan" required>
                        </div>

                        <div class="form-group">
                            <select name="active" class="form-control">
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
        <div class="modal fade" id="editModal{{ $list->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editModal{{ $list->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $list->id }}">Tambah {{ $data['title'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ url('admin/header_report', $list->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Masukkan Judul</label>
                                <input class="form-control" type="text" name="name" placeholder="Masukkan Judul"
                                    value="{{ $list->name }}" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input class="form-control" type="text" name="description"
                                    placeholder="Masukkan Deskripsi" value="{{ $list->description }}" required>
                            </div>

                            <div class="form-group">
                                <label>Surah</label>
                                <input class="form-control" type="text" name="surah" value="{{ $list->surah }}"
                                    placeholder="Masukkan Surah">
                            </div>

                            <div class="form-group">
                                <label>Urutan Tampil</label>
                                <input class="form-control" type="number" name="order" placeholder="Masukkan Urutan"
                                    value="{{ $list->order }}" required>
                            </div>

                            <div class="form-group">
                                <select name="active" class="form-control">
                                    <option value="1" @if ($list->active == 1) selected @endif>Aktif</option>
                                    <option value="0" @if ($list->active == 0) selected @endif>Tidak Aktif
                                    </option>
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
