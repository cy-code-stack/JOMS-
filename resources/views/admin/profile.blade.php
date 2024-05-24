@extends('base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidenavigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css')}}">

@endsection
@section('navbar')
    @include('includes/sidenavigation')
@endsection

@section('content')

<div class="main-container"  >

<div class="top-nav-profile">
        <div class="menu-wrapper">
            <label for="nav-toggle">
                <span class="la la-bars"></span>
            </label>
            <h4>Profile</h4>
        </div>

        <div class="user-wrapper">
            @include('includes/profilepopup')          
        </div>
    </div>

    <div class="body-content-profile" style="height:100%">

 
    
    <div class="main-div">
        <div class="info-container">
            <h2>Profile Information</h2>
            <p>
                Update your account's profile information.
            </p>
        </div>
        <div class="main-profile-container">
            <form method="POST" action="{{ route('profile-edit-admin', $user->id) }}">
            @csrf                       
                <div class="profile-content">
                    <h5>Photo</h5>
                    <div class="image-profile-editable">
                        <img id="image-preview" src="{{ $user->profileImage ? asset('img/' . $user->profileImage) : asset('img/logo-filled.jpg') }}" alt="profile"><br>
                    </div>
                    <input class="editable inputImage" type="file" name="profImage" accept="image/*" onchange="previewImage(this)" disabled>
            
                </div>
                <div class="content-profile-form">
                <input type="text" name='reqType' value="profileInfo" hidden><br>
                    
                    <div class="input-flex">
                        <div>
                            <label  for="first-name">Firstname</label><br>
                            <input class="editable disable" id="first-name" name='firstname' type="text" placeholder="Firstname" value="{{$user->first_name}}" disabled><br>
                        </div>
                        <div>
                            <label for="last-name">Lastname</label><br>
                            <input class="editable disable" id="last-name" name='lastname' type="text" value="{{$user->last_name}}" disabled><br>
                        </div>
                    </div>
                    <label for="email">Email</label><br>
                    <input class="editable disable" id="email" name="email" type="text"  value="{{$user->email}}" disabled> 
                    </form>
                </div>
                <div class="btn-profile">
                    <button class="edit-button" type="button">Edit</button>
                    <button class="save-button" type="button" style="display: none;">Save</button>
                    <button class="cancel-button" type="button" style="display: none;">Cancel</button>
                </div>  
            </form>
        </div>
    </div>

    <div class="main-div">
        <div class="info-container">
            <h2>Update Password</h2>
            <p>
                Ensure your account by using a long password <br>to stay secure.
            </p>
        </div>
        <div class="main-profile-container">
            <form method="POST" action="{{ route('profile-edit-admin', $user->id) }}">
            @csrf 
                <div class="content-profile-form">
                   
                        <input type="text" name='reqType' value="profilePassword" hidden><br>
                    
                        <label for="">Current Password</label><br>
                        <input type="text"  value="{{$user->password}}" disabled><br>
                        <label for="">New Password</label><br>
                        <input class="editable disable" name="password" type="password" placeholder="New Password" disabled><br>
                        <label for="">Confirm Password</label><br>
                        <input class="editable disable" name="passwordRetype" type="password" placeholder="Re-type Password" disabled>
                  
                </div>
                <div class="btn-profile">
                    <button class="edit-button" type="button">Edit</button>
                    <button class="save-button" type="button" style="display: none;">Save</button>
                    <button class="cancel-button" type="button" style="display: none;">Cancel</button>  
                </div>
            </form>
        </div>
    </div>

    <div class="main-div">
        <div class="info-container">
            <h2>Delete Account</h2>
            <p>
                Permanently delete your account.
            </p>
        </div>
        <div class="main-profile-container">
            <div class="content-profile-form">
                <h4>
                    Once your account is deleted, all of its resources and data will be deleted.
                </h4>
            </div>
            <div class="btn-profile">
            <form method="POST" action="{{ route('profile-delete-admin', $user->id) }}">
            @csrf 
                <button onclick="deleteConfirm(event)" type="button" class="btn btn-danger">Delete Account</button>
        </form>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;

                var formData = new FormData();
                formData.append('image', input.files[0]);
                
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/upload', true);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log('Image uploaded successfully');
                    } else {
                        console.log('Image upload failed');
                    }
                };

                xhr.send(formData);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    
</script>
@endsection