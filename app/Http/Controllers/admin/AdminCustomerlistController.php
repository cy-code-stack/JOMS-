<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customers_list;
use App\Models\admin_list;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Mail;
use App\Mail\Myemail;
use App\Models\job_request;
use PDF;
use Illuminate\Support\Facades\Hash;

class AdminCustomerlistController extends Controller
{
    public function customerlistView(){

        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        $customers = customers_list::paginate(10);

        $id = customers_list::max('id') + 1;
        $newAccountID = sprintf('%03d-%03d', floor($id / 1000), $id % 1000);
        $password = Str::random(8);

        return view('admin.customerlist',
        ['section'=>'admin', 
        'id'=>$newAccountID ,
        'currActive'=>'custList', 
        'password'=>$password, 
        'customers'=>$customers,
        'user'=>$user,  
           'lat' => 0,
            'lng' => 0,
            'name' => '',
             'name' => '',
            'status' => '',
            'address' => '',
        'generatedJobsCount'=>$generatedJobsCount]);
    }

    
    public function customerEdit(Request $request, $id){
        $customer = customers_list::find($id);


        $customer->first_name =  $request->firstname;
        $customer->last_name=  $request->lastname;
        $customer->email=  $request->email;
        $customer->fullAdress=  $request->address;
        $customer->mobile_number=  $request->mobile;
        $customer->customerType=  $request->custType; 
        // $customer->password=  $request->password;
        $result = $customer->save();
      
        if($result){
            return back()->with('success', 'Edited Successfully');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
      
    }
    
    
       public function editLocation(Request $request){
        $customer = customers_list::find($request->userID);
        
        var_dump($request->fulladdress);
        $customer->fullAdress = $request->fulladdress;
        $customer->lat = $request->lat; 
        $customer->lng= $request->lng; 
        $result = $customer->save();
      
        if($result){
            return back()->with('success', 'Edited Successfully');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }
      
    }
    
    


    public function verifyCustomer($id){
      $customer = customers_list::find($id);
       $mailData = [
         'Title' => 'Account Verified',
         'id' => $customer->account_id ,
         'body' => ' Your account has been verified, please access the link bellow to login',
         'loginLink' => 'https://myctech.online/login/customer'
       ];

       $result = Mail::to($customer->email)->send(new Myemail($mailData));

      
        if($result){
           
            $customer->verification= 'Verified'; 
            $result = $customer->save();
            return back()->with('success', 'Verified Successfully');
         }else{
            return back()->withInput()->with('fail', 'Failed to process');       
        }

    

    }
    
    public function customerSearch(Request $request){
    
          // Query to find similar names based on the searched term
        // $customers = customers_list::paginate(10);  // Change 10 to the number of items per page you want
      $customers = customers_list::where('first_name', 'LIKE',  $request->searched .'%')
    ->orWhere('last_name', 'LIKE',  $request->searched .'%')->paginate(10); // Change 10 to the number of items per page you want

        return response()->json([ 'customers'=>$customers]);
    }

    public function customerDelete($id){
        $users = customers_list::find($id);

        $remove = $users->delete();

        if($remove){
            return back()->with('success', 'User Removed Successfully');
        }else{
            return back()->with('fail', 'Fail to Remove');
        }
    }
    
      public function customerAdd(Request $request){

        $validated = $request->validate([
            'firstname' => 'required',
           
      
            'password' => 'required',
        ]);

        $id = customers_list::max('id') + 1;
        $newAccountID = sprintf('%03d-%03d', floor($id / 1000), $id % 1000);
    
       
        if(($request->email == '')  Or ($request->email == 'N/A')){
            $customer = new customers_list;
            $customer->first_name = $request->firstname;
            $customer->last_name = $request->lastname;
            $customer->email = $request->email;
            $customer->fullAdress = $request->fullAddress;
            $customer->password = Hash::make($request->password);
            $customer->mobile_number= $request->mobile;  
            $customer->lat = $request->lat; 
            $customer->lng= $request->lng; 
            $customer->adminCreated= 'Yes'; 
            $customer->customerType=  $request->custType; 
            $customer->verification= 'Verified'; 
            $customer->created_at = Carbon::now();
            $customer->account_id = $newAccountID;
            
            $customer->save();
            return back()->withInput()->with('success', 'Customer Added successfully');// Password is correct              
       
        }
        
         $user = customers_list::where('email',$request->email)->first();
    
        
        if($user){       
            return back()->withInput()->with('fail', 'Email already exist')->with('showmodal');// Password is correct              
        }else{
            $customer = new customers_list;
            $customer->first_name = $request->firstname;
            $customer->last_name = $request->lastname;
            $customer->email = $request->email;
            $customer->fullAdress = $request->fullAddress;
            $customer->password = Hash::make($request->password);
            $customer->mobile_number= $request->mobile;  
            $customer->lat = $request->lat; 
            $customer->lng= $request->lng; 
            $customer->adminCreated= 'Yes'; 
            $customer->customerType=  $request->custType; 
            $customer->verification= 'Verified'; 
            $customer->created_at = Carbon::now();
            $customer->account_id = $newAccountID;
            
            $customer->save();
            return back()->withInput()->with('success', 'Customer Added successfully');// Password is correct              
       
        }   

    }
    
       public function generatePDF(Request $request){   
       
         $customer = customers_list::get();
       
          $data = [
            'title' => $customer,
            'details' => $customer
            ];
            
        $pdf = PDF::loadView('admin.Reports.customerInfo', $data);
        $filename = 'my_' . time() . '.pdf';
        
    

        $pdfPath = storage_path("app/public/pdfs/{$filename}");
       
        $pdf->save($pdfPath);
        

        return back()->with('filename', $filename)->with('success', 'PDF Generated Successfully')->with('pdfSuccess', '');
        
    }
    
    public function downloadPDF($filename)
        {
        $filePath = storage_path("app/public/pdfs/{$filename}");
        
        return response()->file($filePath, ['Content-Type' => 'application/pdf']);
        }  

   
}
