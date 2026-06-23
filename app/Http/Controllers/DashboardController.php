<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $topTeacher = Resource::selectRaw('author_id, count(*) as total')
            ->groupBy('author_id')
            ->orderByDesc('total')
            ->with('author')
            ->get()
            ->first();

        $topResource = Resource::approved()
            ->with('author')
            ->orderByDesc('views')
            ->first();

        $topTeachers = Resource::selectRaw('author_id, count(*) as total')
            ->groupBy('author_id')
            ->orderByDesc('total')
            ->with('author')
            ->limit(6)
            ->get();

        $topResourcesByDownloads = Resource::approved()
            ->with('author')
            ->orderByDesc('downloads')
            ->limit(6)
            ->get();

        $subjectChart = Resource::approved()
            ->selectRaw('subject, count(*) as total')
            ->groupBy('subject')
            ->get();

        $subjectLabels = $subjectChart->pluck('subject');
        $subjectCounts = $subjectChart->pluck('total');

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
            return view('dashboard.teacher', compact('myResources', 'stats', 'topTeacher', 'topResource', 'topTeachers', 'topResourcesByDownloads', 'subjectLabels', 'subjectCounts'));
        }
        
        // Estudiante
        $savedResources = $user->savedResources()
            ->orderByDesc('user_saved_resources.created_at')
            ->paginate(12);
        
        return view('dashboard.student', compact('savedResources', 'topTeacher', 'topResource'));
    }
}