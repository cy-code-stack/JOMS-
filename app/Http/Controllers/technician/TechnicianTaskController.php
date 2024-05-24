<?php

namespace App\Http\Controllers\technician;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\job_request;
use App\Models\technician_list;
use Session;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\accomplishment_report;

class TechnicianTaskController extends Controller
{
    public function technicianTaskView(){
        
        $style = (object)[
            'nav'=>'margin:0'
        ];
       
        if(Session::has('loginId')){
            $user = technician_list::where('id',Session::get('loginId'))->first();
        }
        $generatedJobsCount = job_request::where('job_status', 'Assigned')->where('technician_id', $user->id)->count();
        $jobs = job_request::with('techList')->where('technician_id', Session::get('loginId'))->with('customer')->orderByDesc('created_at')->paginate(6);
        $selectedVal = 'null';
           
       
        
        return view('technician.techTask',['section'=>'technician','currActive'=>'task' ,'navigation'=>'technician','user' => $user,'jobs'=>$jobs,'selected'=>$selectedVal,'generatedJobsCount' => $generatedJobsCount, 'style' =>  $style]);
    }


    public function technicianTaskViewClicked($id){
        
        $style = (object)[
            'nav'=>'margin:0'
        ];
       
        $jobsClicked = job_request::find($id);

        if(Session::has('loginId')){
            $user = technician_list::where('id',Session::get('loginId'))->first();
        }
        $generatedJobsCount = job_request::where('job_status', 'Assigned')->where('technician_id', $user->id)->count();
        $jobs = job_request::with('techList')->where('technician_id', Session::get('loginId'))->with('customer')->orderByDesc('created_at')->paginate(6);
        $selectedVal = 'null';
           
        return view('technician.techTask',['section'=>'technician','currActive'=>'task' ,'navigation'=>'technician','user' => $user,'jobs'=>$jobs,'selected'=>$selectedVal,'generatedJobsCount' => $generatedJobsCount, 'style' =>  $style, 'jobsClicked'=>$jobsClicked]);
    }

    public function technicianTaskSorted(Request $request){
        
        if($request->statusSelected == '0'){
            $request->statusSelected = 0;
        }
        $selectedJobsQuery = job_request::with('techList')->where('technician_id', Session::get('loginId'))->with('customer')->where('job_status', $request->statusSelected)->orderBy('job_status')->orderByDesc('created_at')->get();
        

        $otherJobsQuery = job_request::with('techList')->where('technician_id', Session::get('loginId'))->with('customer')->where('job_status', '!=', $request->statusSelected)->orderBy('job_status')->orderByDesc('created_at')->get();
    
        if(Session::has('loginId')){
            $user = technician_list::where('id',Session::get('loginId'))->first();
        }
       
         $generatedJobsCount = job_request::where('job_status', 'Assigned')->where('technician_id', $user->id)->count();
         
     
         $style = (object)[
            'nav'=>'margin:0'
        ];
        $selectedVal =  $request->statusSelected;
        // $mergedJobs = $selectedJobsQuery->concat($otherJobsQuery);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $jobs = new LengthAwarePaginator(
            $selectedJobsQuery->forPage($currentPage, $perPage),
            $selectedJobsQuery->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    
        return view('technician.techTask', ['section'=>'technician','navigation'=>'technician','user' => $user,'currActive'=>'task','jobs'=>$jobs, 'selected'=>$selectedVal,'generatedJobsCount' => $generatedJobsCount, 'style'=>$style]);
    }
    

    public function techAccept($id){
        $jobs = job_request::find($id);
      
        $jobs->job_status = 'On-going';     
    
        $result = $jobs->save();
        
   

        if($result){
            return back()->with('success', 'Success');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
    }
    public function techAbort(Request $request, $id){
        
          date_default_timezone_set("Asia/Singapore");
        $jobs = job_request::find($id);
      
        $jobs->job_status = 'Aborted';     
        $jobs->remarks = $request->reasonText;
        $jobs->aborted_at = date('Y-m-d h:i:s');  

        $result = $jobs->save();

        if($result){
            return back()->with('success', 'Success');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
    }
    public function techDecline(Request $request, $id){
        $jobs = job_request::find($id);
    
        $jobs->job_status = 'Decline';     
        $jobs->remarks = $request->reasonText; 
     

        $result = $jobs->save();

        if($result){
            return back()->with('success', 'Success');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }

    }
    public function techDelete($id){
        $jobs = job_request::find($id);

        $remove = $jobs->delete();

        if($remove){
            return back()->with('success', 'Job Removed Successfully');
        }else{
            return back()->with('fail', 'Fail to Remove');
        }
    }
    
       public function jobreqComplete($id){
        $jobs = job_request::find($id);

         if($jobs->created_By_Admin == 'Yes'){
             date_default_timezone_set("Asia/Singapore");
            $accomplishement =  new accomplishment_report;
        
        
            $accomplishement->job_id = $id;
            $accomplishement->client_name = $jobs->customer->first_name . ' ' . $jobs->customer->last_name;
            $accomplishement->created_at = date('Y-m-d h:i:s');
            $accomplishement->save();
    
            $jobs->generated = 'Approved';
            $jobs->job_status = 'Complete';    
            $jobs->completed_at = date('Y-m-d h:i:s');
            $result = $jobs->save();
            if($result){
                return back()->with('success', 'Success');
             }else{
                return back()->withInput()->with('fail', 'Failed to process');       
            }
        }
        
        if($jobs->generated == Null){
             return back()->withInput()->with('fail', 'Please Fillup the quotation First');   
        }
        
        if($jobs->generated == 'True' || $jobs->generated == 'Downloaded'){
             return back()->withInput()->with('fail', 'The Customer has not yet Approved the Quotation');   
        }
        
        if($jobs->generated == 'Approved'){
            
            $jobs->job_status = 'Verification';  
            $result = $jobs->save();

            if($result){
                return back()->with('success', 'Success');
             }else{
                return back()->withInput()->with('fail', 'Failed to process');       
            }
        }
        

        
        
     
    }


}