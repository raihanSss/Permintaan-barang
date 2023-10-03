<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class LoginController extends Controller
{
    public function index()
{
    if (Auth::check()) {
        return redirect()->intended('home');
    }

    return view('login.index');
}

    public function proses(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credential = $request->only('username','password');

        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            $authuser = Auth::user();
            if($authuser){
                return redirect()->intended('home');
            }
                return redirect()->intended('/');
           
        }

        return back()->withErrors([
            'username' => 'username atau password salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/login');
    }

}
