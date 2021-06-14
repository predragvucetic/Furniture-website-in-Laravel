@extends("layouts.admin")
@section("content")
    @empty($form)
        @include("admin.components.orders.table")
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
            @include('admin.components.orders.edit_form')
            @break
            @case('insert')
            @include('admin.components.orders.insert_form')
            @break
        @endswitch
    @endisset
@endsection
