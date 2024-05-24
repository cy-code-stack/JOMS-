@extends('../base')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/quotation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sidenavigation.css')}}">

<style>
    .techRowReports{
        width: 100%;
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
    }
    .rowIssueReport{
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 5px;
        min-width: 85%;
        border-radius: 10px;
        background: #FFF;
        box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.25);
        height: 60px;
        margin-right: 5px;
        color: #585858;
    }
    .rowPdf{
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        min-width: 14%;
        border-radius: 10px;
        background: #FFF;
        box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.25);
        height: 60px;
    }
    .rowPdf span{
        font-size: 30px;
        color: white;
        
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
            <h4>Product Quotation Report</h4>
        </div>

        <div class="user-wrapper">
            @include('includes/profilepopup')          
        </div>
    </div>


    <div class="body-content">

        

        <div class="main-table-content" style="display: flex;  flex-direction: column; align-items: start;">
             <div class="quotation-title">
                <h5 style="font-weight: 600; font-size: 30px; color: #585858; ">Product Quotation Report</h5>
            </div>     
            @foreach($jobs as $job)
            @if($job->job_status == "Complete")
         
            <div class="techRowReports">
                <div class="rowIssueReport">
                    <div style="min-width: 20%; display: flex; flex-direction: row;">
                        <h5 style="font-weight: 600; font-size: 13px;">Issue: {{$job->id}}</h5>
                    </div>
                    <div style="min-width: 25%;">
                        <h5 style="font-weight: 600; font-size: 13px;">{{$job->customer->first_name}} {{$job->customer->last_name}}</h5>
                    </div>
                    <div style="min-width: 38%;">
                        <p style="font-weight: 550; font-size: 13px;">Internet Connection Problem</p>
                    </div>
                    
                    <div class="status">
                        <div class="{{$job->job_status}}"></div>
                        <p>{{ $job->job_status }}</p>
                    </div>
                </div>
                
                
                <div class="rowPdf">
                      <form method="POST" action="{{route('report-generate-quotation-admin', ['id' => $job->id])}} ">
                        @csrf
                    <div style="width: 40px; height: 40px; background: #4AE115; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                    <button type='submit' style="border:none;background: transparent; width:100%;height:100%; border-radius: 5px;" ><span><i class="las la-file-pdf"></i></span></button>
                    </div>
                    </form>
                    <p style="font-weight: 550; font-size: 13px;">Complete</p>
                </div>
            </div>
               @endif
            @endforeach
               
            
        </div><!-- reports-table -->
    </div><!-- body-content -->
</div> <!-- main-content -->

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



@endsection
