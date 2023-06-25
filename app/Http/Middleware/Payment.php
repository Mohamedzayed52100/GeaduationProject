<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Payment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('hasPayment')) {
            return $next($request);
        } else {
            return redirect('/PatientRequestLab')->with(['failRequest' => 'You have no appointment yet!']);
        }
    }
}
