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
            Tambah Program Kerja
        </p>

        <div class="container my-2" style="min-height: 50vh">
            <form action="{{ url($url_base) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama Program</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Program Kerja">
                </div>

                <div class="form-group">
                    <label>Sifat Program</label>
                    <select class="form-control" name="type_id">
                        <option selected>= Pilih Sifat Program =</option>
                        @foreach ($data['type'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <select class="form-control" name="year_id">
                        <option selected>= Pilih Tahun =</option>
                        @foreach ($data['year'] as $item)
                            <option value="{{ $item->id }}">{{ $item->year_name }}</option>
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

                <div class="form-group">
                    <label>Penanggung Jawab Program</label>
                    <select class="form-control" name="pjp_id">
                        <option selected>= Pilih PJP =</option>
                        @foreach ($data['list_department'] as $item)
                            <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Penopang Program</label>
                    <select class="js-basic-multiple form-control" name="pp[]" multiple="multiple">
                        @foreach ($data['commission'] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tujuan Program</label>
                    <input type="text" class="form-control" name="tujuan" placeholder="Masukkan Tujuan">
                </div>

                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" class="form-control" name="lokasi" placeholder="Masukkan Lokasi">
                </div>

                <div class="form-group">
                    <label>Jadwal</label>
                    <input type="date" class="form-control" name="jadwal_start">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Ruang Lingkup Inscope</label>
                            <input type="text" class="form-control" name="inscope"
                                placeholder="Masukkan Ruang Lingkup Inscope">
                        </div>

                        <div class="col-6">
                            <label>Ruang Lingkup Outscope</label>
                            <input type="text" class="form-control" name="outscope"
                                placeholder="Masukkan Realisasi Outscope">
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <label>Frekuensi</label>
                    <input type="text" class="form-control" name="frekuensi">
                </div>

                <div class="form-group">
                    <label>Jumlah Peserta</label>
                    <input type="number" class="form-control" name="peserta">
                </div>

                <div class="form-group">
                    <label>Evaluasi</label>
                    <input type="text" class="form-control" name="evaluasi" placeholder="Masukkan Evaluasi">
                </div>

                <div class="form-group">
                    <label>Tidak Lanjut</label>
                    <input type="text" class="form-control" name="tindak_lanjut" placeholder="Masukkan Tindak Lanjut">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan"></textarea>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Indikator Kuantitatif</label>
                            <input type="text" class="form-control" name="indikator_kuantitatif"
                                placeholder="Masukkan Indikator Kuantitatif">
                        </div>

                        <div class="col-6">
                            <label>Indikator Kualitatif</label>
                            <input type="text" class="form-control" name="indikator_kualitatif"
                                placeholder="Masukkan Indikator Kualitatif">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Realisasi Kuantitatif</label>
                            <input type="text" class="form-control" name="realisasi_kuantitatif"
                                placeholder="Masukkan Realisasi Kuantitatif">
                        </div>

                        <div class="col-6">
                            <label>Realisasi Kualitatif</label>
                            <input type="text" class="form-control" name="realisasi_kualitatif"
                                placeholder="Masukkan Realisasi Kualitatif">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Rencana Penerimaan</label>
                            <input type="text" class="form-control currency-input" name="rencana_penerimaan">
                        </div>

                        <div class="col-6">
                            <label>Rencana Pengeluaran</label>
                            <input type="text" class="form-control currency-input" name="rencana_pengeluaran">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Realisasi Penerimaan</label>
                            <input type="text" class="form-control currency-input" name="realisasi_penerimaan">
                        </div>

                        <div class="col-6">
                            <label>Realisasi Pengeluaran</label>
                            <input type="text" class="form-control currency-input" name="realisasi_pengeluaran">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Selisih Penerimaan</label>
                            <input type="text" class="form-control" name="selisih_penerimaan" readonly>
                        </div>

                        <div class="col-6">
                            <label>Selisih Pengeluaran</label>
                            <input type="text" class="form-control" name="selisih_pengeluaran" readonly>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-realblue w-100">SIMPAN</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('footerjs')
    <script>
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
