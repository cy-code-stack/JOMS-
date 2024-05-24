<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::has('loginId') && (url('/user-option')==$request->url() || url('/login/{usertype}')==$request->url() )){   
            if(Session::get('userType') == 'admin'){
                return redirect('admin/dashboard');
            }elseif(Session::get('userType') == 'tech'){
                 return redirect('technician/techTask ');
            }elseif(Session::get('userType') == 'customer'){
                return redirect('customer/dashboard');
            };
        }
        return $next($request);
    }
}
