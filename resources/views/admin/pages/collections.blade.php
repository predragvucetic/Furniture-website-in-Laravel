@extends("layouts.admin")
@section("content")
    @empty($form)
        @include("admin.components.collections.table")
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
            @include('admin.components.collections.edit_form')
            @break
            @case('insert')
            @include('admin.components.collections.insert_form')
            @break
        @endswitch
    @endisset
@endsection
