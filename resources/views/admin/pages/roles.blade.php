@extends("layouts.admin")
@section("content")
    @empty($form)
        @include("admin.components.roles.table")
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
            @include('admin.components.roles.edit_form')
            @break
            @case('insert')
            @include('admin.components.roles.insert_form')
            @break
        @endswitch
    @endisset
@endsection

@section('scripts')
    <script src="{{ asset("admin/plugins/editable-table/mindmup-editabletable.js") }}"></script>

    <script src="{{ asset("admin/js/pages/tables/editable-table.js") }}"></script>
@endsection
