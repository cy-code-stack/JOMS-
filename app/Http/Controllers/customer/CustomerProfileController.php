<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customers_list;
use App\Models\job_request;
use Session;
use Illuminate\Support\Facades\Hash;

class CustomerProfileController extends Controller
{

    public function profileView(){
        if(Session::has('loginId')){
            $user = customers_list::where('id',Session::get('loginId'))->first();
        }    
        $generatedJobsCount = job_request::where('generated', 'true')
          ->where('customer_id', $user->id) // Assuming 'customer_id' is the column linking jobs to customers
          ->count();
        $style = (object)[
            'nav'=>'margin:0'
        ];
        
         
          $quotationGenerated = job_request::where('generated', 'true')->where('customer_id', $user->id)->count();
        
        $forVerificationJob = job_request::where('job_status', 'Verification')->where('customer_id', $user->id)->count();
     

        return view('customer.profile',['section'=>'customer','currActive'=>'profile','navigation'=>'customer', 'user' => $user,'style'=>$style,'quotationGenerated' => $quotationGenerated,
        'forVerificationJob' => $forVerificationJob]);
    }

    public function profileEdit(Request $request, $id){
        $user = customers_list::find($id);

        if($request->reqType == "profileInfo"){
            $user->first_name =  $request->firstname;
            $user->last_name  = $request->lastname;
            $user->fullAdress  = $request->address;
            $user->email = $request->email;
            $user->profileImage = $request->profImage;
            $user->facebook_link = $request->fblink;
        }else{
            
            if(Hash::check($request->oldPassword, $user->password)){
                if($request->password == $request->passwordRetype){
                    $user->password = Hash::make($request->password);
                }else{
                    return back()->with('fail', 'Password not match ');
                }
            }else{
                 return back()->with('fail', 'Incorrect Old password');
            }
            
        }
        $result = $user->save();

       
        if($result){
            return back()->with('success', 'Edited Successfully');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
      
    }

    public function profileDelete($id){
        $user = customers_list::find($id);
        $remove = $user->delete();

        if(Session::has('loginId')){
            Session::pull('loginId');
        }
    

        if($remove){
            return back()->with('success', 'Profile was Removed Successfully');
        }else{
            return back()->with('fail', 'Fail to Deactivate');
        }
    }

}
