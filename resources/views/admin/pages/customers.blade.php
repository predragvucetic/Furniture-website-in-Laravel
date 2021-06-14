@extends("layouts.admin")
@section("content")
    @empty($form)
        @include("admin.components.customers.table")
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
            @include('admin.components.customers.edit_form')
            @break
            @case('insert')
            @include('admin.components.customers.insert_form')
            @break
        @endswitch
    @endisset
@endsection
