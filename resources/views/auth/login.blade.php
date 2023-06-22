@extends('auth/index')

@section('content')
    <div class="container-fluid h-custom" style="height: 90%;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-4 col-xl-4">
                <img src="{{ url('assets/images/logo/logo.png') }}" class="img-fluid" alt="Logo GPIB">
            </div>
            <div class="col-md-8 col-lg-8 col-xl-5 offset-xl-1">
                <h1 class="mb-4">E-Laporan GPIB</h1>
                <div class="card">
                    @if (Session::has('status'))
                        <div class="alert alert-success mt-3 text-center">
                            {{ Session::get('status') }}
                            @php
                                Session::forget('status');
                            @endphp
                        </div>
                    @endif
                    <div class="card-header">
                        <h2>LOGIN</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('login_submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Password</label>
                                <div class="input-group">
                                    <input id="password-input" name="password" type="password" class="form-control"
                                        value="" placeholder="Masukkan password" required>
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
            </div>
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
