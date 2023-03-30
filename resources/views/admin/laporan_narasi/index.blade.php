@extends('admin/index')

@section('content')
    @php
        $url_base = 'laporan_narasi_admin';
        $url_narasi = 'laporan_narasi_generate_admin';
        $url_program = 'laporan_program_generate_admin';
        if (auth()->user()->role == 1) {
            $url_base = 'admin/' . $url_base . '_admin';
            $url_narasi = 'admin/' . $url_narasi . '_admin';
            $url_program = 'admin/' . $url_program . '_admin';
        } elseif (auth()->user()->role == 2) {
            $url_base = 'report/' . $url_base . '_report';
            $url_narasi = 'report/' . $url_narasi . '_report';
            $url_program = 'report/' . $url_program . '_report';
        }
    @endphp
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            List Program Kerja {{ $data['department']->department_name }}
        </p>

        <div class="row px-4">
            <form class="form-inline" action="{{ url($url_base . '/' . $data['department']->id) }}" method="GET">
                <div class="form-group mr-2">
                    <select name="year" class="form-control">
                        <option>Pilih Tahun</option>
                        @foreach ($data['year'] as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $data['curr_year']) selected @endif>
                                {{ $item->year_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-2">
                    <select name="category" class="form-control">
                        <option>Pilih Fase Program</option>
                        @foreach ($data['category'] as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $data['curr_category']) selected @endif>
                                {{ $item->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-realblue" type="submit">Apply</button>
                </div>
            </form>
        </div>

        <div class="container my-2" style="min-height: 50vh">
            <div class="row mt-3">
                <div class="col-md-12">
                    <table id="tableData" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Program</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($data['list'] as $item)
                                <tr>
                                    <td>{{ $no }}.</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a class="btn btn-realblue w-100 mb-2" target="_blank"
                                            href="{{ url($url_narasi . '/' . $item->id . '/' . $data['department']->id . '?category=' . $data['curr_category']) }}">Print
                                            Laporan Narasi</a>
                                        <a class="btn btn-realblue w-100 mb-2" target="_blank"
                                            href="{{ url($url_program . '/' . $item->id . '/' . $data['department']->id . '?category=' . $data['curr_category']) }}">Print
                                            Laporan Program</a>
                                    </td>
                                </tr>
                                @php $no++; @endphp
                            @endforeach
                            @if (count($data['list']) == 0)
                                <tr>
                                    <td colspan="3" align="center">Tidak Ada Data (Pilih Tahun dan Kategori Lain)</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
