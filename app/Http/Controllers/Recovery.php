<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\customers_list;
use App\Models\admin_list;
use App\Models\technician_list;
use Carbon\Carbon;
use App\Mail\Myemail;
use Session;
use Mail;
use Illuminate\Support\Facades\Hash;

class Recovery extends Controller
{
    public function recover(){
        if(Session::has('loginId')){
            return redirect('/user-option');
        }
    
        return view("authentication.recovery",['currActive'=>'login',  'section' => 'user-option', 'navigation' => 'login','noBurger'=>true]);
    }
    
  
    public function recoverSubmit(Request $request){

        
        $user = customers_list::where('email',$request->email)->first();

        if($user){ 
            

           $mailData = [
             'Title' => 'Account Recovery',
             'id' => $user->account_id ,
             'body' => ' Your account has been reset, Your passwoword is Ctech123',
             'loginLink' => 'https://myctech.online/login/customer'
           ];
           $result = Mail::to($request->email)->send(new Myemail($mailData));
    
             
            $user->password = Hash::make('Ctech123');
            $result = $user->save();
            
            if($result){
                return back()->withInput()->with('success', 'Email has been sent');
            }else{
                return back()->withInput()->with('fail', 'Fail to reset password'); 
            }
           
        }else{
           return back()->withInput()->with('fail', 'Account Does not Exist');            
      
        }   

    }

}
