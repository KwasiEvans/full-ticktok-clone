@if (Session::has('alert.config'))
    @if(config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        Swal.fire({!! Session::pull('alert.config') !!});
    </script>
@endif
