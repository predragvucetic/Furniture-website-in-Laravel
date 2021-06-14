@extends('layouts.layout')

@section('title')
    Login
@endsection

@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('images/cover-login.jpg') }});">
        <!--<h2 class="l-text2 t-center">
            Login
        </h2>-->
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-60" style="margin-bottom: 80px">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session()->has('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-md-6 p-b-30">
                    <div class="p-r-20 p-r-0-lg">
                        <img src="{{ asset('images/login.jpg') }}" style="width: 550px">
                    </div>
                </div>

                <div class="col-md-6 p-b-30">
                    <form action="{{ url("/login") }}" method="POST">
                        <h4 class="m-text26 p-b-36 p-t-15">
                            Sign In
                        </h4>

                        @csrf

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email Address">
                        </div>

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password" placeholder="Password">
                        </div>

                        <div class="w-size25">
                            <!-- Button -->
                            <input type="submit" name="login" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" value="Sign In">
                        </div>

                        <br/>
                        <h6>Don't have an account? <a href="{{ route('registration-form') }}">Sign Up</a></h6>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
    <!-- Container Selection -->
    <div id="dropDownSelect1"></div>
    <div id="dropDownSelect2"></div>



    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });

        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect2')
        });
    </script>
    <!--===============================================================================================-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
    <script src="{{ asset('js/map-custom.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/main.js') }}"></script>

    </body>
    </html>
@endsection
