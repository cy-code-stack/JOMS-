@extends('../base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/authentication/registration.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
@endsection
@section('navbar')
    @include('includes/nav')
@endsection
@section('content')

<style>
.passwordStrengthWrapper{
    display:flex;
}
#passwordStrengthText{
    font-size:12px;
    font-weight: bold;
    display:flex;
}
 #passwordColor{
     display: block;
    margin: 5px;
      width: 50%;
    text-align: left;
  background-color:#D3D3D3;
    border-radius:10px;
    margin-right:10px;
        
 }
 
  #passwordStrength{
     height:100%;
     border-radius:10px;
    
 }
 
  #passwordStrengthText span{
    position:static;
    transform: translateY(0);
    margin-left:5px;
 }
</style>
<div class="main-register-container">
    <form  action="{{route('register-submit')}}" method="POST">
    @csrf  
      
        <div class="main-register">
        @if($errors->count() > 0)
                <div class="alert alert-danger">{{$errors->first()}}</div>       
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
            <h4>Sign up</h4>
            <p >
                Already have an account? <a href="{{url('/login/customer')}}" style="color:black;margin-left:5px;font-weight:300"><b>Sign in</b></a>
            </p>
                <div class="names">
                    <div class="firstname">
                        <label for="">Firstname</label>
                        <input type="text" name="firstname" id=""  value="{{old('firstname')}}" placeholder="Enter firstname" required>
                    </div>
                    <div class="lastname">
                        <label for="">Lastname</label>
                        <input type="text" name="lastname" id="" value="{{old('lastname')}}" placeholder="Enter lastname" required>
                    </div>
                </div>
                <div class="inputs">
                    <div class="mobilenumber">
                        <label for="">Mobile Number</label><br>
                        <input type="text" name="mobile" id="" value="{{old('mobile')}}" placeholder="09123456789" required>
                    </div>
                    <div class="email">
                        <label for="">Email</label><br>
                        <input type="email" name="email" id="" value="{{old('email')}}" placeholder="email@gmail.com" required>
                    </div>
                    <div class="email">
                        <label for="">Facebook Account</label><br>
                        <input type="text" name="fbLink" id="" value="" placeholder="Facebook account name" required>
                    </div>
                    <div class="email" >
                        <label for="">Client Type</label><br>
                        <select name="custType" id="" required style="width: 99.2%;height: 40px;padding: 10px; border-radius: 2.5px;border: 0.5px solid rgb(201, 201, 201);margin-bottom: 5px; color:rgb(148, 148, 148);"> 
                            <option value="" disabled selected>Either Consignee or Subscriber</option>
                            <option value="Consignee">Consignee</option>
                            <option value="Subscriber">Subscriber</option>
                        </select>
                    </div>
                    <div class="password">
                        <label for="">Password</label><br>
                        <input type="password" name="password" id="passwordInput" placeholder="Password" onkeypress="checkPassword()" required>
                        <span class="fas fa-eye-slash" aria-hidden="true" onclick="togglePasswordVisibility('passwordInput')" id="passwordInputtoggleIcon"></span>
                    </div>
                    <div class="passwordStrengthWrapper">
                        
                         <div id="passwordColor">
                               <div id="passwordStrength"></div>
                         </div>
                      
                        <div id="passwordStrengthText">
                            
                        </div>
                    </div>
                    
                    <div class="password">
                        <label for="">Confirm Password</label><br>
                        <input type="password" name="conPassword" id="passwordInputConfirm" placeholder="Password" required>
                        <span class="fas fa-eye-slash" aria-hidden="true" onclick="togglePasswordVisibility('passwordInputConfirm')" id="passwordInputConfirmtoggleIcon"></span>
                    </div>
                </div>
                <div class="register-btns">
                    <button type="submit">Sign up</button>
                </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


@if($errors->count() > 0)
    <script>
        $(document).ready(function() {
            $('#addCustomer').modal('show');
            console.log('ss');
            setTimeout(function() {
                $(".alert-danger").fadeOut();
       
            }, 1000);
        });

    </script>    
@endif

<script>
    function checkPassword() {
        var password = document.getElementById("passwordInput").value;
        var passwordStrengthBar = document.getElementById("passwordStrength");
        var passwordStrengthText = document.getElementById("passwordStrengthText");

        // Check the length of the password
        var lengthValid = password.length >= 8;

        // Check if the password contains a mix of uppercase and lowercase letters
        var uppercaseValid = /[A-Z]/.test(password);
        var lowercaseValid = /[a-z]/.test(password);

        // Check if the password contains at least one number
        var numberValid = /\d/.test(password);

        // Check if the password contains at least one special character
        var specialCharValid = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        // Calculate the overall strength
        var strength = 0;
        if (lengthValid) strength++;
        if (uppercaseValid) strength++;
        if (lowercaseValid) strength++;
        if (numberValid) strength++;
        if (specialCharValid) strength++;

        // Display the strength
        var strengthText = "";
        if (strength < 3) {
            passwordStrengthText.innerHTML = "Password Strength: <span style='color:red'>Weak</span>"
            passwordStrengthBar.style.width = '30%'
            passwordStrengthBar.style.backgroundColor = 'red'
        } else if (strength < 5) {
            passwordStrengthText.innerHTML = 'Password Strength: <span style="color:orange">Moderate</span>'
            passwordStrengthBar.style.width = '60%'
            passwordStrengthBar.style.backgroundColor = 'orange'
        } else {
            passwordStrengthText.innerHTML = 'Password Strength: <span style="color:green">Strong</span>'
            passwordStrengthBar.style.width = '100%'
            passwordStrengthBar.style.backgroundColor = 'green'
        }

        
    }
</script>


@if(Session::has('success'))
    <!-- Modal View -->
    <script>
      
      Swal.fire({
        text: "{{Session::get('success')}}",
        icon: 'success', 
        confirmButtonText: 'Ok'

        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ url('/user-option') }}";
        }
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

<script>
        function togglePasswordVisibility(fieldID) {
            var passwordInput = document.getElementById(fieldID);
            var toggleIcon = document.getElementById(fieldID + "toggleIcon");
            
            console.log(toggleIcon)

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

@endsection