@extends('layouts.layout')

@section('title')
    Cart
@endsection

@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ asset('images/cart.jpg') }});">
    <h2 class="l-text2 t-center">
        Cart
    </h2>
</section>

@if(session()->has('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <table class="table-shopping-cart">
                    <tr class="table-head">
                        <th class="column-1"></th>
                        <th class="column-2">Product Name</th>
                        <th class="column-4">Price</th>
                    </tr>

                    @if(session()->has("products"))

                    @foreach((session("products")) as $product)

                    <tr class="table-row">
                        <td class="column-1">
                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                <img src="{{ asset("images/products/" . $product->url) }}" alt="IMG-PRODUCT">
                            </div>
                        </td>
                        <td class="column-2" >{{ $product->name }}</td>
                        @if(empty($product->newPrice))
                        <td class="column-4">{{ $product->price }}</td>
                        @else
                        <td class="column-4">{{ $product->newPrice }}</td>
                        @endif
                        <td class="column-5" style="float: right">
                            <a href="{{ route('delete-from-cart', ['id' => $product->id]) }}" class="btn btn-danger waves-effect btn-xs"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                    @endforeach

                    @else
                        <tr class="table-row">
                            <td class="column-1"></td>
                            <td class="column-2" >No products added.</td>
                            <td class="column-4"></td>
                            <td class="column-4"></td>
                            <td class="column-5" style="float: right"></td>
                        </tr>
                    @endif

                </table>
            </div>
        </div>

        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm">
                <h5 class="m-text20 p-b-24" style="margin-left: 50px; margin-top: 20px">Total:</h5>
            </div>

            <div class="size10 trans-0-4 m-t-10 m-b-10" style="margin-right: 210px">
                @if(session()->has("products"))
                <?php
                    $total = 0.00;
                    foreach (session("products") as $product)
                        if(empty($product->newPrice)){
                            $total += $product->price;
                        }
                        else{
                            $total += $product->newPrice;
                        }
                ?>

                <span class="m-text21 w-size20 w-full-sm" style="color: black; font-weight: bold">
                    {{ $total }}
                </span>

                @else

                <span class="m-text21 w-size20 w-full-sm" style="color: black; font-weight: bold">
                    0.00
                </span>

                @endif

                <!-- Button -->
                <!--<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                    Update Cart
                </button>-->
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Total -->
        <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <form action="{{ url('/cart') }}" method="POST">
                <h5 class="m-text20 p-b-24">
                    Cart Totals
                </h5>
                @csrf
                <!--  -->
                <div class="flex-w flex-sb-m p-b-12">
                        <span class="s-text18 w-size19 w-full-sm">
                            Subtotal:
                        </span>

                    @if(empty($total))
                    <span class="m-text21 w-size20 w-full-sm">
                        0.00
                    </span>
                    @else
                    <span class="m-text21 w-size20 w-full-sm">
                        {{ $total }}
                    </span>
                    @endif
                </div>

                <!--  -->
                <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                        <span class="s-text18 w-size19 w-full-sm">
                            Shipping:
                        </span>

                    <div class="w-size20 w-full-sm">
                        <p class="s-text8 p-b-23">
                            <?php
                                $shipping = 49;
                            ?>
                            {{ $shipping . ".00" }}
                        </p>

                        <span class="s-text19">
                            Your Information
                        </span>

                        <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="firstName" placeholder="First Name">
                        </div>

                        <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="lastName" placeholder="Last Name">
                        </div>

                        <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="email" placeholder="Email">
                        </div>

                        <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="country" placeholder="Country">
                        </div>

                        <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="city" placeholder="City">
                        </div>

                        <div class="size13 bo4 m-b-22">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode">
                        </div>

                        <div class="size13 bo4 m-b-22">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="address" placeholder="Address">
                        </div>

                    </div>
                </div>

                <!--  -->
                <div class="flex-w flex-sb-m p-t-26 p-b-30">
                    <span class="m-text22 w-size19 w-full-sm">
                        Total:
                    </span>

                    @if(empty($total))
                    <span class="m-text21 w-size20 w-full-sm">
                        0.00
                    </span>
                    @else
                    <span class="m-text21 w-size20 w-full-sm">
                        {{ $total + $shipping . ".00" }}
                    </span>
                    @endif
                </div>

                <div class="size15 trans-0-4">
                    <a href="{{ url('/cart') }}">
                        <input type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" value="Confirm">
                    </a>
                    <!--<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        Confirm
                    </button>-->
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
<script src="{{ asset('js/main.js') }}"></script>


</body>
</html>
@endsection
