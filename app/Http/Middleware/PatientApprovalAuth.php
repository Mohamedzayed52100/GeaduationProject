<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientApprovalAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('Approved')) {
            return redirect('/loginRelative')->with(['error' => 'You have no new follow-up requests !']);
           
        } else {
            return $next($request);
        }
        //patienthome بس هغيرها بعدين// المفروض توديه صفحه ال 
        //محتاجه افكر فيها تاني


    }
}
