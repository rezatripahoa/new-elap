@extends('auth/index')

@section('content')
    <div class="card col-11 col-md-4 p-2">
        <img src="{{ url('assets/images/logo/logo.png') }}" alt="Logo GPIB" width="150" class="m-auto">
        <h2 class="card-title text-center">E-Laporan</h2>
        <hr>
        <h3 class="card-title text-center">LOGIN</h3>
        <div class="card-body">
            @if (Session::has('status'))
                <div class="alert alert-success mt-3 text-center">
                    {{ Session::get('status') }}
                    @php
                        Session::forget('status');
                    @endphp
                </div>
            @endif
            <form action="{{ url('login_submit') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="control-label mb-1">Password</label>
                    <div class="input-group">
                        <input id="password-input" name="password" type="password" class="form-control" value=""
                            placeholder="Masukkan password" required>
                        <div class="input-group-append">
                            <span id="eye-password" class="input-group-text" onclick="togglePassword('eye')"><i
                                    class="fa fa-eye"></i></span>
                            <span id="eye-slash-password" class="input-group-text" style="display: none;"
                                onclick="togglePassword('slash')"><i class="fa fa-eye-slash"></i></span>
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
        function togglePassword(type) {
            if (type === 'slash') {
                $('#eye-password').show()
                $('#eye-slash-password').hide()
                $('#password-input').attr('type', 'password')
            } else {
                $('#eye-password').hide()
                $('#eye-slash-password').show()
                $('#password-input').attr('type', 'text')
            }
        }
    </script>
@endsection
