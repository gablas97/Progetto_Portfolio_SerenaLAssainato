<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Insight;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_login(){
        return view('admin.login');
    }

    public function index()
    {
        $works = Work::latest()->get();
        $insights = Insight::latest()->get();
        
        return view('admin.dashboard', compact('works', 'insights'));
    }
}
