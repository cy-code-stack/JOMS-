@extends('../base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/technician/techniciantask.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">

<style>
    .jobCards{
        align-items: center;
        padding: 10px;
        display: flex;
        flex-direction: row;
        border-radius: 10px;
        background-color: #FFF;
        box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.25);
        width: 100%;
        height: 60px;
        margin-bottom: 10px;
        
    }

    .jobCards form{
        width: 85%;
        
    }
    .jobCards .jobCardDivs{
        display: flex;
        width: 100%;
    }

    .jobCards:hover{
        background-color: hsla(0, 100%, 90%, 0.3);
    }

    .jobCardDivs button{
        border:none;
        display: flex;
        background-color: #FFF;
        width: 100%;
    }
    .btnClicked{
        width: 100%;
        height: 100%;
    }


     .jobIssueID{
        font-size: 20px;
        font-weight: 600;
        color: #5B5B5B;
        width: 20%;
        text-align: left;
        margin-right:20px;
        padding-left:20px;
    }
    

    .showActive{
        background-color: hsla(0, 100%, 90%, 0.3);
    }
    
    .jobIssuePending{
        display: flex;
        flex-direction: row;
        align-items: center;
        padding-left: 30px;
        text-align: left;
        margin-right:20px;
    
    }
    .jobIssue{
        font-size: 20px;
        font-weight: 600;
        color: #5B5B5B;
        width: 40%;
        padding-left: 50px;
        text-align: left;
    }
    .jobIssuePDF{
        display: flex;
        justify-content: center;
        width: 40px;
        height: 40px;
        align-items: center;
        cursor: pointer;
        border-radius: 5px;
        background: #FC8C24;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    }
    .jobIssuePDF span{
        font-size: 30px;
        color: black;
    }
    
    .jobIssueApprove{
        width: 35%;
    }
   
    .jobIssueApprove button{
        width: 70px;
        height: 35px;
        border: none;
        color: white;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        float: right;
        border-radius: 5px;
        background: #FC8C24;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    }
    .jobDesc{
        background-color: white;
        padding: 10px 10px;
        margin-left: 8px;
        background-color: var(--dominant-color);
        box-shadow: 0px 1px 1px 1px rgba(130, 130, 130, 0.6);
        border-radius: 10px;
        min-width: 40%;
        /*height: 100%;*/
    }
    .jobStatus{
        width:100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 5px;
    }
    .jobImage{
        height: 30vh;
        width: 100%;
        background-color: grey;
        border-radius: 10px;
        margin-bottom: 10px;
        position:relative;
    }
    .jobImage img{
        width:100%;
        height:100%;
    }
    .jobInfo{
        width: 100%;
    }
    .jobInfo h5{
        font-size: 18px;
        font-weight: 600;
        
    }
    .spanIcons{
        width: 40px; 
        height: 40px; 
        background-color: #FC8C24; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        border-radius: 10px;
        margin-right: 5px;
    }
    .spanIcons span{
        font-size: 24px;
        color: white;
        cursor: pointer;
    }
    .jobIcons{
        width: 100%;
        display: flex;
        justify-content: end; 
    }
    .jobDescription{
        width: 100%;
    
    }

    .jobDescription h5{
        font-size: 13px;
        font-weight: 550;
        color: black;
    }
    .jobDescription p{
        color: black;
        text-align: justify;
        text-justify: inter-word;
        margin-bottom: 10px;
        margin-top:5px;
        margin-left:5px;
    }
    .remarksCustomer{
        width: 100%;
        margin-bottom: 5px;
        display: flex;
        justify-content: space-between;
    }

    .ratingDesc p{
        margin-top:5px;
        margin-left:5px;
    }
    .ratingDesc{
        margin-bottom: 10px;
    }
    .jobsCreatedStatus{
        margin-bottom: 15px;
    }
    .techBtns{
        display: flex;
        width: 100%;
        justify-content: end;
        align-items: center;
    }
    .techBtns button{
        border: none;
        width: 80px;
        height: 35px;
        margin: 3px;
        border-radius: 5px;
    }
    .acceptTech{
        background-color: #4AE115;
        color: white;
    }
    .declineTech{
        background-color: #FF0000;
        color: white;
    }
    .defaultTech{
        background-color: #ED6324;
        color: white;
    }
    
    
    .buttons_tables .text_wrapper {
        width:100%;
        display:flex;
        justify-content:center;
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
    .main-containers{
        width: 100%; 
        display: flex; 
        flex-direction: row;  
        overflow: hidden; 
        padding: 10px;
    }
    .main-table{
        margin-bottom: 0; 
        min-width: 60%; 
        height: 675px;
        overflow: scroll;
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

.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.5);
}


@media (min-width: 990px) and (max-width: 1086px){
    .techBtns{
        margin: -10px;
        width: 100%;
        margin-left: 6px;
    }
    .techBtns button{
        right: 1;
        height: 30px;
        font-size: 12px;
    }
}

@media (min-width: 550px) and (max-width: 989px){
    .main-containers{
        display: block;
        overflow: scroll;
        padding: 10px 5px;
    }
    .main-table{
        width: 100%;
        padding: 15px;
        height: 550px;
        margin-bottom: 10px;
        overflow: scroll;
    }
    .jobDesc{
         width: 100%;
         min-height: 650px; 
         margin: 0;
    }
    .techBtns{
        margin: -22px;
        width: 100%;
        margin-left: 6px;
    }
    .techBtns button{
        right: 1;
        height: 30px;
        font-size: 12px;
    }
}
@media (min-width: 320px) and (max-width: 549px){
    .main-containers{
        display: block;
        overflow: scroll;
    }
    .main-table{
        width: 100%;
        padding: 10px;
        height: 500px;
        margin-bottom: 10px;
        overflow: scroll;
    }
    .btnClicked{
        padding: 0px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }
    
    .jobDesc{
        min-height: 650px;
        width: 100%; !important
        margin: 0;
    }
    .jobIssueID{
        padding: 0;
        margin: 0;
        width: 100%;
    }
    .jobIssueID p {
        font-size: 12px;
    }
    .jobIssue{
        padding: 0;
        margin: 0;
        width: 100%; 
    }
    .jobIssue p{
        font-size: 12px;
    }
    .jobIssuePending{
        padding: 0;
        margin: 0;
        width: 100%; 
    }
    .text_wrapper p{
        font-size: 10px;
        margin: 0;
        padding: 0;
    }
    .techBtns button{
        right: 1;
        height: 30px;
        font-size: 12px;
    }
    .techBtns{
        margin: -10px;
        width: 100%;
        margin-left: 6px;
    }
}
    
</style>
@endsection
@section('navbar')
    @include('includes/nav')
@endsection
@section('content')
<div class="main-containers">
    <div class="main-table">
        <div class="table_header">
            <h3>Current Task</h3>
            <div class="select-wrapper">
            <form  action="{{route('sort-status-tech')}}" method="POST">
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
                 </form>
            </div>
        </div>

     
                
                @foreach($jobs as $job)
                    <div id="highlight{{$job->id}}" class="jobCards" >
                        <form method="get" action="{{ route('job-view-clicked-tech', $job->id) }}">
                        @csrf 
                            <div class="jobCardDivs">
                                <button class="btnClicked"  style="background-color:transparent;" type="submit">
                                    <div class="jobIssueID">
                                        <p>Issue ID: {{$job->id}}</p>
                                    </div>
                                    <div class="jobIssue">
                                        <p>{{$job->job_type}}</p>
                                    </div>
                                    <div class="jobIssuePending">
                                        <div class="status">
                                            <div class="{{$job->job_status}}"></div>
                                                <p>{{$job->job_status}}</p>
                                        </div>
                                    </div>
                                </button>
                            </div>          
                        </form>      
                        <div class="buttons_tables d-flex" style="width:170px; display:flex; justify-content:center, align-items:center">   
                               
                        @if($job->generated == 'QuotationDecline')   
                         
                            <div class="text_wrapper " style="display:flex; align-items: center;">
                                <p style="text-align:center; font-weight:600; color:red; margin-right:10px;">Quotation was Declined by customer, Please update</p> 
                            </div>                                                                                                  
                           
                        @endif 
                         @if($job->job_status == 'Aborted')
                            <p style="color: red; font-weight: 550; font-size: 13px; text-align:center;">
                                Task Was Aborted
                            </p>
                         @else
                            @if($job->generated == 'True' || $job->generated == "Downloaded" )   
                               
                               @if($job->created_By_Admin == 'Yes' )   
                                    <div class="text_wrapper " style="display:flex; align-items: center;">
                                        <p style="text-align:center; font-weight:600; color:black; margin-right:10px;">Waiing for Admin Approval</p> 
                                    </div> 
                                @else
                                 <div class="text_wrapper " style="display:flex; align-items: center;">
                                        <p style="text-align:center; font-weight:600; color:black; margin-right:10px;">Waiting for Customer approval</p> 
                                    </div> 
                               @endif  
                           
                            @endif  
                            
                             @if($job->generated == Null )   
                               
                                <div class="text_wrapper " style="display:flex; align-items: center;">
                                    <p style="text-align:center; font-weight:600; color:red; margin-right:10px;">Please Generate Quotation</p> 
                                </div>                                                                                                  
                           
                            @endif  
                            
                            @if($job->generated == 'Approved')   
                                @if($job->job_status == "Complete")     
                                <div class="text_wrapper " style="display:flex; align-items: center;">
                                    <p style="text-align:center; font-weight:600; color:green; margin-right:10px;">Task Complete</p> 
                                </div>                                                                                                  
                                @endif
                                
                                @if($job->created_By_Admin == 'Yes' AND $job->job_status == "On-going" )   
                                     <div class="text_wrapper " style="display:flex; align-items: center;">
                                        <p style="text-align:center; font-weight:600; color:green; margin-right:10px;">Quotation Was Approved by Admin</p> 
                                    </div>  
                                @elseif($job->job_status == "On-going" )
                                 <div class="text_wrapper " style="display:flex; align-items: center;">
                                        <p style="text-align:center; font-weight:600; color:green; margin-right:10px;">Quotation Was Approved by customer</p> 
                                    </div>  
                                @endif
                            @endif 
                           @endif  
                        
            
                       </div>
                    </div>

                    <form class="declineltJob" method="POST" action="{{ route('tech-decline', $job->id) }}">  
                        @csrf 
                        <div class="modal fade" id="declineModal{{$job->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                  
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Decline request</h4>
                                    </div>      
                                    <div class="modal-body" id="del-modal-body">
                                        <div class="abort-request">
                                        <h5>
                                            You are about to decline this request
                                        </h5>
                                        </div>
                                        <div class="warning">
                                            <span class="las la-exclamation-triangle"></span>
                                        </div>
                                        <div class="form-outline mb-4">
                                                    <textarea class="form-control abortReason" name="reasonText" id="textAreaExample6" rows="3" placeholder="State your reason here..." required></textarea>
                                        </div>     
                                    </div>      
                                    <div class="modal-footer">
                                        <div class="options">
                                        
                                            <button type="submit" class="btn btn-danger">Proceed</button>
                                
                                            <button type="button" class="btn btn-secondary" onclick="closeView(event)">Cancel</button>          
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </form>


                    <form class="abortJob" method="POST" action="{{ route('tech-abort', $job->id) }}">  
                                        @csrf 
                            <div class="modal fade" id="abortModal{{$job->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Abort request</h4>
                                        </div>      
                                        <div class="modal-body" id="del-modal-body">
                                            <div class="abort-request">
                                                <h5>
                                                    You are about to abort this request
                                                </h5>
                                            </div>
                                            <div class="warning">
                                                <span class="las la-exclamation-triangle"></span>
                                            </div>
                                            <div class="form-outline mb-4">
                                                        <textarea class="form-control abortReason" name="reasonText"  rows="3" placeholder="State your reason here..." required ></textarea>
                                            </div>     
                                        </div>      
                                        <div class="modal-footer">
                                            <div class="options">
                                            
                                                <button type="submit" class="btn btn-danger">Proceed</button>
                                        
                                                <button type="button" onclick="closeView(event)" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>          
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </form> 
                    @endforeach
                
        
  
      
</div>

    <div class="jobDesc">
    <div class="jobStatus">
            <div class="status">
                <div class="{{$jobsClicked->job_status ?? $jobs[0]->job_status??''}}"></div>
                <p>{{$jobsClicked->job_status ?? $jobs[0]->job_status??''}}</p>
            </div>
      
        </div>
        <div class="jobImage">
     
                @if(isset($jobsClicked))
                    @php
                        $imageNames = unserialize($jobsClicked->issue_image);
                    @endphp
            
                    @foreach($imageNames as $imageName)
                    <div  class="image-slider" >
                        <img class="image-preview" src="{{ asset('img/' . $imageName) }}" alt="Image Issue">
                    </div>
                    @endforeach
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
                @elseif(isset($jobs) && isset($jobs[0]))
                    @php
                        $imageNames = unserialize($jobs[0]->issue_image);
                    @endphp
            
                    @foreach($imageNames as $imageName)
                         <div  class="image-slider" >
                            <img class="image-preview" src="{{ asset('img/' . $imageName) }}" alt="Image Issue">
                        </div>
                    @endforeach
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
                @else
                    <img class="image-preview" src="{{ asset('img/logo-filled.jpg') }}" alt="Default Image">
                @endif
        </div>
        <div style="width: 100%; display: flex; justify-content: space-between; margin-bottom: 10px;">
            <div class="jobInfo">
            <div class="div-desc jobTypeClass">
                    <h5 id="jobType" class="editable">{{$jobsClicked->job_type ?? $jobs[0]->job_type??''}}</h5>
                </div>      <p><b>Customer Name: </b> {{$jobsClicked->customer->first_name??  $jobs[0]->customer->first_name??''}} {{ $jobsClicked->customer->last_name ?? $jobs[0]->customer->last_name??''}}</p>
                <p><b>Contact Number: </b> {{$jobsClicked->customer->mobile_number ?? $jobs[0]->customer->mobile_number??''}}</p>
                <p><b>Facebook: </b> <a style="font-size:13px;color:blue" target="_blank" href="https://www.facebook.com/search/top/?q={{$jobsClicked->customer->facebook_link ?? $jobs[0]->customer->facebook_link??''}}"> {{ $jobsClicked->customer->facebook_link ?? $jobs[0]->customer->facebook_link ?? 'N/A' }}
</a></p>
           
            </div>
            @if(isset($jobsClicked))
                <div class="jobIcons">
                    <div class="spanIcons">
                        <a href="#"><span><i class="lab la-facebook"></i></span></a>                  
                    </div>
                    <div class="spanIcons">
                        <a href="tel:+{{$jobsClicked->customer->mobile_number}}"><span><i class="las la-phone"></i></span></a>                  
                    </div>
                    <div class="spanIcons">
               <a href="{{ route('location-redirect', [
                            'lat' => $jobsClicked->customer->lat,
                            'lng' => $jobsClicked->customer->lng,
                            'name' => $jobsClicked->customer->first_name . ' ' . $jobsClicked->customer->last_name,
                            'status' => $jobsClicked->job_status,
                            'address' => $jobsClicked->customer->fullAdress ?? 'N/A'
                        ]) }}">

                                    
                            <span><i class="las la-map-marker"></i></span></a>
                </div>
                </div>
            @elseif(!($jobs->isEmpty()))
              <div class="jobIcons">
                    <div class="spanIcons">
                        <a href="tel:+{{$jobs[0]->customer->mobile_number??''}}"><span><i class="las la-phone"></i></span></a>                       
                    </div>
                    <div class="spanIcons">
               <a href="{{ route('location-redirect', [
                            'lat' => $jobs[0]->customer->lat,
                            'lng' => $jobs[0]->customer->lng,
                            'name' => $jobs[0]->customer->first_name . ' ' . $jobs[0]->customer->last_name,
                            'status' => $jobs[0]->job_status,
                            'address' => $jobs[0]->customer->fullAdress ?? 'N/A'
                        ]) }}">

                                    
                            <span><i class="las la-map-marker"></i></span></a>
                </div>
                </div>
            @endif
           
        </div>
        <div class="jobDescription">
            @if(!($jobsClicked->job_description??'') == '')
                <h5>Description:</h5>
        
            @else
               <h5>Description:</h5>
            @endif 
            <p class="" contentEditable="false">{{$jobsClicked->job_description ?? $jobs[0]->job_description??''}}</p>     </div>
        <div style="width: 100%; height: 2px; background-color: #E6D9D7; border-radius: 5px; margin-bottom: 5px;"></div>
        @if(($jobsClicked->job_status ?? '') == 'Complete' || ($jobsClicked->generated ?? '') == 'QuotationDecline')
            <div class="remarksCustomer">
                <p>Customer Remarks: </p>
                  @if(($jobsClicked->job_status ?? '') == 'Complete'))
                  
                 <p>Rating: {{$jobsClicked->rating ?? ''}} stars</p>
                    @else
                             <p>Rating: - - </p>
                @endif
            </div>
            <div class="ratingDesc">
                <p>{{$jobsClicked->customer_remarks ?? ''}}</p>   
            </div>
        @else
            <div class="remarksCustomer">
                <p>Customer Remarks: - - </p>
                <p>Rating: - - </p>
            </div>
            <div class="ratingDesc">
            </div>
        @endif   
        <div style="width: 100%; height: 2px; background-color: #E6D9D7; border-radius: 5px; margin-bottom: 5px;"></div>
    
        @if(($jobsClicked->job_status?? '') == 'Aborted')
            <div class="remarksCustomer">
                <p>Abort Reason:</p>
            </div>
            <div class="ratingDesc">
                <p>{{$jobsClicked->remarks ?? ''}}</p>   
            </div>
        @else
            <div class="remarksCustomer">
                <p>Abort Reason: - -</p>
            </div>
            <div class="ratingDesc">    
          </div>
        @endif 

        <div style="width: 100%; height: 2px; background-color: #E6D9D7; border-radius: 5px; margin-bottom: 5px;"></div>
    
        <div class="jobsCreatedStatus">
            <p style="color: blue;">Date Created:  {{$jobsClicked->created_at ?? $jobs[0]->created_at ??''}}</p>
            <p style="color: blue;">Date Assigned:  {{$jobsClicked->assigned_at ?? $jobs[0]->assigned_at??''}}</p>
            @if(($jobsClicked->job_status ?? $jobs[0]->job_status??'') == 'Aborted')
                 <p style="color: red;">Date Aborted: {{$jobsClicked->aborted_at ?? $jobs[0]->aborted_at??''}}</p>
            @endif 
            @if(($jobsClicked->job_status ?? $jobs[0]->job_status??'') == 'Complete')
            <p style="color: green;">Date Completed:  {{$jobsClicked->completed_at ?? $jobs[0]->completed_at??''}}</p>
            @endif 
          
        </div>
        <div class="techBtns">
            @if(($jobsClicked->job_status?? $jobs[0]->job_status??'') == 'Assigned')
                <form class="formAccept" method="POST" action="{{ route('tech-accept', $jobsClicked->id??$jobs[0]->id??'') }}">  
                @csrf 
                    <button  type="button" onclick="acceptJob(event)" class="acceptTech" >Accept</button> 
                </form>

                <form method="POST" action="{{ route('tech-decline', $jobsClicked->id??$jobs[0]->id??'') }}">
                @csrf   
                    <button type="button" onclick="declineJob(event, declineModal{{$jobsClicked->id??$jobs[0]->id??''}},{{$jobsClicked->id??$jobs[0]->id??''}})" class="declineTech">Decline</button>         
                </form>        
            @endif  

            @if(($jobsClicked->job_status?? $jobs[0]->job_status??'')  == 'On-going')
                <form class="formComplete" method="POST" action="{{ route('tech-complete', $jobsClicked->id??$jobs[0]->id??'') }}">  
                @csrf 
                    <button onclick="completeJob(event)" type="button" class="acceptTech" >Complete</button>
                </form>
                 
                <button type="button"  onclick="abortJob(event,{{$jobsClicked->id??$jobs[0]->id??''}})"  class="cancelBtn declineTech">Abort</button>
            @endif  
        
        </div>
    </div>
</div>

<!-- Modal end -->




        


                    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if(!($jobsClicked??''))
<script>
   boxCard = document.getElementById('highlight'+{{$jobs[0]->id??''}});
   boxCard.classList.add("showActive");
</script>
@else
<script>
   boxCard = document.getElementById('highlight'+{{$jobsClicked->id??''}});
   boxCard.classList.add("showActive");
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

@if(Session::has('fail'))
    <!-- Modal View -->
    <script>
        Swal.fire({
            icon: 'error',  
            text: "{{Session::get('fail')}}",
        })
    </script>
@endif

@if(isset($generatedJobsCount) && $generatedJobsCount > 0)
    <script>
        Swal.fire({
            text: "You have {{$generatedJobsCount}} New job Assigned.",
            icon: "info",
            confirmButtonText: "OK"
        });
    </script>
@endif

<script>
   function acceptJob(e){
        var form = e.target.closest('.formAccept')

        Swal.fire({
            text: 'Are you sure you want to accept?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
             allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                form.submit()
                }
        }   )
   }



   function abortJob(e,id){
        $('#abortModal'+id).modal('show')
         console.log('s');
   }

   function declineJob(e,modal,id){
        $('#declineModal'+id).modal('show')
        console.log();
   }

   function closeView(e){
        console.log('close');
        var modal = e.target.closest('.modal')
 
        $(modal).hide();
        $('.modal-backdrop').remove();

    }

    function deleteConfirm(e){
        var form = e.target.closest('form');

        Swal.fire({
            text: "Are you sure?, You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
             allowOutsideClick: false
        
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            }
        })
    }
    
     function completeJob(e){
        var form = e.target.closest('.formComplete');

        Swal.fire({
            text: 'Complete Task? (Make sure you already filled the reports)',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
             allowOutsideClick: false

            }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            }
        })
    }


//    function prooceedAbort(e,modal){
//         var form = e.target.closest('form')

//         form.action =  form.action + '?jobID=' + encodeURIComponent( sessionStorage.getItem('jobId')) +
//                 '&techId=' + encodeURIComponent( techId);
                    
//         form.submit()
        
//    }



</script>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);
    
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("image-slider");
      console.log(slides)
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
     
      slides[slideIndex-1].style.display = "block";  
     
    }
    </script>

@endsection
