
  @if(!isset($noBurger))
  <link rel="stylesheet" type="text/css" href="{{ asset('css/navigationquerry.css')}}">
  @endif
  
<nav class="navbar navbar-default" style="{{ isset($style) && isset($style->nav) ? $style->nav : '' }}">
    <div class="nav-container">
      
         <div class="burger-menu">&#9776;</div>
        
       
        <div class="navbar-header">
            @if(($navigation == 'customer'))
            <a class="navbar-brand" href="{{url('/customer/dashboard')}}">
                <img src="{{ asset('img/gtechlogo.png') }}" alt="logo">
            </a>
            @elseif(($navigation == 'technician'))
            <a class="navbar-brand" href="{{url('/technician/techTask')}}">
                <img src="{{ asset('img/gtechlogo.png') }}" alt="logo">
            </a>
            @else
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{ asset('img/gtechlogo.png') }}" alt="logo">
            </a>
            @endif
            
        </div>
        <ul class="nav navbar-default">
            @if($navigation == 'homepage')
                
                <li><a href="{{url('user-option')}}">Login</a></li>
            @endif
            @if($navigation == 'useroption')
                @if($currActive == 'login')
                    <li class="active"><a href="#">Login</a></li>
                @else
                    <li><a href="#">Login</a></li>
                @endif
            @endif
            @if($navigation == 'login')
                <!--@if($currActive == 'about')-->
                <!--    <li class="active"><a href="#"></a></li>-->
                <!--@else-->
                <!--    <li><a href="#"></a></li>-->
                <!--@endif-->
                <!--@if($currActive == 'login')-->
                <!--    <li class="active"><a href="#">Login</a></li>-->
                <!--@else-->
                <!--    <li><a href="#">Login</a></li>-->
                <!--@endif-->
            @endif




            @if($navigation == 'customer')
                @if($currActive == 'dashboard')
                    <li class="active"><a href="{{url('customer/dashboard')}}">Services</a></li>
                @else
                    <li><a href="{{url('customer/dashboard')}}">Services</a></li>
                @endif

                @if($currActive == 'jobreq')
                    <li class="active"><a href="{{url('customer/jobreq')}}">Job Request</a></li>
                @else
                    <li><a href="{{url('customer/jobreq')}}">Job Request</a></li>
                @endif

                @if($currActive == 'location')
                    <li class="active"><a href="{{url('customer/location')}}">Location</a></li>
                @else
                    <li><a href="{{url('customer/location')}}">Location</a></li>
                @endif
                
                @if($currActive == 'profile')
                    <li class="active"><a href="{{url('customer/profile')}}">Profile</a></li>
                @else
                    <li><a href="{{url('customer/profile')}}">Profile</a></li>
                @endif
                
                
                <div class="img-profile ">
                    <div class="img-profile-users">
                        <img src="{{ $user->profileImage ? asset('img/' . $user->profileImage) : asset('img/logo-filled.jpg') }}" alt="logo">
                        <i class="fa fa-bell new-notif">
                            <span class="notif">{{ $quotationGenerated + $forVerificationJob }}</span>
                        </i>

                    
                    </div>
                    <span>{{$user->last_name}}</span>
                    <div class="profile-popup hide">
                        <div class='profile-cred'>
                            <div>
                                <span class="profile-name">{{$user->first_name}} {{$user->last_name}}</span>
                                <span class="profile-email">{{$user->email}}</span>
                            </div>
                            <div class="img-popup">
                                <img class="profile-image" src="{{ $user->profileImage ? asset('img/' . $user->profileImage) : asset('img/logo-filled.jpg') }}" alt="logo">
                            </div>
                        </div>
                        <div class='profile-options'>
                            <a href="{{url('customer/profile')}}">

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
                       
                            <a href="{{url('customer/jobreq')}}">
                            <div class="notifDiv"> <i class="las la-file-pdf"></i><span> Quotation Generated</span> <span class="notif">{{$quotationGenerated}}</span> 
                            </div>  
                            </a>  
                            <a href="{{url('customer/jobreq')}}">
                            <div class="notifDiv"> <i class="las la-file-pdf"></i><span> Waiting for Verification</span> <span class="notif">{{$forVerificationJob}}</span> 
                            </div>  
                            </a> 
                        
                        
                    </div>
                    
                </div>
            @endif

            @if($navigation == 'technician')
                @if($currActive == 'task')
                    <li class="active"><a href="{{url('technician/techTask')}}">Task</a></li>
                @else
                    <li><a href="{{url('technician/techTask')}}">Task</a></li>
                @endif

                @if($currActive == 'location')
                    <li class="active"><a href="{{url('technician/location')}}">Customer Location</a></li>
                @else
                    <li><a href="{{url('technician/location')}}">Customer Location</a></li>
                @endif

                @if($currActive == 'reports')
                    <li class="active"><a  href="{{url('technician/reports')}}">Reports</a></li>
                @else
                    <li><a href="{{url('technician/reports')}}">Reports</a></li>
                @endif

                @if($currActive == 'profile')
                    <li class="active"><a href="{{url('technician/profile')}}">Profile</a></li>
                @else
                    <li><a href="{{url('technician/profile')}}">Profile</a></li>
                @endif
                
               
               
               
                <div class="img-profile">
                    <div class="img-profile-users">
                        <img src="{{ $user->profileImage ? asset('img/' . $user->profileImage) : asset('img/logo-filled.jpg') }}" alt="logo">
                        <i class="fa fa-bell new-notif"> <span class="notif">{{$generatedJobsCount}}</span> </i>
                    </div>
                    <span>{{$user->last_name}}</span>
                    <div class="profile-popup hide">
                        <div class='profile-cred'>
                            <div>
                                <span class="profile-name">{{$user->first_name}} {{$user->last_name}}</span>
                                <span class="profile-email">{{$user->email}}</span>
                            </div>
                            <div class="img-popup">
                                <img class="profile-image" src="{{ $user->profileImage ? asset('img/' . $user->profileImage) : asset('img/logo-filled.jpg') }}" alt="logo">
                            </div>
                        </div>
                        <div class='profile-options'>
                            <a href="{{url('technician/profile')}}">

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
                          <a href="{{url('technician/techTask')}}">
                            <div class="notifDiv"> <i class="las la-file-pdf"></i><span>New Assigned</span> <span class="notif">{{$generatedJobsCount}}</span> 
                            </div>  
                        </a> 
                    </div>
                </div>
            @endif
        </ul>
    </div>
</nav>
<script>
    document.querySelector('.burger-menu').addEventListener('click', function() {
  document.querySelector('.nav').classList.toggle('active');
});
</script>



