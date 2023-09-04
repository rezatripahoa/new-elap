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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.min.css"
        integrity="sha512-Mvnc3gzZhD8rZtNMHJkotZpdfvAHunpqankLPnj3hXpphETXpxbfr4+oNMOzF179JYu8B8/EqruGdpsH5fNYww=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/css/MonthPicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    @yield('stylecss')
</head>

<body style="overflow-x:hidden;">

    @include('admin/section/header')
    <div class="container">
        <div class="row" style="margin-top:20px;">
            <div class="col-12 col-md-3 bg-realblue p-3">
                @include('admin/section/sidebar')
            </div>
            <div class="col-12 col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
        integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script>
    <script src="{{ asset('assets/js/MonthPicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript"></script>

    @yield('footerjs')
</body>

</html>
