<!DOCTYPE html>
<html lang="en">
@extends('../base')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/authentication/login.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
    
    <style>
        .log-container{
            display: flex;
          justify-content: center;
          align-items: center;
          height: fit-content;
          overflow: hidden;
          flex-direction: column;
          margin-top: 20px;
        }
    </style>
@endsection


    @section('navbar')
        @include('includes/nav')
    @endsection
    
    @section('content')
    <div class="main-container">
        <div class="log-container">
            <div class="img-container">
                <img src="{{asset('img/gtechlogo.png')}}" alt="logo">
                <h5>
                    Recover Account
                </h5>
                <h6>
                    Please enter your email to recover.
                </h6>
            </div>
            <div class="form-container">
               <form  action="{{route('recovery-account')}}" method="POST">
                     @csrf
                    <label>Email<br>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <input type="text" placeholder="Enter your email" name="email" required>
                        </div>
                    </label>
                    <div class="btn-container">
                        <input type="submit" value="Recover" class="btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
   



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


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