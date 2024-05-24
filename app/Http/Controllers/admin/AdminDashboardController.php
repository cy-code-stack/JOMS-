<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_list;
use App\Models\job_request;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;



class AdminDashboardController extends Controller
{

    public function dashboardView(){
        $jobs = job_request::with('techList')->orderByDesc('created_at')->paginate(10);
        $jobsPaginated = job_request::with('techList')->get();
        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        
         // Count the number of jobs where the 'generated' column is 'true'
         $generatedJobsCount = job_request::where('job_status', 'pending')->count();

        $statusCounts = $jobsPaginated->groupBy('job_status')->map->count();
        $selectedVal = 'null';
       
        return view('admin.dashboard', [
            'section'=>'admin',
            'user' => $user,
            'currActive'=>'dashboard',
            'jobs'=>$jobs,
            'jobsPaginated'=>$jobsPaginated, 'statusCounts'=>$statusCounts, 'selected'=>$selectedVal,
            'generatedJobsCount' => $generatedJobsCount
            ]);
    }

    public function dashboardSorted(Request $request){
        $selectedJobsQuery = job_request::with('techList')->where('job_status', $request->statusSelected)->orderBy('job_status')->orderByDesc('created_at')->get();
        $otherJobsQuery = job_request::with('techList')->where('job_status', '!=', $request->statusSelected)->orderBy('job_status')->orderByDesc('created_at')->get();
    
        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        
        $generatedJobsCount = job_request::where('job_status', 'pending')->count();

        $selectedVal =  $request->statusSelected;
        $mergedJobs = $selectedJobsQuery->concat($otherJobsQuery);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $jobs = new LengthAwarePaginator(
            $selectedJobsQuery->forPage($currentPage, $perPage),
            $selectedJobsQuery->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $jobsPaginated = job_request::with('techList')->orderByDesc('created_at')->get();
        $statusCounts = $jobsPaginated->groupBy('job_status')->map->count();

      
        return view('admin.dashboard', ['section'=>'admin','user' => $user,'jobs'=>$jobs,'currActive'=>'dashboard','jobsPaginated'=>$jobsPaginated, 'statusCounts'=>$statusCounts,  'selected'=>$selectedVal,   'generatedJobsCount' => $generatedJobsCount]);
    }
    
}
