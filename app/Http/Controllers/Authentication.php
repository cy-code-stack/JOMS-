<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\customers_list;
use App\Models\admin_list;
use App\Models\technician_list;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;

class Authentication extends Controller
{
    public function login($usertype){
        if(Session::has('loginId')){
            return redirect('/user-option');
        }
    
        return view("authentication.login",['currActive'=>'login','usertype' => $usertype,  'section' => 'user-option', 'navigation' => 'login','noBurger'=>true]);
    }

    public function loginUser(Request $request){
         var_dump($request->usertype);
        if($request->usertype == 'customer'){

            $validated = $request->validate([
                'user_id' => 'required',
                // 'user_password' => 'required|min:5|max:255',
            ]);
    
            $user = customers_list::where('account_id',$request->user_id)->first();
    
            if($user){
                if($user->verification === 'Unverified'){
                    return back()->withInput()->with('fail', 'Account is not Verified');
                }

        
                if (!(Hash::check($request->user_password,$user->password,))) {
                    return back()->withInput()->with('fail', 'Password is incorrect');// Password is correct         
                }else{
                    $request->session()->put('loginId',$user->id);
                    $request->session()->put('userType','customer'); 
                    
                    
                    return redirect('customer/dashboard');        
                }
    
            }else{
               return back()->withInput()->with('fail', 'Account Id doesnt Exist');
            }           


        }else{
            $validated = $request->validate([           
                'user_email' => 'required|email',
               
            ]);
    
            $userAdmin = admin_list::where('email',$request->user_email)->first();
            $userTech = technician_list::where('email',$request->user_email)->first();

            if($userAdmin || $userTech){
               
                if($userAdmin){
                    if (!($userAdmin->password === $request->user_password)) {
                        return back()->withInput()->with('fail', 'Password is incorrect');// Password is correct         
                    }else{
                       $request->session()->put('loginId',$userAdmin->id);
                       $request->session()->put('userType','admin');   
                       return redirect('admin/dashboard');        
                    }
                }else{
                    if($userTech){
                        if (!(Hash::check($request->user_password,$userTech->password))) {
                            return back()->withInput()->with('fail', 'Password is incorrect');// Password is correct         
                        }else{
                           $request->session()->put('loginId',$userTech->id);  
                           $request->session()->put('userType','tech');  
                           $userTech->log_status = 'true';
                           $userTech->save();
                           return redirect('technician/techTask');        
                        }
                    }else{
                        return back()->withInput()->with('fail', 'Email doesnt Exist');
                    }  
                }
             
            }else{
                return back()->withInput()->with('fail', 'Email doesnt Exist');
            } 

        
        } 
    }

    public function register(){
        return view('authentication.registration' ,['currActive'=>'login','section' => 'register','navigation'=>'register','noBurger'=>true]);
    }

    public function logout(){
        if(Session::has('loginId')){
            if(Session::pull('userType') == 'tech'){
                $userTech = technician_list::find(Session::pull('loginId'));
                $userTech->log_status = 'false';
                $userTech->save();
            }
            Session::pull('loginId');
        }
        
       
        
        return redirect('user-option');
    }


    public function registerSubmit(Request $request){

        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
           'conPassword' => 'required',
           'fbLink'=> 'required',
            'email' => 'required|email',     
            'mobile' => 'required|numeric',
            'password' => 'required',
        ]);

        $id = customers_list::max('id') + 1;
        $newAccountID = sprintf('%03d-%03d', floor($id / 1000), $id % 1000);

        $user = customers_list::where('email',$request->email)->first();

        if($user){       
            return back()->withInput()->with('fail', 'Email already exist')->with('showmodal');// Password is correct              
        }elseif ($request->password != $request->conPassword) {
            return back()->withInput()->with('fail', 'Password does not match')->with('showmodal');
        }else{
            $customer = new customers_list;
            $customer->first_name = $request->firstname;
            $customer->last_name = $request->lastname;
            $customer->email = $request->email;
            // $customer->address = $request->address;
            $customer->customerType=  $request->custType;
            $customer->password = Hash::make($request->password);
            $customer->mobile_number= $request->mobile;  
            $customer->lat = 0;
            $customer->lng= 0;
            $customer->facebook_link = $request->fbLink; 
            $customer->verification= 'Unverified'; 
            $customer->created_at = Carbon::now();
            $customer->account_id = $newAccountID;
            
            $customer->save();
            return back()->withInput()->with('success', 'Check your email for confirmation');// Password is correct              
       
        }   

    }
}
