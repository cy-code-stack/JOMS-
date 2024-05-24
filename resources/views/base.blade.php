<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>C-Tech</title>
    <link rel="shorcut icon" type="x-icon" href="{{asset('img/logo-filled.jpg')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css-bootstrap/bootstrap.min.css')}}">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    
    @yield('css')

</head>
<body>

    @if($section == 'admin')
        <div class="main-container-admin">
            @yield('navbar')
            @yield('content')
        </div>
    @else
        @yield('navbar')
        @yield('content')
    @endif

    

</body>
</html>

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Alertsweet -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="text/javascript" src="{{asset('/js-bootstrap/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


    
<script type="text/javascript" src="{{asset('/js/global.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/profile.js')}}"></script>




