@extends('admin/index')

@section('content')
    @php
        $url_triwulan = 'laporan_triwulan_generate';
        $url_gabungan = 'laporan_gabungan_generate';
        if (auth()->user()->role == 1) {
            $url_triwulan = 'admin/' . $url_triwulan . '_admin';
            $url_gabungan = 'admin/' . $url_gabungan . '_admin';
        } elseif (auth()->user()->role == 2) {
            $url_triwulan = 'report/' . $url_triwulan . '_report';
            $url_gabungan = 'report/' . $url_gabungan . '_report';
        }
    @endphp
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            Generate Laporan
        </p>

        <div class="px-4">
            <div class="card">
                <div class="card-header">
                    Laporan Per Triwulan
                </div>
                <div class="card-body">
                    <form target="_blank" action="{{ url($url_gabungan . '/' . $data['department']->id) }}" method="GET">
                        <div class="form-group">
                            <label>Pilih Tahun</label>
                            <select name="year" class="form-control">
                                <option>Pilih Tahun</option>
                                @foreach ($data['year'] as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->year_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Fase Program</label>
                            <div>
                                @foreach ($data['category'] as $item)
                                    <div class="form-check form-check-inline">
                                        <input name="category[]" class="form-check-input" type="checkbox"
                                            value="{{ $item->id }}">
                                        <label class="form-check-label">{{ $item->category_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-realblue" type="submit">Generate Laporan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card my-4">
                <div class="card-header">
                    Laporan Gabungan Per Tahun
                </div>
                <div class="card-body">
                    <form target="_blank" action="{{ url($url_gabungan . '/' . $data['department']->id) }}" method="GET">
                        <div class="form-group">
                            <label>Pilih Tahun</label>
                            <select name="year" class="form-control">
                                <option>Pilih Tahun</option>
                                @foreach ($data['year'] as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->year_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-realblue" type="submit">Generate Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
