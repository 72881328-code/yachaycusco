<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isTeacher()) {
            $myResources = Resource::where('author_id', $user->id)
                ->orderByDesc('created_at')
                ->paginate(10);
            $stats = [
                'total' => Resource::where('author_id', $user->id)->count(),
                'approved' => Resource::where('author_id', $user->id)->where('status', 'approved')->count(),
                'pending' => Resource::where('author_id', $user->id)->where('status', 'pending')->count(),
                'total_downloads' => Resource::where('author_id', $user->id)->sum('downloads'),
            ];
            return view('dashboard.teacher', compact('myResources', 'stats'));
        }
        
        // Estudiante
        $savedResources = $user->savedResources()
            ->orderByDesc('user_saved_resources.created_at')
            ->paginate(12);
        
        return view('dashboard.student', compact('savedResources'));
    }
}