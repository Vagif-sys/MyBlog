<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

       //1. get Route
       $routes= $request->route()->getName();

        //2. get permission for this auth person 
        $route_arr = auth()->user()->role->permissions->toArray();

        //3. compare route route name with user permissions
           foreach($route_arr as  $route){
               // 4.if route name  is one of the thoese permissions
               if($route['name'] === $routes){
                  
                // 5.access to the user
                  return $next($request);
               }    
           }
           //6. else about unautherized user
           abort(403,'Access Denied | Unauthorized');
        
    }
}
