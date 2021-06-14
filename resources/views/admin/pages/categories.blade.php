@extends("layouts.admin")
@section("content")
    @empty($form)
        @include("admin.components.categories.table")
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
            @include('admin.components.categories.edit_form')
            @break
            @case('insert')
            @include('admin.components.categories.insert_form')
            @break
        @endswitch
    @endisset
@endsection
