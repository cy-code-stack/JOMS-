<?php

namespace App\Http\Controllers\technician;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\technician_list;
use Session;
use App\Models\job_request;
use Illuminate\Support\Facades\Hash;

class TechnicianProfileController extends Controller
{
    public function profileView(){

        if(Session::has('loginId')){
            $user = technician_list::where('id',Session::get('loginId'))->first();
        }
 $generatedJobsCount = job_request::where('job_status', 'Assigned')->where('technician_id', $user->id)->count();
      
        $style = (object)[
            'nav'=>'margin:0'
        ];
    
        return view('technician.profile',['section'=>'technician','currActive'=>'profile','navigation'=>'technician', 'user' => $user, 'style'=>$style,'generatedJobsCount' => $generatedJobsCount]);
    }

    public function profileEdit(Request $request, $id){
        $user = technician_list::find($id);

        if($request->reqType == "profileInfo"){
            $user->first_name =  $request->firstname;
            $user->last_name  = $request->lastname;

            $user->email = $request->email;
            $user->profileImage = $request->profImage;
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
            return back()->with('success', 'Change Successfully');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
      
    }

    public function profileDelete($id){
        $user = technician_list::find($id);
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
