@extends('user/index')

@section('content')
    @php
        $url_base = 'program_kerja_attachment';
        if (auth()->user()->role == 4) {
            $url_base = 'head/' . $url_base . '_head';
        } elseif (auth()->user()->role == 3) {
            $url_base = 'department/' . $url_base;
        }
    @endphp
    <main>
        <p class="text-center text-secondary font-weight-bold h2 p-3">
            File Lampiran
        </p>

        <div class="container my-2" style="min-height: 50vh">
            <form action="{{ url($url_base) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="program_kerja" value="{{ $data['program_kerja']->id }}">
                <div id="form-content">
                    @if (count($data['program_kerja']->attachment) > 0)
                        @foreach ($data['program_kerja']->attachment as $key => $attachment)
                            <div id="form-content">
                                <div class="card" id="attachment{{ $key }}">
                                    <div class="card-header text-right">
                                        <button onclick="remove({{ $key }})" class="btn btn-danger">X</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Nama File</label>
                                            <input type="text" class="form-control" name="name[]"
                                                placeholder="Masukkan Nama File" value="{{ $attachment->name }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Deskripsi File</label>
                                            <input type="text" class="form-control" name="description[]"
                                                placeholder="Masukkan Deskripsi File" value="{{ $attachment->description }}"
                                                required>
                                        </div>

                                        <input type="hidden" name="file_old[]" value="{{ $attachment->file }}">

                                        <div class="text-center">
                                            <img style="width: 150px;" id="img-view{{ $key }}"
                                                src="{{ url('assets/images/attachments/' . $data['program_kerja']->id . '/' . $attachment->file) }}"
                                                alt="image">
                                        </div>

                                        <div class="form-group">
                                            <label>Upload File Lampiran</label>
                                            <input onchange="updateImage(this,{{ $key }})" type="file"
                                                class="form-control" name="file[]" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card" id="attachment1">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama File</label>
                                    <input type="text" class="form-control" name="name[]"
                                        placeholder="Masukkan Nama File" required>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi File</label>
                                    <input type="text" class="form-control" name="description[]"
                                        placeholder="Masukkan Deskripsi File" required>
                                </div>

                                <div class="text-center">
                                    <img style="width: 150px;" id="img-view1" src="" alt="image">
                                </div>

                                <div class="form-group">
                                    <label>Upload File Lampiran</label>
                                    <input onchange="updateImage(this,1)" type="file" class="form-control" name="file[]"
                                        accept="image/*" required>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="my-2 text-right">
                    <button type="button" class="btn btn-realblue" onclick="addCard()">Tambah File (+)</button>
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
        function readURL(input, index) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#img-view' + index).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        function updateImage(e, index) {
            readURL(e, index);
        }

        function remove(index) {
            $('#attachment' + index).remove()
        }

        function addCard() {
            const nextIndex = $('.card').length + 1;
            let html = `<div class="card mt-2" id="attachment${nextIndex}">
                    <div class="card-header text-right">
                        <button onclick="remove(${nextIndex})" class="btn btn-danger">X</button>
                    </div>
                    
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama File</label>
                            <input type="text" class="form-control" name="name[]" placeholder="Masukkan Nama File"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi File</label>
                            <input type="text" class="form-control" name="description[]"
                                placeholder="Masukkan Deskripsi File" required>
                        </div>

                        <div class="text-center">
                            <img style="width: 150px;" id="img-view${nextIndex}" src="" alt="image">
                        </div>

                        <div class="form-group">
                            <label>Upload File Lampiran</label>
                            <input onchange="updateImage(this,${nextIndex})" type="file" class="form-control" name="file[]"
                                accept="image/*" required>
                        </div>
                    </div>
                </div>`
            $('#form-content').append(html);
        }
    </script>
@endsection
