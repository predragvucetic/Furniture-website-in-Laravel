@extends('layouts.layout')

@section('title')
    Products
@endsection

@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url({{ asset('images/products.jpg') }});">
        <h2 class="l-text2 t-center">
            Products
        </h2>
        <p class="m-text13 t-center">
            New Collections 2020
        </p>
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
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-50" style="margin-left: -200px">
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
                                    <a href="{{ route('products-page', $explode[2] ) }}" class="s-text13">
                                        All
                                    </a>
                                @else
                                    <a href="{{ route('products-page') }}" class="s-text13">
                                        All
                                    </a>
                                @endif
                            </li>

                            @foreach($collections as $collection)
                                @if(!empty($explode[2]) && (in_array($explode[2], $arrayCategory)))
                                <li class="p-t-4">
                                    <a href="{{ route('products-page', $collection->name . "/" . $explode[2] ) }}" class="s-text13">
                                        {{ $collection->name }}
                                    </a>
                                </li>
                                @else
                                <li class="p-t-4">
                                    <a href="{{ route('products-page', $collection->name) }}" class="s-text13">
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
                                    <a href="{{ route('products-page', $explode[1] ) }}" class="s-text13">
                                        All
                                    </a>
                                @else
                                    <a href="{{ route('products-page') }}" class="s-text13">
                                        All
                                    </a>
                                @endif
                            </li>

                            @foreach($categories as $category)
                                <li class="p-t-4">
                                    @if(!empty($explode[1]) && (in_array($explode[1], $arrayCollection)))
                                        <a href="{{ route('products-page', [ $explode[1] . "/" . $category->name ]) }}" class="s-text13">
                                            {{ $category->name }}
                                        </a>
                                    @elseif(!empty($explode[1]) && (!in_array($explode[1], $arrayCollection)))
                                        <a href="{{ route('products-page', $category->name ) }}" class="s-text13">
                                            {{ $category->name }}
                                        </a>
                                    @else
                                        <a href="{{ route('products-page', $category->name ) }}" class="s-text13">
                                            {{ $category->name }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach

                        </ul>

                        <div class="search-product pos-relative bo4 of-hidden">
                            <form action="{{ route('search-products') }}" method="GET">
                                <input class="s-text7 size6 p-l-23 p-r-50" type="search" id="search-product" name="search-product" placeholder="Search Products...">

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
                                <select class="selection-2" name="priceSorting">
                                    <option>Price</option>
                                    <option>$0.00 - $50.00</option>
                                    <option>$50.00 - $100.00</option>
                                    <option>$100.00 - $150.00</option>
                                    <option>$150.00 - $200.00</option>
                                    <option>$200.00+</option>

                                </select>
                            </div>-->
                        </div>

                        <!--<div>
                            <button type="button">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-grid-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <a href="#"><path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/></a>
                                </svg>
                            </button>
                            <button type="button">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-grid-3x3-gap-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <a href="#"><path d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z"/></a>
                                </svg>
                            </button>
                        </div>-->

                    </div>

                    <!-- Product -->
                    <div class="row" id="products" style="width: 1200px">

                        @foreach($products as $product)
                            <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                                <!-- Block2 -->
                                <div class="block2">

                                    @if(empty($product->newPrice))
                                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                            <img src="{{ asset('images/products/' . $product->url) }}" height="250px" alt="IMG-PRODUCT">

                                            <div class="block2-overlay trans-0-4">
                                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                </a>

                                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                                    @if(session()->has("user"))

                                                    <a href="{{ url('/cart/' . $product->idProduct) }}">
                                                        <input type="submit" id="cart" name="cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="Add to Cart">
                                                    </a>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="block2-txt p-t-20">
                                            <a href="{{ url('/products/' . $product->idProduct) }}" class="block2-name dis-block s-text3 p-b-5">
                                                {{ $product->name }}
                                            </a>

                                            <span class="block2-price m-text6 p-r-5">
                                    {{ $product->price }} €
                                </span>
                                        </div>
                                    @else
                                        <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
                                            <img src="{{ asset('images/products/' . $product->url) }}" height="250px" alt="IMG-PRODUCT">

                                            <div class="block2-overlay trans-0-4">
                                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                </a>

                                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                                    @if(session()->has("user"))

                                                    <a href="{{ url('/cart/' . $product->idProduct) }}">
                                                        <input type="submit" id="cart" name="cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="Add to Cart">
                                                    </a>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="block2-txt p-t-20">
                                            <a href="{{ url('/products/' . $product->idProduct) }}" class="block2-name dis-block s-text3 p-b-5">
                                                {{ $product->name }}
                                            </a>

                                            <span class="block2-oldprice m-text7 p-r-5">
                                    {{ $product->price }} €
                                </span>

                                            <span class="block2-newprice m-text8 p-r-5">
                                    {{ $product->newPrice }} €
                                </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                    @endforeach

                </div>
                    <!-- Pagination -->
                    <div class="pagination flex-m flex-w p-t-26" style="padding: 50px; margin-left: 23%">
                        {{ $products->links() }}
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
