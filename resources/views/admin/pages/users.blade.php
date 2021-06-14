@extends("layouts.admin")
@section("content")
    @empty($form)
        @include("admin.components.users.table")
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
                @include('admin.components.users.edit_form')
            @break
            @case('insert')
                @include('admin.components.users.insert_form')
            @break
        @endswitch
    @endisset
@endsection
