@extends('user/index')

@section('content')
    <main>
        @php
            $url_triwulan_generate = 'laporan_triwulan_generate';
            $url_gabungan_generate = 'laporan_gabungan_generate';
            if (auth()->user()->role == 4) {
                $url_triwulan_generate = 'head/' . $url_triwulan_generate . '_head';
                $url_gabungan_generate = 'head/' . $url_gabungan_generate . '_head';
            } elseif (auth()->user()->role == 5) {
                $url_triwulan_generate = 'kabid/' . $url_triwulan_generate . '_kabid';
                $url_gabungan_generate = 'kabid/' . $url_gabungan_generate . '_kabid';
            } elseif (auth()->user()->role == 3) {
                $url_triwulan_generate = 'department/' . $url_triwulan_generate;
                $url_gabungan_generate = 'department/' . $url_gabungan_generate;
            }
        @endphp
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            Generate Laporan
        </p>

        <div class="px-4">
            <div class="card">
                <div class="card-header">
                    Laporan Per Triwulan
                </div>
                <div class="card-body">
                    <form target="_blank" action="{{ url($url_triwulan_generate) }}" method="GET">
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
                    <form target="_blank" action="{{ url($url_gabungan_generate) }}" method="GET">
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
