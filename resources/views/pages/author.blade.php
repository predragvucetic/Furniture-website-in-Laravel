@extends('layouts.layout')

@section('title')
    Author
@endsection

@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('images/cover-author.jpg') }});">
        <h2 class="l-text2 t-center">
            Author
        </h2>
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-60">

        <div class="container">
            <div class="row">
                <div class="col-md-6 p-b-30">
                    <div class="p-r-20 p-r-0-lg">
                        <img src="{{ asset('images/author.jpg') }}" style="width: 550px">
                    </div>
                </div>

                <div class="col-md-6 p-b-30">
                    <form>
                        <h4 class="m-text26 p-b-36 p-t-15">
                            Author
                        </h4>

                        @csrf

                        <div class="bo4 of-hidden size15 m-b-20" style="border: none">
                            <h5>Predrag Vučetić</h5>
                        </div>

                        <div class="bo4 of-hidden size15 m-b-20" style="border: none">
                            <p style="color: black">Rođen 03.03.1994. godine u Čačku. Student visoke ICT škole u Beogradu.</p>
                        </div>

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
