
@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/authentication/login.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
@endsection


@section('navbar')
    @include('includes/nav')
@endsection

@section('content')
<div class="main-container">
<div class="log-container">
    <div class="img-container">
        <img src="{{asset('img/gtechlogo.png')}}" alt="logo">

        @if($usertype == 'customer')
            <h6 class="d-flex">
                Don't have an account? <a href="{{route('register')}}" style="color:black;margin-left:5px;font-weight:300"><b>Sign up</b></a>
            </h6>
        @endif
        
        
                
        <div class="form-container">       
            <form  action="{{route('login-user')}}" method="POST">
            @csrf
                <!-- <p>Email or password is incorect</p>
                <p>Invalid email</p>
                <p>The email are already exists</p>
                <p>All fields are required</p> -->     
                <!-- @foreach ($errors->all() as $error)
                    <span class="text-danger">{{ $error }}</span>
                @endforeach -->

        
                @if($errors->count() > 0)
                    <div class="alert alert-danger">{{$errors->first()}}</div>       
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                
                @if($usertype == 'customer')
                <label>Account id<br>
                    <div class="input-with-icon">
                        <i class="fas fa-user" aria-hidden="true"></i>
                        <input type="text" name="user_id" value="{{old('user_id')}}" placeholder="Account id" >
                    </div>
                </label><br>  
                @else

                <label>Email<br>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                        <input type="text" name="user_email" value="{{old('user_email')}}" placeholder="Email@example.com" >
                    </div>
                </label><br>
                @endif
                
            
              
                <label>Password<br>
                    <div class="input-with-icon">
                        <i class="fas fa-key" aria-hidden="true"></i>
                        <input type="password" name="user_password" id="passwordInput" placeholder="Password">
                        <span class="fas fa-eye-slash" aria-hidden="true" onclick="togglePasswordVisibility()" id="toggleIcon"></span>
                    </div>
                </label>

                <input type="text" name="usertype"  value="{{$usertype}}" hidden>
                
                @if($usertype == 'customer')
                <div class="forgot-pass">
                    <a href="/recovery"><p>Forgot Password</p></a>
                </div>
                @endif
                
                <div class="btn-container">
                    <button type="submit" value="Sign in" class="btn">Sign In</button>
                </div>
                </form>
        </div>
    </div>
    <!-- <div class="div-bg">
        <p>this is the other bg</p>
    </div> -->
    </div>
</div>

<!-- <script type="text/javascript" src="{{asset('/js-bootstrap/bootstrap.min.js')}}"></script> -->

@endsection

<script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            var toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            }
        }
    </script>