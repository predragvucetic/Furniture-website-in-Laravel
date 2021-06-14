@extends('layouts.layout')

@section('title')
    Single Product
@endsection

@section('content')
<!-- breadcrumb -->
@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="{{ route('home-page') }}" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    @if($product->newPrice)
    <a href="{{ route('sale-page') }}" class="s-text16">
        Sale
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    @else
    <a href="{{ route('products-page') }}" class="s-text16">
        Products
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    @endif

    <a href="{{ url('/products/' . $product->collectionName ) }}" class="s-text16">
        {{ $product->collectionName }}
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ url('/products/' . $product->collectionName . '/' . $product->categoryName ) }}" class="s-text16">
        {{ $product->categoryName }}
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">
        {{ $product->name }}
    </span>
</div>

<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
    <div class="flex-w flex-sb">
        <div class="w-size13 p-t-30 respon5">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots"></div>

                <div class="slick3">
                    @foreach($images as $image)
                    <div class="item-slick3" data-thumb="{{ asset('images/products/' . $image->url) }}">
                        <div class="wrap-pic-w">
                            <img src="{{ asset('images/products/' . $image->url) }}" alt="IMG-PRODUCT">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-size14 p-t-30 respon5">
            <h4 class="product-detail-name m-text16 p-b-13">
                {{ $product->name }}
            </h4>

            @if(empty($product->newPrice))
            <span class="m-text17">
                {{ $product->price }} €
            </span>
            @else
            <span class="m-text17" style="text-decoration: line-through">
                {{ $product->price }} €
            </span>
                &nbsp;&nbsp;&nbsp;

            <span class="m-text17" style="color: #e65540">
                {{ $product->newPrice }} €
            </span>
            @endif

            <!--  -->
            @if(session()->has("user"))
            <div class="p-t-33 p-b-60">

                <div class="flex-r-m flex-w p-t-10">
                    <div class="w-size16 flex-m flex-w">
                        <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                            <a href="{{ url('/cart/' . $product->id) }}">
                                <input type="submit" id="cart" name="cart" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="Add to Cart">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="p-b-45">
                <span class="s-text8 m-r-35">Collection: {{ $product->collectionName }}</span>
                <span class="s-text8">Categories: {{ $product->categoryName }}</span>
            </div>

            <!--  -->
            <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Description
                    <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>

                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <p class="s-text8">
                        {{ $product->description }}
                    </p>
                </div>
            </div>

            <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Product size
                    <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>

                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <p class="s-text8">
                        <b>Size (width / depth / height):</b><br> {{ $product->dimensions }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

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

    $('.btn-addcart-product-detail').each(function(){
        var nameProduct = $('.product-detail-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
</script>

<!--===============================================================================================-->
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
@endsection
