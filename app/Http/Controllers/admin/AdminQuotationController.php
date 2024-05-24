<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_list;
use Session;
use App\Models\job_request;
use PDF;

class AdminQuotationController extends Controller
{
    public function quotationView(){

        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }

        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        $jobs = job_request::with('techlist')->orderByDesc('created_at')->get();

        $jobs->each(function ($job) {
            $job->partsReplace = json_decode($job->partsReplace, true);
            $job->partsInplace = json_decode($job->partsInplace, true);
        });
        return view('admin.quotation',
        [
            'section'=>'admin',
            'navigation'=>'admin',
            'currActive'=>'quotation',
            'user' => $user, 
            'jobs' => $jobs,
            'generatedJobsCount'=>$generatedJobsCount
        ]);
    }
    
public function reportGenerate(Request $request, $id)
{
    $jobs = job_request::with('techList')->with('customer')->orderByDesc('created_at')->find($id);

    $jobs->each(function ($job) {
        $job->partsReplace = json_decode($job->partsReplace, true);
        $job->partsInplace = json_decode($job->partsInplace, true);
    });

    $data = [
        'title' => "Quotation",
        'details' => $jobs
    ];

    $pdf = PDF::loadView('technician.quotationReport', $data);
    $filename = 'my_' . time() . '.pdf';

    $job = job_request::find($id);
    $job->generated = "True";
    $job->save();

    // Save the PDF to a public directory
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