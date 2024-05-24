<?php

namespace App\Http\Controllers\technician;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\technician_list;
use App\Models\job_request;
use PDF;

use Session;


class TechnicianDailyReports extends Controller
{
    public function reportView(){
        
         $style = (object)[
            'nav'=>'margin:0'
        ];

        if(Session::has('loginId')){
            $user = technician_list::where('id',Session::get('loginId'))->first();
        }

         $generatedJobsCount = job_request::where('job_status', 'Assigned')->where('technician_id', $user->id)->count();
     
        $jobs = job_request::with('techList')->where('technician_id', Session::get('loginId'))->with('customer')->orderByDesc('created_at')->paginate(10);
        $jobs->each(function ($job) {
            $job->partsReplace = json_decode($job->partsReplace, true);
            $job->partsInplace = json_decode($job->partsInplace, true);
        });
        

        return view('technician.techReports',
        [
            'section'=>'technician',
            'currActive'=>'reports',
            'navigation'=>'technician', 
            'user' => $user, 
            'jobs' => $jobs,
            'generatedJobsCount' => $generatedJobsCount,
            'style' => $style
        ]);
    }

    public function reportAdd(Request $request, $id){
        $job = job_request::find($id);

        // Get the new data from the request
        $replaceData = json_decode($request->input('replaceData'), true);
         $inplaceData = json_decode($request->input('inplaceData'), true);
    
        $job->partsReplace = $replaceData ;
        $job->partsInplace = $inplaceData ;
       $job->remarksAndAccomplishment = $request->accomplishmentRemarks ;
        $result = $job->save();
    
        if ($result) {
            return back()->with('success', 'Data Saved Successfully');
        } else {
            return back()->withInput()->with('fail', 'Failed to process');
        }
      
    }

    public function reportAddInplace(Request $request, $id){
        $job = job_request::find($id);

       
        // Get the new data from the request
        $newData = json_decode($request->input('arrayData'), true);
    
        // Append the new data to the existing array
 
        $job->partsInplace = $newData ;
     
        $result = $job->save();
    
        
    
        if ($result) {
            return back()->with('success', 'Data Saved Successfully');
        } else {
            return back()->withInput()->with('fail', 'Failed to process');
        }   
     
    }

    public function reportAddRemarks(Request $request, $id){
        $job = job_request::find($id);

       
   
        $job->remarksAndAccomplishment = $request->accomplishmentRemarks ;
     
        $result = $job->save();

        if ($result) {
            return back()->with('success', 'Data Saved Successfully');
        } else {
            return back()->withInput()->with('fail', 'Failed to process');
        }   
      
    
    }


    public function reportGenerate(Request $request, $id)
    {
      
        
        $jobs = job_request::with('techList')->where('technician_id', Session::get('loginId'))->with('customer')->orderByDesc('created_at')->find($id);;
        
        $jobs->each(function ($job) {
            
         
            $job->partsReplace = json_decode($job->partsReplace, true);
            $job->partsInplace = json_decode($job->partsInplace, true);
            
        });
        
        if($jobs->partsInplace == null){
                return back()->with('fail', 'Please Input value on Inplace');
        };
            
        if($jobs->partsReplace == null){
                return back()->with('fail', 'Please Input value on Replace');
        };
             
        
          $data = [
            'title' => 'Quotation',
            'details' => $jobs
            ];
        

        $pdf = PDF::loadView('technician.quotationReport', $data);
        $filename = 'my_' . time() . '.pdf';
        $pdfPath = storage_path("app/public/pdfs/{$filename}");
    
        // Save the PDF to the pdfs directory for safekeeping
        $pdf->save($pdfPath);
        
       
        if(!($request->status == 'Approved')){
            $job = job_request::find($id);
            $job->generated = "True";     
            $job->save();
            
            return back()->with('filename', $filename)->with('success', 'PDF Generated Successfully,The customer now has been Notified')->with('pdfSuccess', '');
        }
       

        return back()->with('filename', $filename)->with('success', 'PDF Generated Successfully')->with('pdfSuccess', '');
    
    }

    public function downloadPDF($filename)
{
    $filePath = storage_path("app/public/pdfs/{$filename}");

    return response()->file($filePath, ['Content-Type' => 'application/pdf']);
}
}