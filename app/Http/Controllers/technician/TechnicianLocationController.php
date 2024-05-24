<?php

namespace App\Http\Controllers\technician;;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\technician_list;
use App\Models\job_request;
use Session;


class TechnicianLocationController extends Controller
{
    public function locationView(){

        if(Session::has('loginId')){
            $user = technician_list::where('id',Session::get('loginId'))->first();
        }

        $style = (object)[
            'nav'=>'margin:0'
        ];

        $generatedJobsCount = job_request::where('job_status', 'Assigned')->where('technician_id', $user->id)->count();
        
        $jobs = job_request::with('techList')->where('technician_id', Session::get('loginId'))->with('customer')->orderByDesc('created_at')->paginate(10);
       
    

        return view('technician.techlocation',
        [
            'section'=>'technician',
            'currActive'=>'location',
            'navigation'=>'technician', 
            'user' => $user, 
            'style'=>$style,
            'jobs'=>$jobs,
            'lat' => 0,
            'lng' => 0,
            'name' => '',
            'status' => '',
            'address' => '',
            'generatedJobsCount' => $generatedJobsCount
        ]);
    }


    public function locationRedicrect($lat, $lng,$name,$status,$address)
    {
        $jobs = job_request::with('techList')->where('technician_id', Session::get('loginId'))->with('customer')->orderByDesc('created_at')->paginate(10);
       
        if(Session::has('loginId')){
            $user = technician_list::where('id',Session::get('loginId'))->first();
        }

        $style = (object)[
            'nav'=>'margin:0'
        ];
        
        $generatedJobsCount = job_request::where('job_status', 'Assigned')->where('technician_id', $user->id)->count();
        
        return view('technician.techlocation',
        [
            'section'=>'technician',
            'currActive'=>'location',
            'navigation'=>'technician', 
            'user' => $user, 
            'style'=>$style,
            'jobs'=>$jobs,
            'lat' => $lat,
            'lng' => $lng,
            'name' => $name,
            'status' => $status,
            'address' => $address,
             'generatedJobsCount' => $generatedJobsCount
        ]);
    }

}