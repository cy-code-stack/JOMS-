<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingView extends Controller
{
    public function userOption(){
        return view('landing.useroption', ['currActive'=>'login','section' => 'user-option','navigation'=>'useroption','noBurger'=> true]);
    }  
}
