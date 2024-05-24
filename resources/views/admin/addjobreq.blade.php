@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer/dashboard.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jobreq.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer/jobreq.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidenavigation.css')}}">
<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />

<style>

    img {
        max-height: 100%;
    }
    .my-leaflet-map-container img {
        max-height: none;
    }
    
    .image-slider {display: none}
    



    .image-slider{
        height:100%;
        border: 1px solid grey;
        margin-bottom:5px;
        min-width: 100%;
        box-sizing: border-box;
    }
    
    
    .image-slider img{
        width: 100%;
      height: 100%;
      border-radius: 5px;
    object-fit: contain;
        
    }
    
    

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
   background-color: rgba(0,0,0,0.8);
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}


.prev {
  left: 0;
  border-radius: 3px 0 0 3px;
}
/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.5);
}

.image-issue{
    position:relative;
    height:30vh;
}

.rowPdf{
        display: flex;
        align-items: center;
        width: 180px;
        border-radius: 10px;
        background: #FFF;
        box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.25);
        height: 65px;
    }
    
     .rowPdf p{
         width:100%;
     }
     
     .rowPdf p{
         width:100%;
         padding: 5px;
     }
    .rowPdf span{
        font-size: 30px;
        color: white;
    }


    .LORETOStyle{
        background-color:rgb(230, 120, 112);
        text-align:center;
        padding: 5px 5px;
        border-radius:10px;
        color:white;
    }
     .LAAKStyle{
        background-color:rgb(87, 69, 66);
        text-align:center;
         padding: 5px 5px;
        border-radius:10px;
        color:white;
    }
     .TAGUMStyle{
        background-color:rgb(135, 145, 26);
        text-align:center;
         padding: 5px 5px;
        border-radius:10px;
        color:white;
    }
     .BANAY2Style{
        background-color:rgb(66, 54, 117);
        text-align:center;
         padding: 5px 5px;
        border-radius:10px;
        color:white;
    }
</style>

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
                <h4>Job Request</h4>
            </div>
            <div class="user-wrapper">
                <div class="user-wrapper">
                    @include('includes/profilepopup')
                
                </div>
            </div>
        </div>
        <div class="body-content">
                <div class="main-table-content">
                    <div class="table_header">
                        <h2>Job Request</h2>
                        <div>
                           <button type="button" data-toggle="modal" data-target="#adminJobReq" style="margin-right: 10px;">Add Job Request</button>
                         
                    <div class="select-wrapper">
                        <form  action="{{route('sort-status-jobReq')}}" method="POST">
                        @csrf
                        <label>Sort by </label>
                            <select id="status-select" name="statusSelected" class="custom-select">
                           
                                <option value="0" {{($selected == '0')? 'selected':''}}>All</option>   
                                <option value="Complete"  {{($selected == 'Complete')? 'selected':''}}>Complete</option>  
                                <option value="Assigned" {{($selected == 'Assigned')? 'selected':''}}>Assigned</option>                      
                                <option value="Pending" {{($selected == 'Pending')? 'selected':''}}>Pending</option>
                                <option value="On-going" {{($selected == 'On-going')? 'selected':''}}>Ongoing</option>
                                <option value="Aborted" {{($selected == 'selected')? 'selected':''}}>Aborted</option>
                                <!--<option value="isAdminCreated">isAdminCreated</option>-->
                                      
                        
                            
                        </select> 
                    </div>
                 </form>
                 
                  <div class="select-wrapper">
                        <form  action="{{route('sort-area-jobReq')}}" method="POST">
                        @csrf
                        
                        <label>Sort by Area</label>
                            <select id="status-selectArea" name="statusSelectedArea" class="custom-select">
                                <option value="0" {{($areaSelected == '0')? 'selected':''}}>All</option>   
                                <option value="TAGUM" {{($areaSelected == 'TAGUM')? 'selected':''}}>Tagum</option>  
                                <option value="LAAK" {{($areaSelected == 'LAAK')? 'selected':''}} >LAAK</option>                      
                                <option value="BANAY2"{{($areaSelected == 'BANAY2')? 'selected':''}} >BANAY2</option>
                                <option value="LORETO" {{($areaSelected == 'LORETO')? 'selected':''}}>LORETO</option>
                        </select> 
                    </div>
                 </form>
                        </div>
                    </div>
                    <div class="table-body">
                        <table class="table table-striped" width="100%">
                            <thead>
                                
                                <tr>
                                    <td scope="col">Issue ID</td>
                                    <td scope="col">Customer Name</td>
                                    <td scope="col">Job type</td>
                                    <td scope="col">Date Requested</td>
                                    <td scope="col">Area</td>
                                    <td scope="col">Status</td>
                                    <td scope="col">Created By admin</td>
                                    <td scope="col">Actions</td>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
                                    <td>{{$job->customer->first_name}} {{$job->customer->last_name}}</td>
                                    <td>{{$job->job_type}}</td>
                                    <td>{{date('M d, Y h:i A', strtotime($job->created_at))}}</td> 
                                
                                    <td >
                                    
                                        <div class="{{$job->job_area ??''}}Style">
                            
                                        <p >
                                            {{ $job->job_area ?? ''}}
                                        </p>
                                        </div>
                                        </td>
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
                                     <td>
                                        @if ($job->created_By_Admin)
                                            <div style = "color:Green">
                                                {{  $job->created_By_Admin }}
                                            </div>
                                        @else
                                            <div style = "color:black">
                                                {{  $job->created_By_Admin }}
                                            </div>
                                        @endif
                                        
                                    </td>
                                    <td>                  
                                        <div class="actions d-flex">                   
                                            <button type="button" data-toggle="modal" onclick="showJobModal(0,{{$job->id}})" data-target="#viewjob-{{$job->id}}"><span class="las la-eye"></span></button>      
                                            <button type="button" data-toggle="modal" onclick="initMap({{$job->id}},{{$job->customer->lat}},{{$job->customer->lng}})" data-target="#viewMap-{{$job->id}}"><span class="las la-map-marker"></span></button>      
                                        
                                            <form method="POST" action="{{ route('job-cancel', $job->id) }}">
                                                @csrf 
                                                <button type="button" onclick="cancelConfirm(event)"><span class="las la-trash"></span></button>
                                            </form>  
                                            <div class="modal fade" id="viewMap-{{$job->id}}" tabindex="-1" aria-hidden="true">                        
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                            <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Map Details</h3>                                                           
                                                        </div>                    
                                                            <!-- Modal Body -->
                                                        <div class="modal-body">
                                                            
                                                            <div class="">
                                                            
                                                             <div id='map{{$job->id}}' class='resetMap'>
                                                                
                                                                </div>
                                                            
                                                            </div>
                                                           
                                                            <div class="content-location-form">
                                                                <h2>Details</h2>
                                                                <div class="input-flex">
                                                                    <div>
                                                                        <label for="">Country</label><br>
                                                                        <input type="text" class="editable disable" id="country_tag" name='country_val' value="{{$job->customer->country}}" ><br>
                                                                    </div>
                                                                    <div>
                                                                        <label for="">Region</label><br>
                                                                        <input type="text" class="editable disable" id="region_tag" name='region_val' value="{{$job->customer->region}}" ><br>
                                                                    </div>
                                                                </div>
                                                                <label for="">Full Address</label><br>
                                                                <textarea name="fulladdress" class="disable" id="fulladd_tag" cols="30" rows="4">{{$job->customer->fullAdress}}</textarea>
                                                                
                                                            </div> 
                                                        </div>
                                                        <div class="modal-footer footerEditClass">                               
                                                            <button type="button" data-dismiss="modal" onclick="closeMap(event)">Close</button>                                                                                                                        
                                                        </div>       
                                                    </div>
                                                </div>                                        
                                            </div>
                                            <div class="modal fade" id="viewjob-{{$job->id}}" tabindex="-1" aria-hidden="true">                        
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                            <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Customer Details</h3>                                                           
                                                        </div>                    
                                                            <!-- Modal Body -->
                                                        <div class="modal-body">
                                                          
                                                            <div class="modal-separator">       
                                                             <div class="image-issue">
                                                              @if(isset($job))
                                                           
                                                                    @php
                                                                        
                                                                        $imageNames = unserialize($job->issue_image);
                                                                    
                                                                    @endphp
                                                                
                                                                    @foreach($imageNames as $imageName)
                                                                        <div  class="image-slider image-slider{{$job->id}}">
                                                                            <img class="image-preview" src="{{ asset('img/' . $imageName) }}" alt="Image Issue">
                                                                        </div>
                                                                    @endforeach
                                                                        <a class="prev" onclick="plusSlides(-1,{{$job->id}})">❮</a>
                                                                        <a class="next" onclick="plusSlides(1,{{$job->id}})">❯</a>
                                                                    
                                                                @endif
                                                     
                                                        </div>
                                                                <div class="div-main-content">
                                                                    <div class="div-content">
                                                                        <p>Issue Id:</p>
                                                                    </div>
                                                                    <div class="div-desc">
                                                                        <p contenteditable="false">{{ $job->id}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="div-main-content">
                                                                    <div class="div-content">
                                                                        <p>Name:</p>
                                                                    </div>
                                                                    <div class="div-desc">
                                                                        <p  contenteditable="false">{{$job->customer->first_name }} {{ $job->customer->last_name }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="div-main-content">
                                                                    <div class="div-content">
                                                                        <p>Problem:</p>
                                                                    </div>
                                                                    <div class="div-desc jobTypeClass">
                                                                        <p id="jobType" class="editable" contenteditable="false">{{$job->job_type}}</p> 
                                                                    </div>
                                                                </div>

                                                                <div class="div-main-content">
                                                                    <div class="div-content">
                                                                        <p>Description:</p>
                                                                    </div>
                                                                    <div class="div-desc">
                                                                        <p id="jobDescription" class="editable" contenteditable="false">{{$job->job_description}}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="div-main-content">
                                                                    <div class="div-content">
                                                                        <p>Date Created:</p>
                                                                    </div>
                                                                    <div class="div-desc">
                                                                        <p contenteditable="false">{{$job->created_at}}</p>
                                                                    </div>
                                                                </div>  
                                                                @if($job->job_status == 'Assigned' || $job->job_status == 'On-going')
                                                                    <div class="div-main-content">
                                                                        <div class="div-content">
                                                                            <p>Date Assigned:</p>
                                                                        </div>
                                                                        <div class="div-desc">
                                                                            <p contenteditable="false">{{$job->assigned_at}}</p>
                                                                        </div>
                                                                    </div>  
                                                                @endif
                                                                  @if( $job->job_status == "On-going" || $job->job_status == 'Verification' || $job== 'Complete')  
                                                                        @if($job->generated == "True" ||  $job->generated == "Downloaded" || $job->generated == "Approved")    
                                                                            <div class="div-main-content">
                                                                                <div class="div-content">
                                                                                    <p>Quotation:</p>
                                                                                </div>
                                                                                <div class="div-desc d-flex" >
                                                                                    <div class="spanIcons"  style="border:none;background: red; width:40px" >
                                                                                        <a href="/customer/jobreq/view/generatePDF/{{$job->id}}">
                                                                                            <div style="height: 40px;  border-radius: 5px; display: flex; align-items: center; justify-content: center; margin-right:10px">                        
                                                                                                <button type='button' style="border:none;background: red; width:100%;height:100%; border-radius: 5px;" ><span><i class="las la-file-pdf"></i></span></button>          
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                   @if($job->job_status == 'On-going' || $job->job_status == 'Verification')   
                                                                                        @if($job->generated == "True" || $job->generated == "Downloaded")     
                                                                                        <div class="text_wrapper " style="display:flex; align-items: center; margin-left:10px">
                                                                                            <p style="text-align:center; font-weight:600; color:green; margin-right:10px;">Quotation was Generated</p> 
                                                                                            <span class="new-notif-table">NEW </span> 
                                                                                        </div>                                                                                                  
                                                                                        @endif
                                                                                        
                                                                                        @if($job->generated == "QuotationDecline")     
                                                                                        <div class="text_wrapper " style="display:flex; align-items: center; margin-left:10px">
                                                                                            <p style="text-align:center; font-weight:600; color:red; margin-right:10px;">Quotation was Declined, Wait for update</p> 
                                                                                        </div>                                                                                                  
                                                                                        @endif
                                                                                        
                                                                                        @if($job->generated == "Approved")     
                                                                                        <div class="text_wrapper " style="display:flex; align-items: center; margin-left:10px">
                                                                                            <p style="text-align:center; color:green;  font-weight:600; margin-right:10px;">Quotation was Approved</p> 
                                                                                 
                                                                                        </div>                                                                                                  
                                                                                        @endif
                                                                                    @endif  
                                                                                </div>
                                                                            </div>  
                                                                                
                                                                        @endif
                                                                    @endif
                                                                @if($job->job_status == 'Complete')
                                                                    <div class="div-main-content">
                                                                        <div class="div-content">
                                                                            <p>Date Assigned:</p>
                                                                        </div>
                                                                        <div class="div-desc">
                                                                            <p contenteditable="false">{{$job->assigned_at}}</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="div-main-content">
                                                                        <div class="div-content">
                                                                            <p>Date Completed:</p>
                                                                        </div>
                                                                        <div class="div-desc">
                                                                            <p contenteditable="false">{{$job->completed_at}}</p>
                                                                        </div>
                                                                    </div>  
                                                                @endif
                                                                @if($job->job_status == 'Aborted')
                                                                    <div class="div-main-content">
                                                                        <div class="div-content">
                                                                            <p>Date Assigned:</p>
                                                                        </div>
                                                                        <div class="div-desc">
                                                                            <p contenteditable="false">{{$job->assigned_at}}</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="div-main-content">
                                                                        <div class="div-content">
                                                                            <p>Date Aborted:</p>
                                                                        </div>
                                                                        <div class="div-desc">
                                                                            <p contenteditable="false">{{$job->aborted_at}}</p>
                                                                        </div>
                                                                    </div>  
                                                                @endif
                                                        
                                                                <div class="techInfo">
                                                                    <div class="techinfo-status">
                                                                        <div class="div-main-content">
                                                                            <div class="div-content">
                                                                                <p>Technician:</p>
                                                                            </div>
                                                                            <div class="div-desc">
                                                                                @if ($job->techList)                  
                                                                                    <p contenteditable="false" class=""> {{$job->techList->first_name}} {{$job->techList->last_name}}</p>
                                                                                @else
                                                                                    @if($job->job_status == 'Pending')
                                                                                        <p contenteditable="false" class="unassigned">N/A</p>
                                                                                    @endif
                                                                                @endif 
                                                                            </div> 
                                                                        </div>    
                                                                        
                                                                        <div class="div-main-content">
                                                                            <div class="div-content">
                                                                                <p>Status:</p>
                                                                            </div>
                                                                            <div class="div-desc">
                                                                                @if ($job->techList)                  
                                                                                    <p contenteditable="false" class="{{$job->job_status}}"> {{$job->job_status}}</p>
                                                                                @else
                                                                                    @if($job->job_status == 'Pending')
                                                                                    <p contenteditable="false" class="unassigned">Unassigned</p>
                                                                                    @endif
                                                                                @endif                                                                  
                                                                            </div>                                        
                                                                        </div>
                                                                    </div>
                                                                
                                                                    @if($job->job_status == 'Aborted' || $job->job_status == 'Cancelled')
                                                                    <div class="div-main-content">                                           
                                                                        <div class="div-content">                                       
                                                                            <p>Remarks:</p>
                                                                        </div>
                                                                        <div class="div-desc">                          
                                                                            <p contenteditable="false" class=""> {{$job->remarks}} </p> 
                                                                        </div>       
                                                                    </div>  
                                                                     @elseif($job->job_status == 'Decline')
                                                                       <div class="div-main-content">                                           
                                                                        <div class="div-content">                                       
                                                                            <p>Remarks:</p>
                                                                        </div>
                                                                        <div class="div-desc">                          
                                                                            <p contenteditable="false" class=""> {{$job->remarks}} </p> 
                                                                        </div>       
                                                                    </div>  
                                                                    @elseif($job->job_status == 'Complete')
                                                                    <div class="techInfo">                                                      
                                                                        <div class="div-main-content">                                           
                                                                            <div class="div-content" style="width:200px">                                       
                                                                                    <p>Customer Remarks:</p>
                                                                            </div>
                                                                            <div class="div-desc" >                          
                                                                                <p contenteditable="false" class=""> {{$job->customer_remarks}} </p> 
                                                                            </div>       
                                                                        </div>

                                                                        <div class="div-main-content">                                           
                                                                            <div class="div-content"  style="width:200px">                                       
                                                                                    <p>Ratings:</p>
                                                                            </div>
                                                                            <div class="div-desc">                          
                                                                                <p contenteditable="false" class=""> {{$job->rating}} Stars</p> 
                                                                            </div>       
                                                                        </div>
                                                                    </div> 
                                                                    @endif                                    
                                                                </div> 
                                                            </div>                
                                                                             
                                                        </div>
                                                        <div class="modal-footer footerEditClass"> 
                                                            @if ($job->job_status == 'Pending' || $job->job_status == 'Decline')                            
                                                                <button type="button"  onclick="storeJobId({{$job->id}},event)" data-toggle="modal" data-target="#techSelect" class="btn btn-primary edtBtn">Assign </button>  
                                                            @elseif($job->job_status == 'Assigned')
                                                            <form method="POST" action="{{ route('cancel-assign', $job->id) }}">
                                                          
                                                                <button type="submit"  class="btn btn-primary cancelBtn">Cancel</button>  
                                                            </form> 
                                                            @elseif($job->job_status == 'On-going')
                                                                @if($job->created_By_Admin == 'Yes')
                                                                    @if($job->generated == 'True' || $job->generated == 'Downloaded')
                                                                    <form class="formAccept" method="POST" action="{{ route('approvePDF', ($job->id)) }}">
                                                                        @csrf 
                                                                            <button type="submit" style = "color: #ffff;background-color: orange; width:100px">Approve</button> 
                                                                    </form> 
                                                                     @endif   
                                                                 @endif   
                                                            @elseif($job->job_status == 'Verification')   
                                                                <button style ="width:90px" type="button" onclick="modalCompleteWidow(event,{{$job->id}})" data-toggle="modal" data-target="#jobComplete" class="btn btn-primary completeBtn">Complete</button>                                          
                                                            
                                                            @endif                            
                                                            <button type="button" data-dismiss="modal" onclick="closeView(event)">Close</button>                                                                                                                        
                                                        </div>       
                                                    </div>
                                                </div>                                        
                                            </div>                                
                                        </div>    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <ul class="pagination">
                        {{ $jobs->links() }}
                    </ul>
                </div>
            </div>
            
            
             <!-- Modal for add admin jobReq-->
            <div class="modal fade" id="adminJobReq" tabindex="-1" role="dialog"  aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Job Request</h4>
                    <span class="las la-times-circle" style="cursor: pointer;" data-dismiss="modal"></span>
                  </div>
                  <div class="modal-body">
                        <div class="issue-cat">
                            <form action="{{route('admin-add-customer-requestJob')}}" method="POST" enctype="multipart/form-data" style="height:fit-content;">
                                @csrf
                                <label for="">Choose an service</label>
                                <div style = "display: flex; width: 100%">
                                    <select onclick="handleSelectChange()" name="jobType" id="issueSelect" required> 
                                        <option value="" disabled selected>Select here...</option>
                                        <option value="Cctv Installation">Cctv Installation</option>
                                        <option value="Solar Installation">Solar Installation</option>
                                        <option value="Internet Installation">Internet Installation</option>
                                        <option value="Repair and Installation">Repair and Installation</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <input class="otherOption hide" name="otherSelected" placeholder="State the issue type" type="text">
                                </div>
                          
                        </div>
                        <!--choose customer-->
                        <div class="issue-cat"a style="margin-top: 10px;">
            
                                @csrf
                                <label for="">Choose Client</label>
                                
                                <div style="display: flex; width: 100%">
                                    <select name="customerID" id="" required onChange="customerSelect(this)"> 
                                        <option value="" disabled selected>Select here...</option>
                              
                                        @foreach($customers as $customer)
                                            <option data-customerType="{{$customer->customerType}}" value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                  
                                
                                
                        </div>
                        <div class="issue-cat"a style="margin-top: 10px; margin-right: 8px;">
                         <textarea class="form-control" id="textAreaExample6" rows="3" name="jobDescription" placeholder="Describe (Optional)"></textarea>
                          </div>
                        <!--@php-->
                        <!-- dd($customers);-->
                        <!--@endphp-->
                        
                            <div class="issue-cat"a style="margin-top: 10px;">
                                @csrf
                                <label for="">Assign Technician</label></label>
                                <div style="display: flex; width: 100%">
                                    <select name="techID" id="" required > 
                                        <option value="" disabled selected>Select here...</option>
                                        @foreach($technicians as $technician)
                                            <option value="{{$technician->id}}">{{$technician->first_name}} {{$technician->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <!--Subscriber or Consignee-->
                        <div class="issue-cat" style="margin-top: 10px;">
                                @csrf
                                <label for="">Customer Type</label>
                                <p id="customerTypeID" style="font-size: 15px; color: black; font-weight: 600;"></p>
                        </div>
                  </div>
                  <div class="modal-footer" style="display: flex !important; flow-direction: row !important; width: 100%; justify-content: end !important; ">
                    <button type="submit" class="btn btn-success" style="background-color: green; width: fit-content; margin-right: 8px;" >Done</button>
                  </div>
                   </form>
                </div>
              </div>
            </div>
            
            
            
            <!--modal for view task of the customer-->
            <!--Diria bay pwede ra i click ang row sa table tapos kanang btn sa baba ma show depende sa status sa request like pag complete sya dili na ma show ang abort na btn tapos mag show lang na na-modal if yes ang status sa isAdmin na column na table-->
            <!--<div class="modal fade" id="adminJobViewReq" tabindex="-1" role="dialog"  aria-hidden="true">-->
            <!--  <div class="modal-dialog modal-lg" role="document">-->
            <!--    <div class="modal-content">-->
            <!--      <div class="modal-header">-->
            <!--        <h4 class="modal-title">View Job Request</h4>-->
            <!--        <span class="las la-times-circle" style="cursor: pointer;" data-dismiss="modal"></span>-->
            <!--      </div>-->
            <!--      <div class="modal-body">-->
            <!--            <table class="table table-striped">-->
            <!--                <thead>-->
            <!--                    <tr>-->
            <!--                        <th scope="col">Client Name</th>-->
            <!--                        <th scope="col">Services</th>-->
            <!--                        <th scope="col">Technician</th>-->
            <!--                        <th scope="col">Status</th>-->
            <!--                        <th scope="col">Quotation</th>-->
            <!--                    </tr>-->
            <!--                </thead>-->
            <!--                <tbody>-->
            <!--                    <tr>-->
            <!--                        <td>Sample Text</td>-->
            <!--                        <td>Sample Text</td>-->
            <!--                        <td>Sample Text</td>-->
            <!--                        <td>Sample Text</td>-->
            <!--                        <td>-->
            <!--                            <button type='submit'  style="border:none;  background: green; width: 35px; height:40px; border-radius: 5px;" ><span><i class="las la-file-pdf" style="color: white; font-size: 20px;"></i></span></button>-->
            <!--                        </td>-->
            <!--                    </tr>  -->
            <!--                </tbody>-->
            <!--            </table>-->
            <!--      </div>-->
            <!--      <div class="modal-footer" style="display: flex !important; flow-direction: row !important; width: 100%; justify-content: end !important;">-->
            <!--        <button type="button" class="btn btn-secondary"  style="background-color: grey;" data-dismiss="modal">Cancel</button>-->
            <!--        <button type="button" class="btn btn-danger"  style="background-color: red;" data-dismiss="modal">Abort</button>-->
            <!--        <button type="button" class="btn btn-success" style="background-color: green; width: fit-content;" >Complete</button>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            
<!--Job complete-->
<div class="modal fade" id="jobComplete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rating</h4>
            </div>           
            <div class="modal-body-rating">
                <div class="star-wrapper">
                    <form class="formComplete" method="POST" action="{{ route('job-complete')}}">                              
                        @csrf                  
                        <center>
                        <div class="rating">
                            <h5>Rate our service</h5>
                            <input type="number" name="rating" id="ratingValue" hidden required>
                            <i class="bx bx-star"  data-value="1"></i>
                            <i class="bx bx-star"  data-value="2"></i>
                            <i class="bx bx-star"  data-value="3"></i>
                            <i class="bx bx-star"  data-value="4"></i>
                            <i class="bx bx-star"  data-value="5"></i>
                        </div>
                        </center>
                        <textarea class="form-control" id="" rows="3" name="customerRemarks" placeholder="Comments" required></textarea>
                        <div class="btn-rating-group">
                        
                            <button onclick="submitJobRating(event)" type="button" class="btnSubmit">Submit</button>
                            <button data-dismiss="modal" class="btnCancel">Cancel</button>
                        </div>
                    </form> 
                </div>                            
            </div>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="techSelect" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Select Technician</h4>
            <span class="las la-times-circle" data-dismiss="modal"></span>
        </div>
        
        <!-- Modal Body -->
        <div class="modal-body">
            <div class="main-tect-table">
                <div class="header">
                        <p>Technicians</p>
                </div>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Assigned Task</th>
                             <th scope="col">Area</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($technicians as $technician)
                        <tr>
                            <td>{{$technician->first_name}} {{$technician->last_name}}</td>
                            <td>
                                <div class="status">
                                    <div class="available"></div>
                                    <p>Available</p>
                                </div>
                            </td>
                            <td>{{ $technicianCounts[$technician->id] ?? 0 }} Task</td>
                             <td>{{ $technician->area ?? '' }}</td>
                            <td>
                                <div class="actions-tect">
                                    <form method="POST" action="{{route('assign-tech')}}">
                                        @csrf                                                                              
                                            <button onclick="assignTechSelected(event,{{$technician->id}},'{{$technician->area}}')" type="button" class="select-btn">Select</button>
                                    </form>
                                </div>
                            </td>
                        </tr>  
                        @endforeach                      
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Done</button>
        </div>
        
        </div>
    </div>
    
    
   
    
    
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function customerSelect(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var custType = selectedOption.getAttribute('data-customerType');
        var customerTypeText = document.querySelector('#customerTypeID');
        customerTypeText.innerHTML = custType
        
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@if($errors->count() > 0)
<script>
        Swal.fire({
            icon: 'error',  
            text: "{{$errors->first()}}",
        })
    </script>
@endif

@if(Session::has('success'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'success',  
            text: "{{Session::get('success')}}",
        })
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
    </script>
@endif



<script>
     function storeJobId(id,e) {
        sessionStorage.setItem('jobId', id);
        console.log('jobId stored successfully.');
        var modal = e.target.closest('.modal')
    
        $(modal).hide();
        $('.modal-backdrop').remove();
    
        }

    function assignTechSelected(e,techId,techArea){
        var form = e.target.closest('form')
        form.action =  form.action + '?jobID=' + encodeURIComponent( sessionStorage.getItem('jobId')) +
                '&techId=' + encodeURIComponent( techId) + '&techArea=' + encodeURIComponent( techArea);
                    
        form.submit()
    }
 
</script>

<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script>
    let map, markers 

    function initMap(id,lat,lng) {
        
      
        if (map) {
        // Remove existing map and marker
            map.remove();
            marker = null;
        }  
        var mapContainerId = 'map' + id;
        var elements = document.querySelectorAll('.resetMap');

            elements.forEach(function(element) {
                element.innerHTML = '';
            });
      
        document.getElementById(mapContainerId).innerHTML='<div id="map"></div>';
        map = L.map('map', {
            center: {
                lat: 12.8797,
                lng: 121.7740,
            },
            zoom: 6
        });
        

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

       // Check if initial values for lat and lng are provided
        const initialLat = lat;  // Provide your initial latitude value here
        const initialLng = lng;  // Provide your initial longitude value here

        if (initialLat !== 0 || initialLng !== 0) {
            // Use the provided initial values
            marker = L.marker([initialLat, initialLng], {
                draggable: true,
                  
                  iconAnchor: [16, 37],   // Adjust the icon anchor for centering
                    popupAnchor: [0, -28]
            })
            .addTo(map)
            
            map.setView([initialLat, initialLng], 17); 
        } else {
            // Use default values for the Philippines
            marker = L.marker([12.8797, 121.7740], {
                draggable: true
            })
            .addTo(map)
            
        }

         $('#viewMap-' + id).on('shown.bs.modal', function () {
        // Force Leaflet to redraw the map
        setTimeout(function () {
            map.invalidateSize();
        }, 100);
    });

    // Set the desired width for the modal content
    var modalContent = document.getElementById('viewMap-' + id).getElementsByClassName('modal-content')[0];
    modalContent.style.width = '95%'; // Example: Set the width to 95% of the viewport width
  
      
    }
    
    


    // function initMarkers() {
    //     // Add initial markers if needed
    // }

    // function generateMarker(data, index) {
    //     return L.marker(data.position, {
    //         draggable: data.draggable
    //     })
    //     .on('click', (event) => markerClicked(event, index))
    //     .on('dragend', (event) => markerDragEnd(event, index));
    // }

    // function mapClicked(event) {
    //     const { lat, lng } = event.latlng;
    //     updateMarkerPosition(lat, lng);
    //     getAddress(lat, lng);
    // }

    // function markerClicked(event, index) {
    //     const { lat, lng } = event.latlng;
    //     getAddress(lat, lng);
    // }

    // function markerDragEnd(event, index) {
    //     const { lat, lng } = event.target.getLatLng();
    //     getAddress(lat, lng);
    // }

    // function getAddress(lat, lng) {
    //     // Using OpenStreetMap Nominatim API for reverse geocoding
    //     const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`;

    //     fetch(apiUrl)
    //         .then(response => response.json())
    //         .then(data => {
    //             const address = data.display_name;
    //             const country = data.address.country ?? 'Unknown Country';
    //             const region = data.address.region ?? 'Unknown State';
           

    //             document.getElementById('country_tag').value = country;
    //             document.getElementById('region_tag').value = region;
    //             document.getElementById('fulladd_tag').value = address;
    //             document.getElementById('lat').value = lat;
    //             document.getElementById('lng').value = lng;

    //             console.log(data);
    //         })
    //         .catch(error => console.error('Error:', error));
    // }

    // function addMarker(position) {
    //     const marker = L.marker(position, {
    //         draggable: true
    //     })
    //     .addTo(map)
    //     .on('click', (event) => markerClicked(event, markers.length))
    //     .on('dragend', (event) => markerDragEnd(event, markers.length));

    //     markers.push(marker);
    // }

    // function updateMarkerPosition(lat, lng) {
    //     marker.setLatLng([lat, lng]);
    // }



</script>

<script>
    function handleSelectChange() {
        var selectElement = document.getElementById("issueSelect");
        var inputElement = document.querySelector(".otherOption");

            if (selectElement.value === "Others") {
                inputElement.classList.remove("hide");
            } else {
                inputElement.classList.add("hide");
            }
    }
    
       function modalCompleteWidow(e,jobId){
        console.log(jobId)
        sessionStorage.setItem('jobId', jobId);
        var modal = e.target.closest('.modal')  
        $(modal).hide();
        $('.modal-backdrop').remove();
    
    }

    function submitJobRating(e){
        var form = e.target.closest('form')
        form.action =  form.action + '?jobID=' + encodeURIComponent( sessionStorage.getItem('jobId')) 
                         
                          
        form.submit()
        console.log(form);
    }
    

</script>

<script>
    let slideIndex = 1;
    // showSlides(slideIndex);
    
    
    function showJobModal(n,id){
      let i;
      let slides = document.getElementsByClassName("image-slider"+id);
      console.log(slides)
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
     
      slides[slideIndex-1].style.display = "block";  
    }
    function plusSlides(n,id) {
    console.log(slideIndex)
      showJobModal(slideIndex += n,id);
    }
    
    function currentSlide(n,id) {
      showJobModal(slideIndex = n,id);
    }
    
    // function showSlides(n) {
    //   let i;
    //   let slides = document.getElementsByClassName("image-slider");
    //   console.log(slides)
    //   let dots = document.getElementsByClassName("dot");
    //   if (n > slides.length) {slideIndex = 1}    
    //   if (n < 1) {slideIndex = slides.length}
    //   for (i = 0; i < slides.length; i++) {
    //     slides[i].style.display = "none";  
    //   }
     
    //   slides[slideIndex-1].style.display = "block";  
     
    // }
    </script>
@endsection



