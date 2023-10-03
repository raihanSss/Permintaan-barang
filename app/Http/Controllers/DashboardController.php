<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Suratpo;

class DashboardController extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $suratPOs = Suratpo::where('status', 'validated')->get();

        return view('layout.home', [
            'authuser' => $authuser,
            'suratPOs' => $suratPOs,
        ]);
    }

}
