<header class="shadow-sm">
    <div class="bg-white py-2" style="position: relative; z-index: 10;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4 col-md-2">
                    <a href="{{ url('/') }}">
                        {{-- <img src="{{ asset('assets/images/logo.png') }}" style="width: 100%;"> --}}
                    </a>
                </div>
                <div class="col-2 d-block d-md-none"></div>
                <div id="menu" class="col-6 offset-1 d-none d-md-block">

                </div>
                <div class="col-6 col-md-3">
                    <div>
                        <div class="py-1 px-4 float-right text-center">
                            <a class="bg-realblue text-white px-2 py-1 font-weight-bold h5 rounded"
                                href="{{ url('logout') }}">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
