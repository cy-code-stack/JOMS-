@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/reports.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidenavigation.css')}}">
<style>

 .generate-btn {
     display:flex;
     flex-direction: row;
     justify-content:flex-end;
     margin-bottom:20px;
 }
.generate-btn button {
    height: 30px;
    padding: 5px;
    margin: 5px;
    font-size: 12px;
    background-color: rgb(235, 187, 97);
    border: none;
    border-radius: 3px;
    font-weight: 500;
    color: white;
}
.custom-select{
    margin-top: 5px;
}
</style>

@endsection

@section('navbar')
    @include('includes/sidenavigation')
@endsection

@section('content')

<div class="main-content">

    <div class="top-nav-profile">
        <div class="menu-wrapper">
            <label for="nav-toggle">
                <span class="la la-bars"></span>
            </label>
            <h4>Accomplishment Report</h4>
        </div>

        <div class="user-wrapper">
            @include('includes/profilepopup')          
        </div>
    </div>
    

    <div class="body-content">

        <div class="main-table-content">
             <div class="accomplishment-title">
                <h5>Accomplishment Report</h5>
            </div>
               <div class="generate-btn">
                    <form  action="{{route('sort-status-reports')}}" method="POST">
                    @csrf
                    <label>Sort by </label>
                        <select id="month-select" name="monthSelected" class="custom-select">
                            
            
                            <?php
                                
                                 $months = [
                                    "All" => "All",
                                    "January" => "January",
                                    "February" => "February",
                                    "March" => "March",
                                    "April" => "April",
                                    "May" => "May",
                                    "June" => "June",
                                    "July" => "July",
                                    "August" => "August",
                                    "September" => "September",
                                    "October" => "October",
                                    "November" => "November",
                                    "December" => "December"
                                ];
                            
                                if(!isset($selected)){
                                    $selected = 'All';
                                }
                                foreach ($months as $value => $label) {
                                    $status = ($value === $selected) ? "selected" : "";
                    
                                    echo "<option value='$value' $status>$label</option>";
                                }
                            ?>
                               
    
                            
                            
                        </select>
                 </form>
                   <form method="POST" action="{{route('report-generate-accomplishment-admin')}} ">
                      @csrf 
                 

                              <button type="submit" ><span class="las la-file-pdf"></span>Generate</button>                                                                                                                        
                     
                 
                    </form>                                                                 
                </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Job ID</th>
                        <th>Services</th>
                        <th>Account Number</th>
                        <th>Client name</th>
                        <th>Technician name</th>
                        <th>Address</th>
                        <!--<th>Location Coordinates</th>-->
                        <th>Date Created</th>
                        <th>Date Assigned</th>
                        <th>Date Completed</th>
                        <th>Customer Rating</th>
                    
                        
                    </tr>
                </thead>
                
             
                <tbody>
                    @foreach($jobs as $job)
                    <tr>
                        
                        <td>{{$job->job_id}}</td>
                        <td>{{$job->jobReq->job_type}}</td>
                        <td>{{$job->jobReq->customer_id}}</td>
                        <td>{{$job->client_name}}</td>  
                        <td>{{$job->jobReq->techList->first_name}} {{$job->jobReq->techList->last_name}}</td>
                        <td>{{$job->jobReq->address}}</td>
                        <!--<td>longitude: (x){{$job->jobReq->customer->lng}} <br>latitude(y): {{$job->jobReq->customer->lat}}</td>-->
                        <td>{{$job->jobReq->created_at}}</td>
                        <td>{{$job->jobReq->assigned_at}}</td>
                        <td>{{$job->jobReq->completed_at}}</td>
                          <!-- <td style="max-width:250px, overflow:scrollable"  class="editable-cell hover" data-job-id="{{ $job->id }}" onclick="toggleField(event)">
                              <!--<span class="cell-content">{{ $job->coordinate }}</span>-->
                              <!--<div class="edit-form" style="display: none;">-->
                                  <!--<form action="{{ route('report-edit', $job->id) }}" method="POST">-->
                                      <!--@csrf-->
                                      <!--<input type="text" name="complaintsDescription" id="replaceData{{$job->job_id}}" value="{{$job->complaintsDescription}}" hidden> -->
                                      <!--<textarea name="coordinate" class="form-control">{{ $job->coordinate }}</textarea>-->
                                        <!--<button type="submit" class="btn ">Save</button>-->
                                  <!--</form>-->
                              <!--</div>-->
                          <!--</td -->
                            
                          <td>
                          {{$job->jobReq->rating}}
                          </td>
                         <!--<td style="max-width:250px, overflow:scrollable"  class="editable-cell hover" data-job-id="{{ $job->job_id }}" onclick="toggleField(event)">-->
                         <!--     <span class="cell-content">{{ $job->complaintsDescription }}</span>-->
                         <!--     <div class="edit-form" style="display: none;">-->
                         <!--         <form action="{{ route('report-edit', $job->id) }}" method="POST">-->
                         <!--             @csrf-->
                         <!--             <input type="text" name="coordinate" id="replaceData{{$job->id}}" value="{{$job->coordinate}}" hidden> -->
                         <!--             <textarea name="complaintsDescription" class="form-control">{{ $job->complaintsDescription }}</textarea>-->
                         <!--     <button type="submit" class="btn ">Save</button>-->
                         <!--         </form>-->
                         <!--     </div>-->
                         <!-- </td>-->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
</div>

<script>
      function toggleField(cell) {
        console.log('s');

  
        var cell = event.currentTarget; // Use currentTarget to get the element that the event listener is attached to
        var cellContent = cell.querySelector('.cell-content');
        var editForm = cell.querySelector('.edit-form');

        cellContent.style.display = 'none';
        editForm.style.display = 'block';

        // Focus on the input field for better user experience
        var inputField = editForm.querySelector('input[name="accomplishmentRemarks"]');
        inputField.focus();

    }

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(Session::has('success'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'success',  
            text: "{{ Session::get('success') }}",
        });
    </script>


@endif

@if(Session::has('pdfSuccess'))
    <!-- Modal View -->
    <script>
        // Open PDF in a new tab using JavaScript
        window.open("{{ url('/download-pdf/' . session('filename')) }}", '_blank');
    </script>
@endif




@if(Session::has('fail'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'error',  
            text: "{{Session::get('fail')}}",
        })
        <
@endif

@endsection