@extends('auth/index')

@section('content')
    <div class="card col-11 col-md-4 p-2">
        <img src="{{ url('assets/images/logo/logo.png') }}" alt="Logo GPIB" width="150" class="m-auto">
        <h2 class="card-title text-center">E-Document</h2>
        <hr>
        <h3 class="card-title text-center">Ganti Password</h3>
        <div class="card-body">
            @if (Session::has('status'))
                <div class="alert alert-success mt-3 text-center">
                    {{ Session::get('status') }}
                    @php
                        Session::forget('status');
                    @endphp
                </div>
            @endif
            <form action="{{ url('change_password_submit') }}" method="post">
                @csrf
                <div id="old_password" class="form-group">
                    <label class="control-label mb-1">Masukkan Password Lama</label>
                    <div class="input-group">
                        <input id="password-input" name="password" type="password" class="form-control" value=""
                            placeholder="Masukkan password" required>
                        <div class="input-group-append">
                            <span id="eye-password" class="input-group-text" onclick="togglePassword('eye','old_password')"><i
                                    class="fa fa-eye"></i></span>
                            <span id="eye-slash-password" class="input-group-text" style="display: none;"
                                onclick="togglePassword('slash','old_password')"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <div id="new_password" class="form-group">
                    <label class="control-label mb-1">Masukkan Password Baru</label>
                    <div class="input-group">
                        <input id="password-input" name="new_password" type="password" class="form-control" value=""
                            placeholder="Masukkan password" required>
                        <div class="input-group-append">
                            <span id="eye-password" class="input-group-text" onclick="togglePassword('eye','new_password')"><i
                                    class="fa fa-eye"></i></span>
                            <span id="eye-slash-password" class="input-group-text" style="display: none;"
                                onclick="togglePassword('slash','new_password')"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('footerjs')
    <script>
        function togglePassword(type, pass) {
            if (type === 'slash') {
                $('#'+pass+' #eye-password').show()
                $('#'+pass+' #eye-slash-password').hide()
                $('#'+pass+' #password-input').attr('type', 'password')
            } else {
                $('#'+pass+' #eye-password').hide()
                $('#'+pass+' #eye-slash-password').show()
                $('#'+pass+' #password-input').attr('type', 'text')
            }
        }
    </script>
@endsection
