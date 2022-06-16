<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="author" content="" />
        <title>Dashboard - Administrator</title>
        <link href="{{asset('dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('dist/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('dist/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
        <link href="{{asset('dist/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
        <link href="{{asset('dist/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('dist/css/style.css')}}" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" >
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <link href="styles/glDatePicker.default.css" rel="stylesheet" type="text/css">
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
        @yield('css')
</head>
