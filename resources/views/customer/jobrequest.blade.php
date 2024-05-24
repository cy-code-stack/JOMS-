@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/customer/jobreq.css')}}">
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
    .jobCards:hover{
        background-color: hsla(0, 100%, 90%, 0.3);
    }


    .jobCards form{
        width: 85%;
        
    }
    .jobCards .jobCardDivs{
        display: flex;
        width: 100%;
    }
    .formComplete{
        width: 100%;
    }

    .jobCardDivs button{
        border:none;
        display: flex;
        background-color: #FFF;
        width: 100%;
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
    .buttons_tables{
        width: 15%;
        padding-right:20px;
        display:flex;
        justify-content: flex-end;
    }

    .buttons_tables #cancelForm{
        display:flex;
        width: 100%;
        justify-content: flex-end;
    }

    .buttons_tables button{
        width: 70px;
        height: 35px;
        border: none;
        color: white;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        border-radius: 5px;
        width:80%;
        background: #FC8C24;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    }

    .jobDesc{
        background-color: white;
        padding: 10px 10px;
        max-width: 1000px;
        background-color: var(--dominant-color);
        box-shadow: 0px 1px 1px 1px rgba(130, 130, 130, 0.6);
        border-radius: 10px;
        width: 40%;
        height: 600px;
    }
    .jobStatus{
        width:100%;
        display: flex;
        flex-direction: row;
        margin-bottom: 5px;
    }
    .jobImage{
        height: 30vh;
        width: 100%;
        background-color: grey;
        border-radius: 10px;
        margin-bottom: 10px;
        position:relative
    }

    .jobImage img{
        width:100%;
        height:100%;
    }
    .jobInfo{
        width: 100%;
    }
    .jobInfo h5, select{
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px
        
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

    .editableDescription{
        border: 1px solid gray;
      
    
    }

    .jobDescription p{
        color: black;
        text-align: justify;
        text-justify: inter-word;
        margin-bottom: 10px;
        margin-top:5px;
        margin-left:5px;
    }
 

    .ratingDesc p{
        margin-top:5px;
        margin-left:5px;
    }
    .remarksCustomer{
        width: 100%;
        margin-bottom: 5px;
        display: flex;
        justify-content: space-between;
    }
    .ratingDesc{
        margin-bottom: 10px;
    }


    .techBtns{
        display: flex;
        width: 100%;
        justify-content: end;
        align-items: center;
        margin-top:20px;
        
    }
    .techBtns button{
        border: none;
        width: 80px;
        height: 35px;
        margin: 3px;
        border-radius: 5px;
    }
     .showActive{
        background-color: hsla(0, 100%, 90%, 0.3);
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
.main-container{
    align-items: start; 
    width: 100%; 
    height: calc(100vh - 90px); 
    padding: 10px; 
    display: flex; 
    flex-direction: row; 
    overflow: hidden;
}
.main-table{
    width: 60%; 
    height:600px; 
    margin-bottom: 0px;
}

@media (min-width: 990px) and (max-width: 1086px){
    .techBtns{
        margin: 3px;
        width: 100%;
    }
    .techBtns button{
        right: 1;
        height: 30px;
        font-size: 12px;
    }
}

@media (min-width: 550px) and (max-width: 989px){
    .main-container{
        display: block;
        overflow: scroll;
        padding: 10px 30px;
    }
    .main-table{
        width: 100%;
        padding: 15px;
        height: 550px;
        margin-bottom: 10px;
        overflow: scroll;
    }
    .jobDesc{
         width: 100%; !important
    }
}
@media (min-width: 320px) and (max-width: 549px){
    .main-container{
        display: block;
        overflow: scroll;
        
    }
    .image-slider img{
        object-fit: contain;
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
        height: 650px;
        width: 100%; !important
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
        margin-right: 0px;
        padding: 0;
    }
}

</style>
@endsection

@section('navbar')
    @include('includes/nav')
@endsection

@section('content')
<div class="main-container">
    <div class="main-table">
        <div class="table_header">
            <h2>Job Request</h2>
            <div class="select-wrapper">
                <form  action="{{route('sort-status-customer')}}" method="POST">
                @csrf
                <label>Sort by </label>
                    <select id="status-select" name="statusSelected" class="custom-select">
                        
                        @if($selected == 'Pending')
                            <option value="null" disabled>Select..</option>   
                            <option value="Complete" >Complete</option>   
                            <option value="Pending" selected>Pending</option>                      
                        
                            <option value="On-going">Ongoing</option>
                            <option value="Aborted">Aborted</option>
                            <option value="Verification">Verification</option>
                        @elseif($selected == 'On-going')
                            <option value="" disabled>Select..</option>    
                            <option value="Complete" >Complete</option>   
                            <option value="Pending" >Pending</option>
                            <option value="On-going" selected>Ongoing</option>
                            <option value="Aborted">Verification</option>
                            <option value="Verification">Aborted</option>
                        @elseif($selected == 'Aborted')
                            <option value="" disabled>Select..</option>  
                            <option value="Complete" >Complete</option>   
                            <option value="Pending" >Pending</option>
                            <option value="On-going" >Ongoing</option>
                            <option value="Aborted" selected>Aborted</option>
                            <option value="Verification">Verification</option>
                        @elseif($selected == 'Complete')
                            <option value="" disabled>Select..</option>    
                            <option value="Complete" selected>Complete</option>                  
                            <option value="Pending" >Pending</option>
                            <option value="On-going">Ongoing</option>
                            <option value="Aborted">Aborted</option>
                            <option value="Verification">Verification</option>
                        @elseif($selected == 'Verification')
                            <option value="" disabled>Select..</option>    
                            <option value="Complete">Complete</option>                  
                            <option value="Pending" >Pending</option>
                            <option value="On-going">Ongoing</option>
                            <option value="Aborted">Aborted</option>
                        
                            <option value="Verification" selected>Verification</option>
                        @else
                            <option value="" disabled selected>Select..</option>   
                            <option value="Complete" >Complete</option>                        
                            <option value="Pending" >Pending</option>
                            <option value="On-going" >Ongoing</option>
                            <option value="Aborted" >Aborted</option>
                            <option value="Verification">Verification</option>
                        
                        @endif                
                    </select>
                </form>
            </div>
        </div>

        @foreach($jobs as $job)
        <div id="highlight{{$job->id}}" class="jobCards">
            <form  method="get" action="{{ route('job-view-clicked', $job->id) }}">
            @csrf 
                <div  class="jobCardDivs">
                    <button class="btnClicked" style="background-color:transparent" type="submit">
                        <div class="jobIssueID">
                            <p>Issue ID: {{$job->id}}</p>
                        </div>
                        <div class="jobIssue">
                            <p>{{$job->job_type}}</p>
                        </div>
                        <div class="jobIssuePending">                      
                            @if(($job->job_status == 'Decline' || $job->job_status == 'Assigned'))
                            <div class="status">
                                <div class="Pending"></div>
                                <p>Pending</p>
                            </div>
                            @else
                            <div class="status">
                                <div class="{{$job->job_status}}"></div>
                                <p>{{$job->job_status}}</p>
                            </div>
                            @endif 
                        </div>
                    </button>
                </div>          
            </form>      
            <div class="buttons_tables d-flex" style="width:170px; display:flex; justify-content:center, align-items:center">   
                @if(($job->job_status == 'Pending'))
                <form method="POST" action="{{ route('job-cancel', $job->id) }}">  
                @csrf        
                    <button type="button" onclick="cancelConfirm(event)" class="cancelButton" data-form-id="{{ $job->id }}">Cancel</button>         
                </form>  
                 @elseif(($job->job_status == 'Aborted'))
                     <div class="text_wrapper " style="display:flex; align-items: center;">
                        <p style="text-align:center; font-weight:600; color:red; margin-right:10px;">Aborted by technician</p> 
                  
                    </div>  
                @elseif($job->job_status == 'On-going' || $job->job_status == 'Verification')   
                    @if($job->generated == "True" || $job->generated == "Downloaded")     
                    <div class="text_wrapper " style="display:flex; align-items: center;">
                        <p style="text-align:center; font-weight:600; color:green; margin-right:10px;">Quotation was Generated</p> 
                        <span class="new-notif-table">NEW </span> 
                    </div>                                                                                                  
                    @endif
                    
                    @if($job->generated == "QuotationDecline")     
                    <div class="text_wrapper " style="display:flex; align-items: center;">
                        <p style="text-align:center; font-weight:600; color:red; margin-right:10px;">Quotation was Declined, Wait for update</p> 
                    </div>                                                                                                  
                    @endif
                    
                    @if($job->generated == "Approved")     
                    <div class="text_wrapper " style="display:flex; align-items: center;">
                        <p style="text-align:center; color:green;  font-weight:600; margin-right:10px;">Quotation was Approved</p> 
             
                    </div>                                                                                                  
                    @endif
                @endif     
                        
                
            </div>
        </div>
        @endforeach
    </div>
    
    <div style="width: 1%"></div>



    <div class="jobDesc">
     <form class="edit-saved-form" method="POST" action="{{ route('job-edit', $jobsClicked->id??$jobs[0]->id??'') }}">  
     @csrf
     
        <div class="jobStatus">
            <div class="status">    
                @if(isset($jobsClicked) && ($jobsClicked->job_status ?? $jobs[0]->job_status ??'') == 'Decline' || ($jobsClicked->job_status ?? $jobs[0]->job_status ??'') == 'Assigned')
                    <div class="Pending"></div>
                    <p>Pending</p>
                @else
                <div class="{{$jobsClicked->job_status ?? $jobs[0]->job_status??''}}"></div>
                <p>{{$jobsClicked->job_status ?? $jobs[0]->job_status??''}}</p>
                @endif 
            </div>    
        </div>
        <div class="jobImage">
             <!--<img id="image-preview" src="{{ isset($jobsClicked) ? asset('img/' . $jobsClicked->issue_image) : (isset($jobs[0]) ? asset('img/' . $jobs[0]->issue_image) : asset('img/logo-filled.jpg')) }}" alt="Image Issue">-->
             
            
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
                    <h5 class="editable">{{$jobsClicked->job_type ?? $jobs[0]->job_type??''}}</h5>
                </div>
             
                <p>Customer Name: {{$jobsClicked->customer->first_name??  $jobs[0]->customer->first_name??'' }} {{ $jobsClicked->customer->last_name ?? $jobs[0]->customer->last_name??''}}</p>
                <p>Contact Number: {{$jobsClicked->customer->mobile_number?? $jobs[0]->customer->mobile_number??''}}</p>
            </div>
            <input type="text" name='jobId' value="{{$jobsClicked->id ?? $jobs[0]->id??''}}" hidden>
            <div class="jobIcons">
                @if(($jobsClicked->job_status??$jobs[0]->job_status??'') == 'Pending')
                <div class="spanIcons edtBtn">              
                    <button type="button" onclick="toggleEditMode(event,'{{strval($jobsClicked->job_type ?? $jobs[0]->job_type??'') }}')" class="btn">  <span><i class="las la-edit"></i></span></button>  
                </div>
                @endif        
                @if(($jobsClicked->job_status?? $jobs[0]->job_status??'') == "On-going" || ($jobsClicked->job_status?? $jobs[0]->job_status??'') == 'Verification' || ($jobsClicked->job_status?? $jobs[0]->job_status??'') == 'Complete')  
                    @if(($jobsClicked->generated?? $jobs[0]->generated??'') == "True" || ($jobsClicked->generated?? $jobs[0]->generated??'') == "Downloaded" || ($jobsClicked->generated?? $jobs[0]->generated??'') == "Approved")                                                                                                                                                 
                        <div class="spanIcons"  style="border:none;background: red;">
                       
                                @csrf
                            @if(isset($jobsClicked))
                            <a href="generatePDF/{{$jobsClicked->id??$jobs[0]->id??''}}">
                            @else
                            <a href="jobreq/view/generatePDF/{{$jobsClicked->id??$jobs[0]->id??''}}">
                            @endif
                            
                                <div style="width: 100%; height: 40px;  border-radius: 5px; display: flex; align-items: center; justify-content: center; margin-right:10px">                        
                                    <button type='button' style="border:none;background: red; width:100%;height:100%; border-radius: 5px;" ><span><i class="las la-file-pdf"></i></span></button>          
                                    
                                </div>
                            </a>
                      
                        </div>
                    @endif                              
                @endif

                <div class="spanIcons editSaveBtn" style="background-color: #4AE115; display:none">
                    <button  type="button" class="btn" onclick="saveEdit(event)"> <span><i class="las la-check"></i></span></button>        
                </div>
                <div class="spanIcons">
                    <a href="/customer/location"><span><i class="las la-map-marker-alt"></i></span></a>
                </div>
                <div class="spanIcons">
                    <a href="/customer/jobreq"><span><i class="las la-times-circle"></i></span></a>
                </div>



           
            </div>
        </div>
        <div class="jobDescription">
            <h5>Description:</h5>
            <p class="" contentEditable="false">{{$jobsClicked->job_description ?? $jobs[0]->job_description??''}}</p>
        </div>
        @if(($jobsClicked->generated?? $jobs[0]->generated??'') == "True" || ($jobsClicked->generated?? $jobs[0]->generated??'') == "QuotationDecline" || ($jobsClicked->generated?? $jobs[0]->generated??'') == "Approved")
            <div class="jobDescription">
                <h5>Quotaion Remarks:</h5>
            <p class="" contentEditable="false">{{$jobsClicked->remarksAndAccomplishment ?? $jobs[0]->remarksAndAccomplishment??''}}</p>
        </div>
        @endif  
        <div style="width: 100%; height: 2px; background-color: #E6D9D7; border-radius: 5px; margin-bottom: 5px;"></div>
        @if(($jobsClicked->job_status ?? $jobs[0]->job_status??'') == 'Complete' || ($jobsClicked->generated?? $jobs[0]->generated??'') == "QuotationDecline")
            <div class="remarksCustomer">
                <p>Customer Remarks: </p>
                <p>Rating: {{$jobsClicked->rating ?? $jobs[0]->rating??''}} stars</p>
            </div>
            <div class="ratingDesc">
                <p>{{$jobsClicked->customer_remarks ?? $jobs[0]->customer_remarks??''}}</p>   
            </div>
        @else
            <div class="remarksCustomer">
                <p>Customer Remarks: -- </p>
                <p>Rating: -- </p>
            </div>
            <div class="ratingDesc">
            </div>
        @endif  

        <div style="width: 100%; height: 2px; background-color: #E6D9D7; border-radius: 5px; margin-bottom: 5px;"></div>
    
        @if(($jobsClicked->job_status?? $jobs[0]->job_status??'') == 'Aborted')
            <div class="remarksCustomer">
                <p>Abort Reason:</p>
            </div>
            <div class="ratingDesc">
                <p>{{$jobsClicked->remarks ?? $jobs[0]->remarks??''}}</p>   
            </div>
        @else
            <div class="remarksCustomer">
                <p>Abort Reason: --</p>
            </div>
            <div class="ratingDesc">    
          </div>
        @endif 
        <div style="width: 100%; height: 2px; background-color: #E6D9D7; border-radius: 5px; margin-bottom: 5px;"></div>
    </form>   
        <div class="jobsCreatedStatus">
            <p style="color: blue;">Date Created: {{$jobsClicked->created_at ?? $jobs[0]->created_at??''}}</p>
            @if(($jobsClicked->job_status ?? $jobs[0]->job_status??'') == 'On-going' || ($jobsClicked->job_status ?? $jobs[0]->job_status??'') == 'Verification' || ($jobsClicked->job_status ?? $jobs[0]->job_status??'') == 'Complete')
                <p style="color: blue;">Date Assigned: {{$jobsClicked->assigned_at ?? $jobs[0]->assigned_at??''}}</p> 
            @endif  
            @if(($jobsClicked->job_status ?? $jobs[0]->job_status??'') == 'Complete')
            <p style="color: green;">Date Completed:  {{$jobsClicked->completed_at ?? $jobs[0]->completed_at??''}}</p>
            @endif 
            @if(isset($jobsClicked) && ($jobsClicked->job_status ?? $jobs[0]->job_status??'') == 'Aborted')
                 <p style="color: red;">Date Aborted: {{$jobsClicked->aborted_at ?? $jobs[0]->aborted_at??''}}</p>
            @endif 
            
        </div>     

       <div class="techBtns">
            @if(($jobsClicked->job_status?? $jobs[0]->job_status??'') == 'On-going')   
                @if(($jobsClicked->generated?? $jobs[0]->generated??'') == "True" || ($jobsClicked->generated?? $jobs[0]->generated??'') == "Downloaded")                                                                                                  
                    <form class="formAccept" method="POST" action="{{ route('approvePDF', ($jobsClicked->id?? $jobs[0]->id??'')) }}">
                        @csrf 
                            <button type="submit" style = "padding: 2px 3px; width:70px; color: #fff;  font-size:10px; background-color: orange; border:none; border-radius:5px; margin: 0 10px; height: 30px;">Approve</button> 
                    </form> 
                    <!--{{ route('declineQuotation', ($jobsClicked->id?? $jobs[0]->id??'')) }}-->
                     <!--<form class="formDecline" method="POST"  action="{{ route('declineQuotation', ($jobsClicked->id?? $jobs[0]->id??'')) }}"> -->
                     <!--   @csrf -->
                            <button type="submit" data-toggle="modal" data-target="#declineModal" onclick="modalCompleteWidow(event,{{$jobsClicked->id??$jobs[0]->id??''}})" style = "background-color:red; padding: 2px 3px; width:70px; color: #fff;  font-size:10px; border:none; border-radius:5px; margin: 0 10px; height: 30px;">Decline</button> 
                    <!--</form> -->
                @endif
            @endif
            @if(($jobsClicked->job_status?? $jobs[0]->job_status??'') == 'Verification')   
                <button style ="width:90px" type="button" onclick="modalCompleteWidow(event,{{$jobsClicked->id??$jobs[0]->id??''}})" data-toggle="modal" data-target="#jobComplete" class="btn btn-primary completeBtn">Complete</button>                                          
            @endif
        </div> 


    </div>   
</div>

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

<!--Decline Modal-->
<div class="modal fade" id="declineModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Decline</h4>
            </div>           
            <div class="modal-body-rating">
                <div class="star-wrapper">
                    <form class="formComplete" method="POST" action="{{ route('declineQuotation')}}">                              
                        @csrf                  
                        <center>
                        <div class="rating">
                            <h5>State your reason</h5>
                        </div>
                        <textarea class="form-control" id="" rows="3" name="customerRemarks" placeholder="Comments" required></textarea>
                        <div class="btn-rating-group">
                        
                        <button onclick="submitDecline(event)" type="button" class="btnSubmit">Submit</button>
                        <button data-dismiss="modal" class="btnCancel">Cancel</button>
                        </div>
                    </form> 
                </div>                            
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(!($jobsClicked??''))
<script>
   boxCard = document.getElementById('highlight'+{{$jobs[0]->id??''}});
   boxCard.classList.add("showActive");
</script>
@else
<script>
   boxCard = document.getElementById('highlight'+{{$jobsClicked->id}});
   boxCard.classList.add("showActive");
</script>
@endif

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
            text: "{{ Session::get('success') }}",
        });
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

@if(Session::has('pdfSuccess'))
    <!-- Modal View -->
    <script>
        // Open PDF in a new tab using JavaScript
        window.open("{{ url('/download-pdf/' . session('filename')) }}", '_blank');
    </script>
@endif




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




<script>
    function toggleEditMode(e,jobValue) {
        var jobDescription = document.querySelector('.jobDescription p');
        var jobtype = e.target.closest('.jobTypeClass');
        var editBtn = e.target.closest('.edtBtn');
        var savedBtn = document.querySelector('.editSaveBtn');

        console.log(savedBtn)
        editBtn.style.display = 'none';
        savedBtn.style.display = 'flex';

        jobDescription.contentEditable = 'true';
        jobDescription.classList.add('editableDescription')
        
        console.log(jobValue)
        
        $('.editable').each(function(){      

                $('.jobTypeClass').each(function(){ 
                    
                    if(jobValue == 'Cctv Installation'){
                       this.innerHTML = ''+
                        '<select id="jobType" name="jobType" required>  ' +
                        '    <option value="0" disabled >Select here...</option> ' +
                        '    <option value="Cctv Installation" selected>Cctv Installation</option> ' +
                        '    <option value="Solar Installation">Solar Installation</option> ' +
                        '    <option value="Internet Installation">Internet Installation</option> ' +
                        '    <option value="Repair and Installation">Repair and Installation</option> ' +
                        '    <option value="Others">Others</option> ' +
                        ' </select> ' ;
                    }else if(jobValue == 'Solar Installation'){
                         this.innerHTML = ''+
                            '<select id="jobType" name="jobType" required>  ' +
                            '    <option value="0" disabled >Select here...</option> ' +
                            '    <option value="Cctv Installation">Cctv Installation</option> ' +
                            '    <option value="Solar Installation" selected>Solar Installation</option> ' +
                            '    <option value="Internet Installation">Internet Installation</option> ' +
                            '    <option value="Repair and Installation">Repair and Installation</option> ' +
                            '    <option value="Others">Others</option> ' +
                            ' </select> ' ;
                    }else if(jobValue == 'Internet Installation'){
                        this.innerHTML = ''+
                            '<select id="jobType" name="jobType" required>  ' +
                            '    <option value="0" disabled >Select here...</option> ' +
                            '    <option value="Cctv Installation">Cctv Installation</option> ' +
                            '    <option value="Solar Installation">Solar Installation</option> ' +
                            '    <option value="Internet Installation" selected>Internet Installation</option> ' +
                            '    <option value="Repair and Installation">Repair and Installation</option> ' +
                            '    <option value="Others">Others</option> ' +
                            ' </select> ' ;
                    }else if(jobValue == 'Repair and Installation'){
                        this.innerHTML = ''+
                            '<select id="jobType" name="jobType" required>  ' +
                            '    <option value="0" disabled >Select here...</option> ' +
                            '    <option value="Cctv Installation">Cctv Installation</option> ' +
                            '    <option value="Solar Installation">Solar Installation</option> ' +
                            '    <option value="Internet Installation">Internet Installation</option> ' +
                            '    <option value="Repair and Installation" selected>Repair and Installation</option> ' +
                            '    <option value="Others">Others</option> ' +
                            ' </select> ' ;
                    }else{
                      this.innerHTML == ''+
                        '<select id="jobType" name="jobType" required>  ' +
                        '    <option value="0" disabled >Select here...</option> ' +
                        '    <option value="Cctv Installation">Cctv Installation</option> ' +
                        '    <option value="Solar Installation">Solar Installation</option> ' +
                        '    <option value="Internet Installation">Internet Installation</option> ' +
                        '    <option value="Repair and Installation">Repair and Installation</option> ' +
                        '    <option value="Others" selected>jobValue</option> ' +
                        ' </select> ' ;
                    }
                 
                });      
        });

    }

    function closeView(e){
        console.log('close');
        var footer = e.target.closest('.footerEditClass');
        var modal = e.target.closest('.modal')
        $('.editable').each(function(){        
                this.contentEditable = 'false';
                $('.jobTypeClass').each(function(){ 
                    @if(isset($job))
                        this.innerHTML = '<p id="jobType" class="editable" contenteditable="false">{{$job->job_type}}</p>';
                    @else
                        this.innerHTML = '<p id="jobType" class="editable" contenteditable="false">No job available</p>';
                    @endif            
                      });  

                footer.innerHTML = ''+
                '<button type="button" onclick="toggleEditMode(event)" class="btn btn-primary edtBtn">Edit</button> ' +
                '<button type="button" onclick="closeView(event)" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>  ';         
        });
       
        $(modal).hide();
        $('.modal-backdrop').remove();

    }

    function modalCompleteWidow(e,jobId){
        console.log(jobId)
        sessionStorage.setItem('jobId', jobId);
        var modal = e.target.closest('.modal')  
        $(modal).hide();
        $('.modal-backdrop').remove();
  
    }



    


    function saveEdit(e){
        var form = e.target.closest('.edit-saved-form')
        // var jobType = document.getElementById('jobType').value;
        var jobType = document.querySelector('#jobType').value;   
        var jobDescription = document.querySelector('.jobDescription p').textContent;  ;
        
        console.log(form)
        form.action =  form.action + '?jobType=' + encodeURIComponent(jobType) +
                  '&jobDescription=' + encodeURIComponent(jobDescription);

        if(jobType === '0'){
            Swal.fire({
                icon: 'error',  
                text: "Please Select a problem",    
            })
        }else{

            form.submit()
        }
      
    }


    function submitJobRating(e){
        var form = e.target.closest('form')
        form.action =  form.action + '?jobID=' + encodeURIComponent( sessionStorage.getItem('jobId')) 
                         
                          
        form.submit()
        console.log(form);
    }
    
    
     function submitDecline(e){
        var form = e.target.closest('form')
        form.action =  form.action + '?jobID=' + encodeURIComponent( sessionStorage.getItem('jobId')) 
                         
                          
        form.submit()
        console.log(form);
    }


    

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