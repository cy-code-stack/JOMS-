<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin_list;
use Illuminate\Http\Request;
use Session;
use App\Models\job_request;
use App\Models\accomplishment_report;
use PDF;

class AdminCustReportController extends Controller
{
    public function custReportView(){
        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        
        $jobs = accomplishment_report::with('jobReq')->orderByDesc('created_at')->get();
   
    
        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        return view('admin.custReport',['section'=>'admin','navigation'=>'admin','currActive'=>'cusrReport', 'user' => $user, 'style','generatedJobsCount'=>$generatedJobsCount,'jobs'=>$jobs]);
    }

   
    
    //  public function reportEdit(Request $request,$id){
    //     $accomplishement = accomplishment_report::find($id);
 
    //     //dd($request->coordinate);
        
    //     $accomplishement->coordinate = $request->coordinate;
    //     $accomplishement->complaintsDescription = $request->complaintsDescription;
      

    
    //     $result = $accomplishement->save();

    //     if($result){
    //         return back()->with('success', 'Success');
    //      }else{
    //         return back()->withInput()->with('fail', 'Failed to process');       
    //     }
    // }
    
    //     public function generatePDF(Request $request){   
        
    //         $jobs = accomplishment_report::with('jobReq')->orderByDesc('created_at')->get();
        
    //       $data = [
    //         'title' => $jobs,
    //         'details' => $jobs
    //         ];
            
    //     $pdf = PDF::loadView('admin.Reports.transaction', $data);
    //     $filename = 'my_' . time() . '.pdf';
        
    
        
        

    //     return $pdf->stream('my.pdf');
        
    // }

   


}
