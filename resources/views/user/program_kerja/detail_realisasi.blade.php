@extends('user/index')

@section('content')
    @php
        $url_base = 'program_kerja_realisasi';
        $edit = true;
        if (auth()->user()->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
            $edit = false;
        } elseif (auth()->user()->role == 3) {
            $url_base = 'department/' . $url_base;
        }
    @endphp
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            Detail Realisasi Program Kerja
        </p>

        <div class="container my-2" style="min-height: 50vh">
            <form action="{{ url($url_base . '/' . $data['program_kerja_id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Program</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Program Kerja"
                        value="{{ $data['list']->name }}">
                </div>

                <div class="form-group">
                    <label>Sifat Program</label>
                    <select class="form-control" name="type_id">
                        <option value="" selected>= Pilih Sifat Program =</option>
                        @foreach ($data['type'] as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $data['list']->type_id) selected @endif>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <select class="form-control" name="year_id">
                        <option value="" selected>= Pilih Tahun =</option>
                        @foreach ($data['year'] as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $data['list']->year_id) selected @endif>
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
                                    value="{{ $item->id }}" @if (in_array($item->id, $data['category_program'])) checked @endif>
                                <label class="form-check-label">{{ $item->category_name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Penanggung Jawab Program</label>
                    <select class="form-control" name="pjp_id">
                        <option value="" selected>= Pilih PJP =</option>
                        @foreach ($data['list_department'] as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $data['list']->pjp_id) selected @endif>
                                {{ $item->department_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Penopang Program</label>

                    <select class="js-basic-multiple form-control" name="pp[]" multiple="multiple">
                        @foreach ($data['commission'] as $item)
                            <option value="{{ $item->id }}" @if (in_array($item->id, $data['pp_program'])) selected @endif>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tujuan Program</label>
                    <input type="text" class="form-control" name="tujuan" placeholder="Masukkan Tujuan"
                        value="{{ $data['list']->tujuan }}">
                </div>

                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" class="form-control" name="lokasi" placeholder="Masukkan Lokasi"
                        value="{{ $data['list']->lokasi }}">
                </div>

                <div class="card">
                    <div class="card-header fw-bold">Jadwal</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Dari</label>
                                    <input type="date" class="form-control" name="jadwal_start"
                                        value="{{ $data['list']->jadwal_start }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tanggal Sampai</label>
                                    <input type="date" class="form-control" name="jadwal_end"
                                        value="{{ $data['list']->jadwal_end }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <div class="row">
                        <div class="col-6">
                            <label>Ruang Lingkup Inscope</label>
                            <input type="text" class="form-control" name="inscope"
                                placeholder="Masukkan Ruang Lingkup Inscope" value="{{ $data['list']->inscope }}">
                        </div>

                        <div class="col-6">
                            <label>Ruang Lingkup Outscope</label>
                            <input type="text" class="form-control" name="outscope"
                                placeholder="Masukkan Realisasi Outscope" value="{{ $data['list']->outscope }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Frekuensi</label>
                    <input type="text" class="form-control" name="frekuensi" value="{{ $data['list']->frekuensi }}">
                </div>

                <div class="form-group">
                    <label>Jumlah Peserta</label>
                    <input type="number" class="form-control" name="peserta" value="{{ $data['list']->peserta }}">
                </div>

                <div class="form-group">
                    <label>Evaluasi</label>
                    <input type="text" class="form-control" name="evaluasi" placeholder="Masukkan Evaluasi"
                        value="{{ $data['list']->evaluasi }}">
                </div>

                <div class="form-group">
                    <label>Tidak Lanjut</label>
                    <input type="text" class="form-control" name="tindak_lanjut" placeholder="Masukkan Tindak Lanjut"
                        value="{{ $data['list']->tindak_lanjut }}">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan">{{ $data['list']->keterangan }}</textarea>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Indikator Kuantitatif</label>
                            <input type="text" class="form-control" name="indikator_kuantitatif"
                                placeholder="Masukkan Indikator Kuantitatif"
                                value="{{ $data['list']->indikator_kuantitatif }}">
                        </div>

                        <div class="col-6">
                            <label>Indikator Kualitatif</label>
                            <input type="text" class="form-control" name="indikator_kualitatif"
                                placeholder="Masukkan Indikator Kualitatif"
                                value="{{ $data['list']->indikator_kualitatif }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Realisasi Kuantitatif</label>
                            <input type="text" class="form-control" name="realisasi_kuantitatif"
                                placeholder="Masukkan Realisasi Kuantitatif"
                                value="{{ $data['list']->realisasi_kuantitatif }}">
                        </div>

                        <div class="col-6">
                            <label>Realisasi Kualitatif</label>
                            <input type="text" class="form-control" name="realisasi_kualitatif"
                                placeholder="Masukkan Realisasi Kualitatif"
                                value="{{ $data['list']->realisasi_kualitatif }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Rencana Penerimaan</label>
                            <input type="text" class="form-control currency-input" name="rencana_penerimaan"
                                value="{{ $data['list']->rencana_penerimaan }}">
                        </div>

                        <div class="col-6">
                            <label>Rencana Pengeluaran</label>
                            <input type="text" class="form-control currency-input" name="rencana_pengeluaran"
                                value="{{ $data['list']->rencana_pengeluaran }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Realisasi Penerimaan</label>
                            <input type="text" class="form-control currency-input" name="realisasi_penerimaan"
                                value="{{ $data['list']->realisasi_penerimaan }}">
                        </div>

                        <div class="col-6">
                            <label>Realisasi Pengeluaran</label>
                            <input type="text" class="form-control currency-input" name="realisasi_pengeluaran"
                                value="{{ $data['list']->realisasi_pengeluaran }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Selisih Penerimaan</label>
                            <input type="text" class="form-control" name="selisih_penerimaan"
                                value="{{ $data['list']->realisasi_penerimaan - $data['list']->rencana_penerimaan }}"
                                readonly>
                        </div>

                        <div class="col-6">
                            <label>Selisih Pengeluaran</label>
                            <input type="text" class="form-control" name="selisih_pengeluaran"
                                value="{{ $data['list']->rencana_pengeluaran - $data['list']->realisasi_pengeluaran }}"
                                readonly>
                        </div>
                    </div>
                </div>
                @if ($edit == true)
                    <div>
                        <button type="submit" class="btn btn-realblue w-100">UBAH</button>
                    </div>
                @endif
            </form>
        </div>
    </main>
@endsection

@section('footerjs')
    <script>
        $(document).ready(function() {

        })

        $('.currency-input').on('change click keyup input paste', (function(event) {
            $(this).val(function(index, value) {
                return '' + value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(
                    /(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });

            let rencana_penerimaan = $('input[name="rencana_penerimaan"]').val().replace(/,/g, "");
            let rencana_pengeluaran = $('input[name="rencana_pengeluaran"]').val().replace(/,/g, "");
            let realisasi_penerimaan = $('input[name="realisasi_penerimaan"]').val().replace(/,/g, "");
            let realisasi_pengeluaran = $('input[name="realisasi_pengeluaran"]').val().replace(/,/g, "");
            let selisih_penerimaan = 0;
            let selisih_pengeluaran = 0;

            if (rencana_penerimaan != "" && realisasi_penerimaan != "") {
                selisih_penerimaan = parseInt(realisasi_penerimaan) - parseInt(rencana_penerimaan)
            }
            if (rencana_pengeluaran != "" && realisasi_pengeluaran != "") {
                selisih_pengeluaran = parseInt(rencana_pengeluaran) - parseInt(realisasi_pengeluaran)
            }

            $('input[name="selisih_penerimaan"]').val(selisih_penerimaan)
            $('input[name="selisih_pengeluaran"]').val(selisih_pengeluaran)
        }));

        $(document).ready(function() {
            // Default functionality.
            $('.Default').MonthPicker({
                Button: false
            });
            $('.js-basic-multiple').select2();
        });
    </script>
@endsection
