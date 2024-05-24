<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\job_request;
use Illuminate\Support\Str;
use App\Models\customers_list;
use Carbon\Carbon;
use Session;

class CustomerDashboardController extends Controller
{
      
    public function dashboardView(){
        $jobs = job_request::with('customer')->get();
        if(Session::has('loginId')){
            $user = customers_list::where('id',Session::get('loginId'))->first();
        }
          // Count the number of jobs where the 'generated' column is 'true'
        $quotationGenerated = job_request::where('generated', 'true')->where('customer_id', $user->id)->count();
        
        $forVerificationJob = job_request::where('job_status', 'Verification')->where('customer_id', $user->id)->count();
     
        $style = (object)[
            'nav'=>'margin:0'
        ];
        
        return view('customer.dashboard', [
            'section'=>'customer',
            'currActive'=>'dashboard' ,
            'navigation'=>'customer', 
            'user' => $user,
            "jobs"=>$jobs,
            'quotationGenerated' => $quotationGenerated,
            'forVerificationJob' => $forVerificationJob,
            'style'=>    $style,
        
        ]);
    }

    public function dashboardAdd(Request $request)
{
    $validated = $request->validate([
        'jobType' => 'required',
    ]);

    $job = new job_request;
    $job->customer_id = $request->customerID;

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

   // Handle multiple file uploads
    $images = $request->file('issueimage');
    $imageNames = [];

   // Check if any images were uploaded
if ($images && is_array($images)) {
    // Loop through each uploaded file
    foreach ($images as $image) {
        // Generate a unique filename for each image
        $imageName = time() . '_' . $image->getClientOriginalName();

        // Move the image to the desired location
        $image->move(public_path('img'), $imageName);

        // Save the image name to the array
        $imageNames[] = $imageName;
    }
}

// If no images were uploaded or the array is empty, use the default image
if (empty($imageNames)) {
    $imageNames[] = 'logo-filled.jpg'; // Change this to your default image filename
}
    // Serialize the array of image names before storing in the database
    $job->issue_image = serialize($imageNames);
        date_default_timezone_set("Asia/Singapore");

    $job->address = $request->customerAddress;
    $job->job_status = 'Pending';
    $job->remarks = 'none';
    $job->created_at = date('Y-m-d h:i:s');

    $result = $job->save();

    if ($result) {
        return back()->withInput()->with('success', 'You have successfully submitted your request. Your request will be approved soon');
    } else {
        return back()->withInput()->with('fail', 'Job Request Failed to submit');
    }
}

}