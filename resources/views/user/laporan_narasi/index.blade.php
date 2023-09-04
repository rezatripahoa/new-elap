@extends('user/index')

@section('content')
    @php
        if ($data['page'] == 'Laporan Narasi') {
            $url_base = 'laporan_narasi';
        } else {
            $url_base = 'laporan_kegiatan';
        }
        $url_narasi_generate = 'laporan_narasi_generate';
        $url_program_generate = 'laporan_program_generate';
        if (auth()->user()->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
            $url_narasi_generate = 'head/' . $url_narasi_generate . '_head';
            $url_program_generate = 'head/' . $url_program_generate . '_head';
        } elseif (auth()->user()->role == 5) {
            $url_base = 'kabid/' . $url_base . '_kabid';
            $url_narasi_generate = 'kabid/' . $url_narasi_generate . '_kabid';
            $url_program_generate = 'kabid/' . $url_program_generate . '_kabid';
        } elseif (auth()->user()->role == 3) {
            $url_base = 'department/' . $url_base;
            $url_narasi_generate = 'department/' . $url_narasi_generate;
            $url_program_generate = 'department/' . $url_program_generate;
        }
    @endphp
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            {{$data['page']}}
        </p>

        <div class="row px-4">
            <form class="form-inline" action="{{ url($url_base) }}" method="GET">
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
                                        @if ($data['page'] == 'Laporan Narasi')
                                            <a class="btn btn-realblue w-100 mb-2" target="_blank"
                                                href="{{ url($url_narasi_generate . '/' . $item->id . '?category=' . $data['curr_category']) }}">Print
                                                Laporan Narasi</a>
                                        @elseif($data['page'] == 'Laporan Kegiatan')
                                            <a class="btn btn-realblue w-100 mb-2" target="_blank"
                                                href="{{ url($url_program_generate . '/' . $item->id . '?category=' . $data['curr_category']) }}">Print
                                                Laporan Program</a>
                                        @endif
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
