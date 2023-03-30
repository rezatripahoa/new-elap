@extends('user/index')

@section('content')
    @php
        $url_base = 'program_kerja';
        if (auth()->user()->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
        } elseif (auth()->user()->role == 3) {
            $url_base = 'department/' . $url_base;
        }
    @endphp
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            List Program Kerja
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
            <a class="btn btn-realblue" href="{{ url($url_base . '/create') }}">Tambah Program Kerja</a>
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
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($data['list'] as $item)
                                <tr>
                                    <td>{{ $no }}.</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->year->year_name }}</td>
                                    <td>
                                        <a class="btn btn-realgreen w-100 mb-2"
                                            href="{{ url($url_base . '/' . $item->id) }}">Detail</a>
                                        <form action="{{ url($url_base, $item->id) }}" method="POST"
                                            enctype=multipart/form-data>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-realred w-100"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                        </form>
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
@endsection
