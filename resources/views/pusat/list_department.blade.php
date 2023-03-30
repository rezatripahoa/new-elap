@extends('admin/index')

@section('content')
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
                                        @php $year = date('Y') . ' - ' . date('Y') + 1; @endphp
                                        <a class="btn btn-realblue"
                                            href="{{ url('report/list_report') }}/{{ $department->id }}?year={{ $year }}">Lihat
                                            Laporan</a>
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
