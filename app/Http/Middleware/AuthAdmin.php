<?php

namespace App\Http\Middleware;
use App\Http\Controller\AdminController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->user_type === 'ADM'){
            return view('admin.index');
            }else{
                Session::flush();
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login');
        }
        
    }
}
