@extends('layouts.layout')

@section('title')
    Sale
@endsection

@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url({{ asset('images/sale.jpg') }});">
        <!--<h2 class="l-text2 t-center">
            Sale
        </h2>-->
    </section>

    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <!-- Content page -->
    <section class="bgwhite p-t-55 p-b-65">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                    <div class="leftbar p-r-20 p-r-0-sm">

                        <?php

                        $arrayCollection = [];

                        foreach ($collections as $collection){
                            $arrayCollection[$collection->id] = $collection->name;
                        }

                        $arrayCategory = [];

                        foreach ($categories as $category){
                            $arrayCategory[$category->id] = $category->name;
                        }
                        //dd($arrayCategory);

                        $path = Request::path();
                        $explode = explode("/", $path);
                        //dd($explode[2]);
                        ?>

                        <h4 class="m-text14 p-b-7">
                            Collections
                        </h4>

                        <ul class="p-b-54">
                            <li class="p-t-4">
                                @if(!empty($explode[2]) && (in_array($explode[2], $arrayCategory)))
                                    <a href="{{ route('sale-page', $explode[2] ) }}" class="s-text13">
                                        All
                                    </a>
                                @else
                                    <a href="{{ route('sale-page') }}" class="s-text13">
                                        All
                                    </a>
                                @endif
                            </li>

                            @foreach($collections as $collection)
                                @if(!empty($explode[2]) && (in_array($explode[2], $arrayCategory)))
                                    <li class="p-t-4">
                                        <a href="{{ route('sale-page', $collection->name . "/" . $explode[2] ) }}" class="s-text13">
                                            {{ $collection->name }}
                                        </a>
                                    </li>
                                @else
                                    <li class="p-t-4">
                                        <a href="{{ route('sale-page', $collection->name) }}" class="s-text13">
                                            {{ $collection->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <!--  -->
                        <h4 class="m-text14 p-b-32">
                            Categories
                        </h4>

                        <ul class="p-b-54">
                            <li class="p-t-4">
                                @if(!empty($explode[1]) && (in_array($explode[1], $arrayCollection)))
                                    <a href="{{ route('sale-page', $explode[1] ) }}" class="s-text13">
                                        All
                                    </a>
                                @else
                                    <a href="{{ route('sale-page') }}" class="s-text13">
                                        All
                                    </a>
                                @endif
                            </li>

                            @foreach($categories as $category)
                                <li class="p-t-4">
                                    @if(!empty($explode[1]) && (in_array($explode[1], $arrayCollection)))
                                        <a href="{{ route('sale-page', [ $explode[1] . "/" . $category->name ]) }}" class="s-text13">
                                            {{ $category->name }}
                                        </a>
                                    @elseif(!empty($explode[1]) && (!in_array($explode[1], $arrayCollection)))
                                        <a href="{{ route('sale-page', $category->name ) }}" class="s-text13">
                                            {{ $category->name }}
                                        </a>
                                    @else
                                        <a href="{{ route('sale-page', $category->name ) }}" class="s-text13">
                                            {{ $category->name }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <div class="search-product pos-relative bo4 of-hidden">
                            <form action="{{ route('search-sale-products') }}" method="GET">
                                <input class="s-text7 size6 p-l-23 p-r-50" type="text" id="search-sale-products" name="search-sale-product" placeholder="Search Products...">

                                <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                                    <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                    <!--  -->
                    <div class="flex-sb-m flex-w p-b-35">
                        <div class="flex-w">

                            <!--<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                <select class="selection-2" name="sorting">
                                    <option>Price</option>
                                    <option>$0.00 - $50.00</option>
                                    <option>$50.00 - $100.00</option>
                                    <option>$100.00 - $150.00</option>
                                    <option>$150.00 - $200.00</option>
                                    <option>$200.00+</option>

                                </select>
                            </div>-->

                        </div>

                        <!--<span class="s-text8 p-t-5 p-b-5">
                            Showing 1–12 of 16 results
                        </span>-->
                    </div>

                    <!-- Product -->
                    <div class="row">

                        @foreach($sale as $s)
                            <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                        <img src="{{ asset('images/products/' . $s->url) }}" height="250px" alt="IMG-PRODUCT">

                                        <div class="block2-overlay trans-0-4">
                                            <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                            </a>

                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                                @if(session()->has("user"))

                                                <a href="{{ url('/cart/' . $s->idProduct) }}">
                                                    <input type="submit" id="cart" name="cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="Add to Cart">
                                                </a>

                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt p-t-20">
                                        <a href="{{ url('/products/' . $s->idProduct) }}" class="block2-name dis-block s-text3 p-b-5">
                                            {{ $s->name }}
                                        </a>

                                        <span class="block2-oldprice m-text7 p-r-5">
                                    {{ $s->price }} €
                                </span>

                                        <span class="block2-newprice m-text8 p-r-5">
                                    {{ $s->newPrice }} €
                                </span>
                                    </div>
                                </div>
                            </div>
                    @endforeach

                    </div>

                    <!-- Pagination -->
                    <div class="pagination flex-m flex-w p-t-26" style="padding: 50px; margin-left: 37%">
                        {{ $sale->links() }}
                    </div>

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
    <script type="text/javascript" src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick-custom.js') }}"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $('.block2-btn-addcart').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to cart !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });
    </script>

    <!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset('vendor/noui/nouislider.min.js') }}"></script>
    <script type="text/javascript">
        /*[ No ui ]
        ===========================================================*/
        var filterBar = document.getElementById('filter-bar');

        noUiSlider.create(filterBar, {
            start: [ 50, 200 ],
            connect: true,
            range: {
                'min': 50,
                'max': 200
            }
        });

        var skipValues = [
            document.getElementById('value-lower'),
            document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function( values, handle ) {
            skipValues[handle].innerHTML = Math.round(values[handle]) ;
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/main.js') }}"></script>

    </body>
    </html>
@endsection
