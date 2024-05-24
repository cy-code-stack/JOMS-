@extends('../base')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing/useroption.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
@endsection
@section('navbar')
    @include('includes/nav')
@endsection

@section('content') 
<div class="container">
    <div class="row">
        <img src="{{asset('img/gtechlogo.png')}}" alt="logo">
        <h2>User type</h2>
        <div class="col-6 border">
            <a class="dropdown-item" href="{{ route('user-option.type', ['usertype' => 'customer']) }}">Customer</a>
        </div>
        
        <div class="col-6 border">
            <a class="dropdown-item" href="{{ route('user-option.type', ['usertype' => 'tech']) }}">Technician</a>
        </div> 
    </div>
</div>


@if(Session::has('success'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'success',  
            text: "{{Session::get('success')}}",
        })
    </script>
@endif


@if(Session::has('fail'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'error',  
            text: "{{Session::get('fail')}}",    
        })
    </script>
@endif
@endsection