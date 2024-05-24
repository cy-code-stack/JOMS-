<?php

namespace App\Http\Controllers\customer;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customers_list;
use App\Models\job_request;
use Session;
use GuzzleHttp\Client;


class CustomerLocationController extends Controller
{
    public function locationView(){

        if(Session::has('loginId')){
            $user = customers_list::where('id',Session::get('loginId'))->first();
        }    
        $generatedJobsCount = job_request::where('generated', 'true')
          ->where('customer_id', $user->id) // Assuming 'customer_id' is the column linking jobs to customers
          ->count();
    
    
         $quotationGenerated = job_request::where('generated', 'true')->where('customer_id', $user->id)->count();
        
        $forVerificationJob = job_request::where('job_status', 'Verification')->where('customer_id', $user->id)->count();
     

        
        return view('customer.cuslocation',
        [
            'section'=>'customer',
            'currActive'=>'location',
            'navigation'=>'customer', 
            'user' => $user, 
                'quotationGenerated' => $quotationGenerated,
        'forVerificationJob' => $forVerificationJob
    
        ]);
    }

    public function locationEdit(Request $request, $id){
        $user = customers_list::find($id);

        
        $user->lat = $request->lat;
        $user->lng  = $request->lng;
        $user->fulladress  = $request->fulladdress;
        $user->country = $request->country_val;
        $user->region = $request->region_val;
    
        $result = $user->save();
     
        if($result){
            return back()->with('success', 'Edited Successfully');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
      
    }
    
    public function locationGetIP(Request $request){
      
        $userIp = $request->ip();
        $client = new Client();
        $response = $client->get("https://ipinfo.io/{$userIp}?token=acf619e02d9822");
        $data = json_decode($response->getBody());
        $location = explode(',',$data->loc);
        
         if(Session::has('loginId')){
            $user = customers_list::where('id',Session::get('loginId'))->first();
        }    
        $generatedJobsCount = job_request::where('generated', 'true')
          ->where('customer_id', $user->id) // Assuming 'customer_id' is the column linking jobs to customers
          ->count();
    
    
         $quotationGenerated = job_request::where('generated', 'true')->where('customer_id', $user->id)->count();
        
        $forVerificationJob = job_request::where('job_status', 'Verification')->where('customer_id', $user->id)->count();
     

        
        return view('customer.cuslocation',
        [
            'section'=>'customer',
            'currActive'=>'location',
            'navigation'=>'customer', 
            'user' => $user, 
                'quotationGenerated' => $quotationGenerated,
        'forVerificationJob' => $forVerificationJob,
        'location' => $location 
    
        ]);

    }

}