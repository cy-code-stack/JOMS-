<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin_list;
use Illuminate\Http\Request;
use App\Models\customers_list;
use Session;
use App\Models\job_request;
use App\Models\accomplishment_report;
use PDF;
use Carbon\Carbon;
class AdminReportsController extends Controller
{
    public function reportsView(){
        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        
       
        $jobs = accomplishment_report::with('jobReq.techList','jobReq.customer')->orderByDesc('created_at')->get();
        
        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        return view('admin.reports',['section'=>'admin','navigation'=>'admin','currActive'=>'reports', 'user' => $user, 'style','generatedJobsCount'=>$generatedJobsCount,'jobs'=>$jobs]);
    }
    
    
    public function reportSort(Request $request){
        
        $month = $request->monthSelected;
         if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        
       
        $jobsQuery = accomplishment_report::with('jobReq.techList')->orderByDesc('created_at');
    
        if (!empty($month) and !($month == 'All')) {
            $jobsQuery->whereMonth('created_at', Carbon::parse($month)->month); 
        }
    
        $jobs = $jobsQuery->get();
        
        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        return view('admin.reports',[
            'section'=>'admin',
            'navigation'=>'admin',
            'currActive'=>'reports', 
            'user' => $user, 'style',
            'generatedJobsCount'=>$generatedJobsCount,
            'jobs'=>$jobs,
            'selected' => $month,
            ],);
    }

   
    
     public function reportEdit(Request $request,$id){
        $accomplishement = accomplishment_report::find($id);
 
        //dd($request->coordinate);
        
        $accomplishement->coordinate = $request->coordinate;
        $accomplishement->complaintsDescription = $request->complaintsDescription;
      

    
        $result = $accomplishement->save();

        if($result){
            return back()->with('success', 'Success');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
    }
    
        public function generatePDF(Request $request){   
        
            $jobs = accomplishment_report::with('jobReq')->orderByDesc('created_at')->get();
        
          $data = [
            'title' => "Accomplishment Report",
            'details' => $jobs
            ];
            
        $pdf = PDF::loadView('admin.Reports.transaction', $data);
        $filename = 'my_' . time() . '.pdf';
        
    

        $pdfPath = storage_path("app/public/pdfs/{$filename}");
    
        // Save the PDF to the pdfs directory for safekeeping
        $pdf->save($pdfPath);
        

       return back()->with('filename', $filename)->with('success', 'PDF Generated Successfully')->with('pdfSuccess', '');
        
    }
    
    public function downloadPDF($filename)
        {
        $filePath = storage_path("app/public/pdfs/{$filename}");
        
        return response()->file($filePath, ['Content-Type' => 'application/pdf']);
        }  

   


}
