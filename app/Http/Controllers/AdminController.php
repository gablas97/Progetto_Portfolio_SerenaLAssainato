<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_login(){
        return view('admin.login');
    }

    public function index()
    {
        $projects = Project::latest()->get();
        $insights = Insight::latest()->get();
        
        return view('admin.dashboard', compact('projects', 'insights'));
    }
}
