<!-- Jquery Core Js -->
<script src="{{ asset("js/admin/jquery.min.js") }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset("js/admin/bootstrap.min.js") }}"></script>

<!-- Select Plugin Js -->
<script src="{{ asset("js/admin/bootstrap-select.min.js") }}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ asset("js/admin/jquery.slimscroll.js") }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset("js/admin/waves.min.js") }}"></script>

<!-- Custom Js -->
<script src="{{ asset("js/admin/admin.js") }}"></script>

<!-- Demo Js -->
<script src="{{ asset("js/admin/demo.js") }}"></script>

<script src="{{ asset("js/admin/toastr.js") }}"></script>

@yield("scripts")

<script>
    @if(Session::has('error'))
    toastr.error("{{ Session::get("error") }}")
    @endif

    @if(Session::has('success'))
    toastr.success("{{ Session::get("success") }}")
    @endif

    @if($errors->any())
    @foreach($errors->all() as $err)
    toastr.info("{{ $err }}");
    @endforeach
    @endif
</script>
