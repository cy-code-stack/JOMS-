<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_list;
use Session;
use App\Models\job_request;

class AdminProfileController extends Controller
{
   
    public function profileView(){

        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }

        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        return view('admin.profile',['section'=>'admin','navigation'=>'admin','currActive'=>'profile', 'user' => $user, 'style','generatedJobsCount'=>$generatedJobsCount]);
    }

    public function profileEdit(Request $request, $id){
        $user = admin_list::find($id);

        if($request->reqType == "profileInfo"){
            $user->first_name =  $request->firstname;
            $user->last_name  = $request->lastname;
            $user->email = $request->email;
            $user->profileImage = $request->profImage;
        }else{
            if($request->password == $request->passwordRetype){
                $user->password = $request->password;
            }else{
                return back()->with('fail', 'Password not match ');
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
        $user = admin_list::find($id);
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
