<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\technician_list;
use Illuminate\Support\Str;
use Carbon\Carbon;  
use App\Models\admin_list;
use Session;
use App\Models\job_request;
use Illuminate\Support\Facades\Hash;
class AdminTechnicianController extends Controller
{
    public function technicianlistView(){
        
        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }

        $technician = technician_list::paginate(10);      
        $password = Str::random(8);
        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        return view('admin.technicianlist',['section'=>'admin','currActive'=>'techList','password'=>$password, 'technicians'=> $technician ,'user' => $user,'generatedJobsCount'=>$generatedJobsCount]);
    }

    public function technicianAdd(Request $request){

        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'email' => 'required|email',     
        ]);
        
        $technician = technician_list::where('email',$request->email)->first();

        if($technician){       
            return back()->withInput()->with('fail', 'Email already exist')-with('showmodal');// Password is correct              
     
        }else{
            $technician = new technician_list;
            $technician->first_name = $request->firstname;
            $technician->last_name = $request->lastname;
            $technician->email = $request->email;
            $technician->area = $request->area;
            $technician->password = Hash::make($request->password);
            $technician->created_at = Carbon::now();
            $technician->save();
            return back()->withInput()->with('success', 'Added successfully');// Password is correct              
       
  
        }   

        return response()->json($response );
    }


     
    public function technicianEdit(Request $request, $id){
        $technician = technician_list::find($id);
  
        $technician->first_name =  $request->firstname;
        $technician->last_name=  $request->lastname;
        $technician->email=  $request->email;  
        $technician->area = $request->area;
        $technician->password=  Hash::make($request->password);
        $result = $technician->save();
      
        if($result){
            return back()->with('success', 'Edited Successfully');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
      
    }

    public function technicianDelete($id){
        $technician = technician_list::find($id);

        $remove = $technician->delete();

        if($remove){
            return back()->with('success', 'User Removed Successfully');
        }else{
            return back()->with('fail', 'Fail to Remove');
        }
    }
}
