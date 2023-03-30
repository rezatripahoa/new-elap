@extends('admin/index')

@section('content')
    @php
        $url_narasi = 'laporan_narasi_admin';
        $url_gabungan = 'laporan_gabungan_admin';
        if (auth()->user()->role == 1) {
            $url_narasi = 'admin/' . $url_narasi . '_admin';
            $url_gabungan = 'admin/' . $url_gabungan . '_admin';
        } elseif (auth()->user()->role == 2) {
            $url_narasi = 'report/' . $url_narasi . '_report';
            $url_gabungan = 'report/' . $url_gabungan . '_report';
        }
    @endphp
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            List Department
        </p>

        <div class="container my-2" style="min-height: 50vh">
            <div class="row mt-3">
                <div class="col-md-12">
                    <table id="tableData" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Department</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($data['list'] as $department)
                                <tr>
                                    <td>{{ $no }}.</td>
                                    <td>{{ $department->department_name }}</td>
                                    <td align="center">
                                        {{-- @php $year = date('Y') . ' - ' . date('Y') + 1; @endphp
                                        <a class="btn btn-realblue" href="{{url('admin/report')}}/{{$department->id}}?year={{$year}}">Lihat Laporan</a> --}}
                                        <a class="btn btn-realblue w-100 mb-1"
                                            href="{{ url($url_narasi . '/' . $department->id) }}">Lihat
                                            Laporan Narasi</a>
                                        <a class="btn btn-realblue w-100"
                                            href="{{ url($url_gabungan . '/' . $department->id) }}">Lihat
                                            Laporan Gabungan</a>
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
