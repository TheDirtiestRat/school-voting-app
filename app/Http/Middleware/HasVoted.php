<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class HasVoted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $session_usn = session('session_usn');
        $is_voted = DB::select('select * from voters where isVoted = ? and USN = ?', ['voted', $session_usn]);
        // $is_voted = DB::select('select * from voters')->where('USN', $session_usn);

        // dd($is_voted);
        // dd(session('voters_name'));

        if($is_voted) {
            return redirect('/Thankyou');
        }

        return $next($request);
    }
}
