<?php

namespace App\Http\Controllers;

use App\Models\Resource;

class HomeController extends Controller
{
    public function index()
    {
        $totalResources = Resource::where('status', 'approved')->count();
        $totalDownloads = Resource::sum('downloads');
        $topResources = Resource::approved()->orderByDesc('downloads')->limit(6)->get();
        
        return view('home.index', compact('totalResources', 'totalDownloads', 'topResources'));
    }
}