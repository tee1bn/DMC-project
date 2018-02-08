<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    
    {
        $route = app('request')->route()->getAction();

        $route = class_basename($route['controller']);

        list($controller, $method) = explode('@', $route) ;

       
        $role= ''.$controller.'@'.$method;

       if(! Auth::user()->hasRole($role)){

        return redirect('/home');


       }


        return $next($request);
    }
}
