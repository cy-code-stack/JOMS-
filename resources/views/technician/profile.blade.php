@extends('base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css')}}">
@endsection
@section('navbar')
    @include('includes/nav')
@endsection

@section('content')


<div class="main-container">

<div class="profile-content-parent">

    <div class="main-div">
        <div class="info-container">
            <h2>Profile Information</h2>
            <p>
                Update your account's profile information.
            </p>
        </div>
        <div class="main-profile-container">
            <form method="POST" action="{{ route('profile-edit-tech', $user->id) }}">
            @csrf                       
                <div class="profile-content">
                    <h5>Photo</h5>
                    <div class="image-profile-editable">
                        <img id="image-preview" src="{{ $user->profileImage ? asset('img/' . $user->profileImage) : asset('img/logo-filled.jpg') }}" alt="profile"><br>
                    </div>                                                
                    <input class="editable" type="file" name="profImage" accept="image/*" onchange="previewImage(this)" disabled>
            
                </div>
                <div class="content-profile-form">
                <input type="text" name='reqType' value="profileInfo" hidden><br>
                    
                    <div class="input-flex">
                        <div>
                            <label  for="first-name">Firstname</label><br>
                            <input class="editable" id="first-name" name='firstname' type="text" value="{{$user->first_name}}" disabled><br>
                        </div>
                        
                        <div>
                            <label for="last-name">Lastname</label><br>
                            <input class="editable" id="last-name" name='lastname' type="text" value="{{$user->last_name}}" disabled><br>
                        </div>
                    </div>
                      <label for="email">Email</label><br>
                    <input class="editable" id="email" name="email" type="text" value="{{$user->email}}" disabled> 
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
                Ensure your account by using a long password to stay secure.
            </p>
        </div>
        <div class="main-profile-container">
            <form method="POST" action="{{ route('profile-edit-tech', $user->id) }}">
            @csrf 
                <div class="content-profile-form">
                   
                        <input type="text" name='reqType' value="profilePassword" hidden><br>
                    
                        <label for="">Input Old password</label><br>
                        <input class="editable disable" type="text"  name="oldPassword" disabled><br>
                        <label for="">New Password</label><br>
                        <input class="editable" name="password" type="password" placeholder="New Password" disabled><br>
                        <label for="">Confirm Password</label><br>
                        <input class="editable" name="passwordRetype" type="password" placeholder="Re-type Password" disabled>
                  
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
            <form method="POST" action="{{ route('profile-delete', $user->id) }}">
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
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection