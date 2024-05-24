<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\job_request;
use App\Models\customers_list;
use App\Models\accomplishment_report;
use Session;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use PDF;

class CustomerJobreqController extends Controller
{
    public function jobreqView(){

        $selectedJobsQuery = job_request::with('customer')->where('customer_id', Session::get('loginId'))->with('customer')->where('job_status', 'Verification')->orderByDesc('created_at')->get();
        $otherJobsQuery = job_request::with('customer')->where('customer_id', Session::get('loginId'))->with('customer')->where('job_status', '!=', 'Verification')->orderByDesc('created_at')->get();
    
        if(Session::has('loginId')){
            $user = customers_list::where('id',Session::get('loginId'))->first();
        }
        
          $quotationGenerated = job_request::where('generated', 'true')->where('customer_id', $user->id)->count();
        
        $forVerificationJob = job_request::where('job_status', 'Verification')->where('customer_id', $user->id)->count();
     

           $style = (object)[
            'nav'=>'margin:0'
        ];
        
        $selectedVal =  '';
        $mergedJobs = $selectedJobsQuery->concat($otherJobsQuery);
       
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6;
        $jobs = new LengthAwarePaginator(
            $mergedJobs->forPage($currentPage, $perPage),
            $mergedJobs->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        return view('customer.jobrequest',
        ['section'=>'customer',
        'currActive'=>'jobreq',
        'navigation'=>'customer', 
        'jobs'=>$jobs,
        'user' => $user,
        'selected'=>$selectedVal,
        'quotationGenerated' => $quotationGenerated,
        'forVerificationJob' => $forVerificationJob, 
        'style' =>  $style
        ]);
    }

    public function jobreqViewClicked($id){

        $selectedJobsQuery = job_request::with('customer')->where('customer_id', Session::get('loginId'))->with('customer')->where('job_status', 'Verification')->orderByDesc('created_at')->get();
        $otherJobsQuery = job_request::with('customer')->where('customer_id', Session::get('loginId'))->with('customer')->where('job_status', '!=', 'Verification')->orderByDesc('created_at')->get();
    
        if(Session::has('loginId')){
            $user = customers_list::where('id',Session::get('loginId'))->first();
        }
        
        $quotationGenerated = job_request::where('generated', 'true')->where('customer_id', $user->id)->count();
        
        $forVerificationJob = job_request::where('job_status', 'Verification')->where('customer_id', $user->id)->count();
    
           $style = (object)[
            'nav'=>'margin:0'
        ];

        $jobsClicked = job_request::find($id);
        
        $selectedVal =  '';
        $mergedJobs = $selectedJobsQuery->concat($otherJobsQuery);
       
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6;
        $jobs = new LengthAwarePaginator(
            $mergedJobs->forPage($currentPage, $perPage),
            $mergedJobs->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        return view('customer.jobrequest',
        ['section'=>'customer',
        'currActive'=>'jobreq',
        'navigation'=>'customer', 
        'jobs'=>$jobs,
        'user' => $user,
        'selected'=>$selectedVal,
        'quotationGenerated' => $quotationGenerated,
        'forVerificationJob' => $forVerificationJob, 
        'style' =>  $style,
        'jobsClicked'=> $jobsClicked,
        ]);
    }

    public function customerJobSorted(Request $request){
        $selectedJobsQuery = job_request::with('customer')->where('customer_id', Session::get('loginId'))->with('customer')->where('job_status', $request->statusSelected)->orderBy('job_status')->orderByDesc('created_at')->get();
        $otherJobsQuery = job_request::with('customer')->where('customer_id', Session::get('loginId'))->with('customer')->where('job_status', '!=', $request->statusSelected)->orderBy('job_status')->orderByDesc('created_at')->get();
    
        if(Session::has('loginId')){
            $user = customers_list::where('id',Session::get('loginId'))->first();
        }
          $quotationGenerated = job_request::where('generated', 'true')->where('customer_id', $user->id)->count();
        
        $forVerificationJob = job_request::where('job_status', 'Verification')->where('customer_id', $user->id)->count();
     

        $selectedVal =  $request->statusSelected;
        $mergedJobs = $selectedJobsQuery->concat($otherJobsQuery);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 6;
        $jobs = new LengthAwarePaginator(
            $mergedJobs->forPage($currentPage, $perPage),
            $mergedJobs->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $style = (object)[
            'nav'=>'margin:0'
        ];

        return view('customer.jobrequest', ['section'=>'customer','navigation'=>'customer','user' => $user,'currActive'=>'jobreq','jobs'=>$jobs, 
        'selected'=>$selectedVal,
        'quotationGenerated' => $quotationGenerated,
        'forVerificationJob' => $forVerificationJob,
        'style'=> $style,
        ]);
    }

    public function jobreqEdit(Request $request){
        $jobs = job_request::find($request->jobId);
        
       

        $jobs->job_type =  $request->jobType;
        $jobs->job_description =  $request->jobDescription;
        $result = $jobs->save();

       
        if($result){
            return back()->with('success', 'Edited Successfully');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
      
    }

    public function jobreqComplete(Request $request){
        // dd('ss');
        $jobs = job_request::with('techList')->with('customer')->orderByDesc('created_at')->find($request->jobID);
        
        $accomplishement =  new accomplishment_report;
        
        $validated = $request->validate([
            'rating' => 'required',
            'customerRemarks' => 'required',        
        ]);
        
    
        $accomplishement->job_id = $request->jobID;
        $accomplishement->client_name = $jobs->customer->first_name . ' ' . $jobs->customer->last_name;

        $accomplishement->save();

         date_default_timezone_set("Asia/Singapore");
        $jobs->job_status = 'Complete';    
        $jobs->rating = $request->rating;;   
        $jobs->completed_at = date('Y-m-d H:i:s');  
        $jobs->customer_remarks = $request->customerRemarks;    
        
        $result = $jobs->save();

        if($result){
            return back()->with('success', 'Success');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
    }
    
    
    public function jobreqCancel($id){
   
        $job = job_request::find($id);
        $job->job_status = 'Cancelled';   
        $result = $job->save();
         
        if($result){
            return back()->with('success', 'Job Cancelled Successfully');
        }else{
            return back()->with('fail', 'Fail to Cancell');
        }
    }


    public function generatePDF (Request $request, $id)
    {   
          $jobs = job_request::with('techList')->with('customer')->orderByDesc('created_at')->find($id);
        
        
          $jobs->each(function ($job) {
            $job->partsReplace = json_decode($job->partsReplace, true);
            $job->partsInplace = json_decode($job->partsInplace, true);
        });
        
          $data = [
            'title' => "Quotation Report",
            'details' => $jobs
            ];
        $pdf = PDF::loadView('technician.quotationReport', $data);
        $filename = 'my_' . time() . '.pdf';
        $pdfPath = storage_path("app/public/pdfs/{$filename}");
    
        // Save the PDF to the pdfs directory for safekeeping
        $pdf->save($pdfPath);
    
        $job = job_request::find($id);

        $job->generated = "Downloaded";     
        $job->save();
    
        // Return the PDF path in the response
        
         return back()->with('filename', $filename)->with('success', 'PDF Generated Successfully, Please Wait for the technician response')->with('pdfSuccess', '');
    }

    public function downloadPDF($filename)
    {
    $filePath = storage_path("app/public/pdfs/{$filename}");
    
    return response()->file($filePath, ['Content-Type' => 'application/pdf']);
    }  

public function approvePDF (Request $request, $id)
    {   
       
         $job = job_request::find($id);
         
         $job->generated = "Approved";     
         $result = $job->save();

        if($result){
            return back()->with('success', 'Approved Sucessfully, Please wait for the tech response');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
     
    }
    
    
    public function declineQuotation (Request $request)
    {   
       
         $job = job_request::find($request->jobID);
         
         $job->generated = "QuotationDecline";
         $job->customer_remarks = $request->customerRemarks;  
         $result = $job->save();

        if($result){
            return back()->with('success', 'Quotation Declined, Please wait for the tech response');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
     
    }
    
     


    
}