@extends("layouts.admin")
@section('styles')
    <link rel="stylesheet" href="{{ asset("admin/plugins/font-awesome/css/font-awesome.css") }}">
@endsection
@section("content")
    @empty($form)
        @include("admin.components.social.table")
    @endempty

    @isset($form)
        @switch($form)
            @case('edit')
            @include('admin.components.social.edit_form')
            @break
            @case('insert')
            @include('admin.components.social.insert_form')
            @break
        @endswitch
    @endisset
@endsection

@section('scripts')
    <script>
        icon.addEventListener('keyup', function(event){
            $("#fa-icon").attr("class", "fa fa-3x fa-" + event.target.value);
        });
    </script>
@endsection
