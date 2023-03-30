<!DOCTYPE html>
<html>

<head>

    <title>Document</title>

    <meta property="og:title" content="eGrad.id" />
    <meta property="og:image" content="http://devnew.egrad.id/public/assets/images/favicon.png" />
    <meta property="og:description"
        content="eGrad Memberships Benefit. DISC Test. Up-to-date Job Vacancies Info. Digital Assessment Report. Automatically Will Enter into The Selection of Candidates." />
    <meta name="title" content="eGrad.id" />
    <meta name="description"
        content="eGrad Memberships Benefit. DISC Test. Up-to-date Job Vacancies Info. Digital Assessment Report. Automatically Will Enter into The Selection of Candidates." />

    <meta property="og:url" content="https://egrad.id/" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    @yield('stylecss')
</head>

<body style="overflow-x:hidden;">

    @include('head/section/header')
    <div class="container">
        <div class="row" style="margin-top:20px;">
            <div class="col-12 col-md-3 bg-realblue p-3" style="margin-top: 50px;">
                @include('head/section/sidebar')
            </div>
            <div class="col-12 col-md-9">
                @if (Session::has('status'))
                    <div class="alert alert-success mt-3 text-center">
                        {{ Session::get('status') }}
                        @php
                            Session::forget('status');
                        @endphp
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-menu" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php $year = date('Y') . ' - ' . date('Y') + 1; @endphp

                    <div class="col-12 col-md-3 bg-realblue p-3">
                        <div class="bg-white rounded">
                            <div class="p-3 h6 font-weight-bold">
                                <div class="">
                                    <i class="fa fa-book" style="font-size:20px;"></i>
                                    <a class="text-dark ml-3"
                                        href="{{ url('department/program_kerja?year=' . $year) }}">Program
                                        Kerja</a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded">
                            <div class="p-3 h6 font-weight-bold">
                                <div class="">
                                    <i class="fa fa-book" style="font-size:20px;"></i>
                                    <a class="text-dark ml-3" href="{{ url('department/laporan_narasi') }}">Laporan
                                        Program Kerja</a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded d-none">
                            <div class="p-3 h6 font-weight-bold">
                                <div class="">
                                    <i class="fa fa-book" style="font-size:20px;"></i>
                                    <a class="text-dark ml-3" href="{{ url('department/laporan_gabungan') }}">Laporan
                                        Gabungan</a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded">
                            <div class="p-3 h6 font-weight-bold">
                                <div class="">
                                    <i class="fa fa-book" style="font-size:20px;"></i>
                                    <a class="text-dark ml-3"
                                        href="{{ url('department/dashboard?year=' . $year) }}">Laporan</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>

    <script type="text/javascript"></script>

    @yield('footerjs')
</body>

</html>
