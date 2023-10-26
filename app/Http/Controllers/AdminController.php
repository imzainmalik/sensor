<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Facades\Flare;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(){
      
        return view('superadmin.index');
    }
    
}
