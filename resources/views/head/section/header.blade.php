<header class="shadow-sm">
    <div class="bg-white py-2" style="position: relative; z-index: 10;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4 col-md-2">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" style="width: 100px">
                    </a>
                </div>
                <div class="col-2 d-block d-md-none"></div>
                <div id="menu" class="col-6 offset-1 d-none d-md-block">

                </div>
                <div class="col-6 col-md-3">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-7 my-2 text-center">
                            <div class="border-right border-dark  mr-2">
                                {{ $data['head']->head_name }}
                            </div>
                        </div>
                        <div class="col-12 col-md-5 my-2">
                            <div class="py-1 px-4 float-right text-center">
                                <a class="bg-realblue text-white px-3 py-2 font-weight-bold h5 rounded"
                                    href="{{ url('logout') }}">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
