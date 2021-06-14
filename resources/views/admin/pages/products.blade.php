@extends("layouts.admin")
@section("styles")
    <link rel="stylesheet" href="{{ asset("css/admin/summernote.css") }}">
@endsection

@section("content")
    @empty($form)
        @if(session()->has('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif
        <div class="search-product pos-relative bo4 of-hidden" style="margin-bottom: 20px; width: 300px">
            <form action="{{ route('search-admin-products') }}" method="GET">
                <input class="s-text7 size6 p-l-23 p-r-50" type="search" id="search-product" name="search-product" placeholder="Search Products...">

                <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                    <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        @foreach($products as $product)
            @component("admin.components.products.table",[
                'product' => $product,
                'images' => $images
            ])@endcomponent
        @endforeach
    @endempty

    @empty($form)
    <!-- Pagination -->
    <div class="pagination flex-m flex-w p-t-26" style="padding: 50px; margin-left: 30%">
        {{ $products->links() }}
    </div>
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
            @include('admin.components.products.edit_form')
            @break
            @case('insert')
            @include('admin.components.products.insert_form')
            @break
        @endswitch
    @endisset
@endsection

@section('scripts')
    <script src="{{ asset("js/admin/summernote.js") }}"></script>
    <script>
        $("#content").summernote();
    </script>
@endsection

