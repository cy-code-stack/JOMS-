<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin_list;
use Session;
use App\Models\job_request;
use App\Models\customers_list;

class AdminLocationController extends Controller
{
    public function locationView(){

        if(Session::has('loginId')){
            $user = admin_list::where('id',Session::get('loginId'))->first();
        }
        
        
        $customers = customers_list::get();


        $generatedJobsCount = job_request::where('job_status', 'pending')->count();
        return view('admin.adminlocation',
        [
            'section'=>'admin',
            'navigation'=>'admin',
            'currActive'=>'location',
            'user' => $user, 
            'generatedJobsCount'=>$generatedJobsCount,
             'customers'=>$customers,
                'lat' => 0,
            'lng' => 0,
            'name' => '',
            'status' => '',
            'address' => '',
        ]);
    }

}