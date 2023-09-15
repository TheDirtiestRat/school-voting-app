<?php

namespace App\Http\Controllers;

use App\Models\Voters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    // Admin authentication
    public function admin_login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('Admin/Dashboard');
            // return route('admin_dashboard');
        }

        return back()->with('error', "Failed to login. (username or password is incorrect)");
    }

    public function admin_logout()
    {
        Auth::logout();
        return redirect()->route('loginAdmin')->with("success", "User has logout.");
    }

    // User authentication
    public function voter_login(Request $request)
    {
        $request->validate([
            'usn' => ['required']
        ]);

        // if voters USN exist and is not voted yet then go to the pages
        $voter = DB::select('select * from Voters where USN = ?', [$request->usn]);

        if ($voter) {
            // set a session key for the voter
            $request->session()->put('session_usn', $request->usn);
            session()->put('voters_name', $voter[0]->name);
            session()->put('voters_program', $voter[0]->program);

            session()->put('voter', $voter[0]);
            
            // Session::put(['voters_name' => $voter[0]->name]);
            // Session::put(['voters_program' => $voter[0]->program]);

            return redirect('votingCandidates');
            // return redirect('votingCandidates')->with('voters_name', $voter[0]->name);
        }

        return back()->with('error', "Failed to login. (USN either does not exist or incorrect USN input)");
    }

    public function voter_out(Request $request)
    {
        $request->session()->flush();
        session()->forget('voters_name');

        return redirect()->route('loginUser')->with("success", "Voter has logout.");
    }
}
