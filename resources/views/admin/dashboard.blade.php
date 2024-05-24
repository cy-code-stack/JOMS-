@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidenavigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css')}}">
@endsection


@section('navbar')
    @include('includes/sidenavigation')
@endsection

@section('content')

<div class="main-content">

    <div class="top-nav">
        <div class="menu-wrapper">
            <label for="nav-toggle">
                <span class="la la-bars"></span>
            </label>
            <h4>Dashboard</h4>
        </div>

        <div class="user-wrapper">
            @include('includes/profilepopup')          
        </div>
    </div>
    
    <div class="body-content">

        <div class="cards">
            <div class="card-single">
                <div>
                    <h1>{{$statusCounts['Complete'] ?? 0 }}</h1>
                    <span>Completed Tasks</span>
                </div>
                <div>
                    <span class="las la-clipboard"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1>{{$statusCounts['On-going'] ?? 0 }}</h1>
                    <span>On-going Tasks</span>
                </div>
                <div>
                    <span class="las la-user"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1>{{$statusCounts['Pending'] ?? 0 }}</h1>
                    <span>Tasks Pendings</span>
                </div>
                <div>
                    <span class="las la-clock"></span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1>{{$statusCounts['Aborted'] ?? 0 }}</h1>
                    <span>Tasks Aborted</span>
                </div>
                <div>
                    <span class="las la-clipboard-list"></span>
                </div>
            </div>
        </div>


        <div class="main-table-content">
            <div class="table_header">
                <h2>Job List</h2>
                <div class="select-wrapper">
                    <form  action="{{route('sort-status')}}" method="POST">
                    @csrf
                    <label>Sort by </label>
                        <select id="status-select" name="statusSelected" class="custom-select">
                            
                            @if($selected == 'Pending')
                                <option value="null" disabled>Select..</option>   
                                <option value="Complete" >Complete</option>  
                                <option value="Assigned" >Assigned</option>                      
                                <option value="Pending" selected>Pending</option>
                                <option value="On-going">Ongoing</option>
                                <option value="Aborted">Aborted</option>
                                <option value="Cancelled">Cancelled</option>
                            @elseif($selected == 'On-going')
                                <option value="" disabled>Select..</option>   
                                <option value="Complete" >Complete</option>   
                                <option value="Assigned" >Assigned</option>                        
                                <option value="Pending" >Pending</option>
                                <option value="On-going" selected>Ongoing</option>
                                <option value="Aborted">Aborted</option>
                                <option value="Cancelled">Cancelled</option>
                            @elseif($selected == 'Aborted')
                                <option value="" disabled>Select..</option>  
                                <option value="Assigned" >Assigned</option>                            
                                <option value="Pending" >Pending</option>
                                <option value="On-going" >Ongoing</option>
                                <option value="Aborted" selected>Aborted</option>
                                <option value="Cancelled">Cancelled</option>
                            @elseif($selected == 'Complete')
                                <option value="" disabled>Select..</option>    
                                <option value="Complete" selected>Complete</option>                  
                                <option value="Pending" >Pending</option>
                                <option value="On-going">Ongoing</option>
                                <option value="Aborted">Aborted</option>
                                <option value="Cancelled">Cancelled</option>    
                             @elseif($selected == 'Cancelled')
                                <option value="" disabled>Select..</option>    
                                <option value="Complete">Complete</option>                  
                                <option value="Pending" >Pending</option>
                                <option value="On-going">Ongoing</option>
                                <option value="Aborted">Aborted</option>
                                <option value="Cancelled" selected>Cancelled</option>
                        
                            @else
                                <option value="" disabled selected>Select..</option>   
                                <option value="Complete" >Complete</option>      
                                <option value="Assigned" >Assigned</option>                         
                                <option value="Pending" >Pending</option>
                                <option value="On-going" >Ongoing</option>
                                <option value="Aborted" >Aborted</option>
                                <option value="Cancelled">Cancelled</option>
                            
                            @endif
                            
                        </select>
                 </form>

                </div>
            </div>
            <div class="table-body">
                <table class="table table-striped" width="100%">
                    <thead>
                                
                                <tr>
                                    <td scope="col">Issue ID</td>
                                    <td scope="col">Client Name</td>
                                    <td scope="col">Job type</td>
                                    <td scope="col">Date Started</td>
                                    <td scope="col">Date Completed</td>
                                    <td scope="col">Status</td>
                                   
                                </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach($jobs as $job)
                            @unless($job->job_status == 'Decline')
                                
                          
                        <tr>
                            <td>{{$job->id}}</td>
                             <td>{{$job->customer->first_name}} {{$job->customer->last_name}}</td>
                            <td>{{$job->job_type}}</td>
                            <td>{{$job->created_at}}</td>
                            <td>{{$job->completed_at}}</td>
                            <td >

                                @if ($job->techAssign)
                                    <div class="status">
                                        <div class="{{$job->techAssign->assigned_status}}"></div>
                                        <p>{{$job->techAssign->assigned_status}}</p>
                                    </div>
                                @else
                                        <div class="status">
                                        <div class="{{$job->job_status}}"></div>
                                        <p>{{  $job->job_status }}</p>
                                    </div>
                                @endif

                            </td>
                        </tr>
                        @endunless
                        @endforeach                      
                    </tbody>
                </table>
                <ul class="pagination">
                     {{$jobs->links()}}
                </ul>
                
            </div>
        </div> 


        <!-- <div class="main-table">
            <div class="table_header">
                <h2>Active Technician</h2>

            </div>
            <div class="table-body">
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <td scope="col">Account ID</td>
                            <td scope="col">Job Description</td>
                            <td scope="col">Name</td>
                            <td scope="col">Address</td>
                            <td scope="col">Assigned Technician</td>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td>000001</td>
                            <td>Andrea Torres</td>
                            <td>Purok mangga 123, Panabo City, Davao del Norte</td>
                            <td>toressandrea21@gmail.com</td>
                            <td>
                                Juan Dela Cruz
                            </td>
                        </tr>      
                    </tbody>
                </table>
            </div>
        </div> -->
    </div>
</div> 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(isset($generatedJobsCount) && $generatedJobsCount > 0)
    <script>
        Swal.fire({
            text: "You have {{$generatedJobsCount}} Pending Request.",
            icon: "info",
           confirmButtonText: "Set",
           showCancelButton: true,
          allowOutsideClick: false
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            window.location = "/admin/addjobreq";
          } 
        });
      
    </script>
@endif
@endsection


@if($user->fullAdress == NULL)
    <script>
        Swal.fire({
          text: "Please Set your address",
          confirmButtonText: "Set",
          allowOutsideClick: false
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            window.location = "/customer/location";
          } 
        });
    </script>
@endif
