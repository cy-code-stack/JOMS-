<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_list;
use App\Models\job_request;
use App\Models\technician_list;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\customers_list;


class AdminJobrequestController extends Controller
{
    public function jobreqView(){
        $jobs = job_request::with('techList')->orderBy('created_at', 'desc')->paginate(10);
        $technicians = technician_list::all();
        $jobsPaginated = job_request::with('techList')->orderBy('created_at', 'desc')->get();
    
        if(Session::has('loginId')){
            $user = admin_list::where('id', Session::get('loginId'))->first();
        }
        $customers = customers_list::all();
        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        
        $technicianCounts = job_request::select('technician_id', \DB::raw('COUNT(*) as count'))
            ->whereIn('job_status', ['Pending', 'On-going', 'Assigned'])
            ->groupBy('technician_id')
            ->pluck('count', 'technician_id')
            ->all();
    
        $statusCounts = $jobsPaginated->groupBy('job_status')->map->count();
        $selectedVal = 'null';
        $selectedValArea = 'null';
    
        return view('admin.addjobreq', [
            'section' => 'admin',
            'jobs' => $jobs,
            'currActive' => 'jobReq',
            'user' => $user,
            'technicians' => $technicians,
            'technicianCounts' => $technicianCounts,
            'selected' => $selectedVal,
            'areaSelected' => $selectedValArea,
            'generatedJobsCount' => $generatedJobsCount,
            'customers' => $customers,
        ]);
    }

    public function adminAddRequest(Request $request){
        $job = new job_request;
        $customer = customers_list::find($request->customerID);
        $technician = technician_list::find($request->techID);
        
        if (!$customer) {
            return back()->withInput()->with('fail', 'Customer Does not Exist');
        } 
        
        
        if (!($request->jobType == "Others")) {
            $job->job_type = $request->jobType;
        } else {
            $job->job_type = $request->otherSelected;
        }
    
        if (isset($request->jobDescription)) {
            $job->job_description = $request->jobDescription;
        } else {
            $job->job_description = "";
    }
        
        $imageNames[] = 'logo-filled.jpg'; 
        date_default_timezone_set("Asia/Singapore");
        $job->issue_image = serialize($imageNames);
        $job->customer_id = $customer->id;
        $job->created_By_Admin = 'Yes';
        $job->address = $customer->fullAdress;
        $job->technician_id = $request->techID;
        $job->job_status = 'Assigned'; 
        $job->assigned_at = date('Y-m-d h:i:s');     
        $job->remarks = ''; 
        $job->job_area =  $technician->area; 
        $job->created_at = date('Y-m-d h:i:s');
    
        $result = $job->save();
    
        if ($result) {
            return back()->withInput()->with('success', 'You have successfully submitted the request.');
        } else {
            return back()->withInput()->with('fail', 'Job Request Failed to submit');
        }
    }
    
    public function assignTech(Request $request){
        date_default_timezone_set("Asia/Singapore");
        $jobs = job_request::find($request->jobID);
  
    
        $jobs->technician_id = $request->techId;
        $jobs->job_status = 'Assigned'; 
        $jobs->assigned_at = date('Y-m-d h:i:s');     
        $jobs->job_area =  $request->techArea; 
        $jobs->remarks = ''; 

        $result = $jobs->save();

        if($result){
            return back()->with('success', 'Success');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
    }

    public function cancelTech($jobId){
           date_default_timezone_set("Asia/Singapore");
        $jobs = job_request::find($jobId);
      
        $jobs->technician_id = null;
        $jobs->job_status = 'Pending';     
        $jobs->remarks = ''; 
        $jobs->created_at = date('Y-m-d h:i:s');

        $result = $jobs->save();
   
    
        if($result){
            return back()->with('success', 'Assigned Successfuly');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
    }

    public function jobReqSorted(Request $request){
        if($request->statusSelected == '0'){
            $request->statusSelected = 0;
        }
        
        $selectedJobsQuery = job_request::with('techList')->where('job_status', $request->statusSelected)->orderBy('job_status')->orderByDesc('created_at')->get();
        $otherJobsQuery = job_request::with('techList')->where('job_status', '!=', $request->statusSelected)->orderBy('job_status')->orderByDesc('created_at')->get();
        $technicians = technician_list::all();
        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        
        $customers = customers_list::all();
        
        $selectedVal =  $request->statusSelected;
        // $mergedJobs = $selectedJobsQuery->concat($otherJobsQuery);
      $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $jobs = new LengthAwarePaginator(
            $selectedJobsQuery->forPage($currentPage, $perPage),
            $selectedJobsQuery->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $technicianCounts = job_request::select('technician_id', \DB::raw('COUNT(*) as count'))
        ->whereIn('job_status', ['Pending', 'On-going', 'Assigned'])
        ->groupBy('technician_id')
        ->pluck('count', 'technician_id')
        ->all();

        $jobsPaginated = job_request::with('techList')->get();
        $statusCounts = $jobsPaginated->groupBy('job_status')->map->count();

      
        return view('admin.addjobreq', ['section'=>'admin','user' => $user,'jobs'=>$jobs,'currActive'=>'jobReq','technicians' => $technicians, 'technicianCounts'=>$technicianCounts,'jobsPaginated'=>$jobsPaginated, 'statusCounts'=>$statusCounts,  'selected'=>$selectedVal,'areaSelected'=>'null','generatedJobsCount'=>$generatedJobsCount,'customers'=>$customers ]);
    }
    
    
    public function jobReqSortedArea(Request $request){
        
          if($request->statusSelectedArea == '0'){
            $request->statusSelectedArea = 0;
        }
        
        $selectedJobsQuery = job_request::with('techList')->where('job_area', $request->statusSelectedArea)->orderBy('job_status')->orderByDesc('created_at')->get();
    //     $selectedJobsQuery = job_request::with('techList')
    //                         ->whereHas('techList', function ($query) use ($request) {
    //                             $query->where('area', $request->statusSelectedArea);
    //                         })
    //                         ->orderBy('job_status')
    //                         ->orderByDesc('created_at')
    //                         ->get();
        
    //   $otherJobsQuery = job_request::with('techList')
    //             ->whereHas('techList', function ($query) use ($request) {
    //                 $query->where('area', '!=', $request->statusSelectedArea);
    //             })
    //             ->orderBy('job_status')
    //             ->orderByDesc('created_at')
    //             ->get();
                            
        // $otherJobsQuery = job_request::with('techList')->where('area', '!=', $request->statusSelectedArea)->orderBy('job_status')->orderByDesc('created_at')->get();
        $technicians = technician_list::all();
        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        
        $customers = customers_list::all();

        $selectedVal = 'null';
        $selectedValArea = $request->statusSelectedArea;
        // $mergedJobs = $selectedJobsQuery->concat($otherJobsQuery);
      $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $jobs = new LengthAwarePaginator(
            $selectedJobsQuery->forPage($currentPage, $perPage),
            $selectedJobsQuery->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $technicianCounts = job_request::select('technician_id', \DB::raw('COUNT(*) as count'))
        ->whereIn('job_status', ['Pending', 'On-going', 'Assigned'])
        ->groupBy('technician_id')
        ->pluck('count', 'technician_id')
        ->all();

        $jobsPaginated = job_request::with('techList')->get();
        $statusCounts = $jobsPaginated->groupBy('job_status')->map->count();

      
        return view('admin.addjobreq', ['section'=>'admin','user' => $user,'jobs'=>$jobs,'currActive'=>'jobReq','technicians' => $technicians, 'technicianCounts'=>$technicianCounts,'jobsPaginated'=>$jobsPaginated, 'statusCounts'=>$statusCounts,  'selected'=>$selectedVal,'areaSelected'=>$selectedValArea,'generatedJobsCount'=>$generatedJobsCount,'customers'=>$customers ]);
    }
    
    // public function jobReqSorted(Request $request) {
    //         $selectedJobsQuery = job_request::with('techList')
    //             ->where('job_status', $request->statusSelected)
    //             ->orderBy('created_at', 'desc')
    //             ->get();
        
    //         $technicians = technician_list::all();
        
    //         if(Session::has('loginId')){
    //             $user = admin_list::where('id', Session::get('loginId'))->first();
    //         }
        
    //         $selectedVal = $request->statusSelected;
        
    //         $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        
    //         $currentPage = LengthAwarePaginator::resolveCurrentPage();
    //         $perPage = 10;
    //         $jobs = new LengthAwarePaginator(
    //             $selectedJobsQuery->forPage($currentPage, $perPage),
    //             $selectedJobsQuery->count(),
    //             $perPage,
    //             $currentPage,
    //             ['path' => LengthAwarePaginator::resolveCurrentPath()]
    //         );
        
    //         $technicianCounts = $selectedJobsQuery->select('technician_id', \DB::raw('COUNT(*) as count'))
    //             ->whereIn('job_status', ['Pending', 'On-going', 'Assigned'])
    //             ->groupBy('technician_id')
    //             ->pluck('count', 'technician_id')
    //             ->all();
        
    //         $statusCounts = $selectedJobsQuery->groupBy('job_status')->map->count();
        
    //         return view('admin.addjobreq', [
    //             'section' => 'admin',
    //             'user' => $user,
    //             'jobs' => $jobs,
    //             'currActive' => 'jobReq',
    //             'technicians' => $technicians,
    //             'technicianCounts' => $technicianCounts,
    //             'jobsPaginated' => $selectedJobsQuery,
    //             'statusCounts' => $statusCounts,
    //             'selected' => $selectedVal,
    //             'generatedJobsCount' => $generatedJobsCount
    //         ]);
    //     }


}
