<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::active()
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('home.home_index', compact('projects'));
    }
}
