<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function check_account_type(){
        if(Auth::user()->role == 0){
            return redirect('super-admin/dashboard');
        }

        if(Auth::user()->role == 1){
            return redirect('property-owner/dashboard');
        }

        if(Auth::user()->role == 2){
            return redirect('flat-owner/dashboard');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
