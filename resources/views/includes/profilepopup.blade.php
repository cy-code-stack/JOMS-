<div class="img-profile ">
    <div class="img-profile-users">
        <img src="{{$user->profileImage ? asset('img/' . $user->profileImage) : asset('img/logo-filled.jpg')}}" alt="logo">
        <i class="fa fa-bell new-notif"> <span class="notif">{{$generatedJobsCount}}</span> </i>
    </div> 
    <span>Admin</span>
    <div class="profile-popup hide">
        <div class='profile-cred'>
            <div>
                <span class="profile-name">{{$user->first_name}} {{$user->last_name}}</span>
                <span class="profile-email">{{$user->email}}</span>
            </div>
            <div class="img-popup">
                <img class="profile-image" src="{{$user->profileImage ? asset('img/' . $user->profileImage) : asset('img/logo-filled.jpg')}}" alt="logo">
            </div>
        </div>
        <div class='profile-options'>
            <a href="{{url('admin/profile')}}">
                <div>
                    <img class="profile-option" src="{{ asset('img/profile.png') }}" alt="logo">
                    <span>Profile</span>
                </div>
            </a>
            <a href="{{url('logout')}}">
            <div>
                
                    <img class="profile-option" src="{{ asset('img/logout.png') }}" alt="logo">
            
                    <span>Logout</span>
                
            </div>
            </a>
         
        </div>
         
        <div>
            <form id="status-form" action="{{ route('sort-status') }}" method="POST">
                @csrf
                <input type="text" name="statusSelected" value="pending" hidden>
            </form>
            <div class="notifDiv" onclick="submitStatusForm()">
                <i class="las la-file-pdf"></i><span>Pending Request</span>
                <span class="notif">{{ $generatedJobsCount }}</span>
            </div>
        </div>
        
      
        
    </div>
</div>



<script>
    function submitStatusForm() {
        var form = document.getElementById('status-form');
        form.submit();
    }
</script>