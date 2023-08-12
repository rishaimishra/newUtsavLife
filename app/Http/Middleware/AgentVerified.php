<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AgentVerified
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
        if(@Auth::user()->role_id == 4){
               if (@Auth::user()->status == 'U' ||  @Auth::user()->status == 'I' ) 
                {
                    return redirect()->route('agent.dashboard')->with('error','Unless Admin Approved you, you can not access anything.');
                }
                else
                {
                    return $next($request);
                }
        }elseif(@Auth::user()->role_id == 2){
             return $next($request);

        }
    }
}
