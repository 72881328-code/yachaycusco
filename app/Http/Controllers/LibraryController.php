<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $resources = Resource::approved()
            ->level($request->level)
            ->subject($request->subject)
            ->when($request->type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->orderByDesc('downloads')
            ->paginate(12);
        
        return view('library.index', compact('resources'));
    }
    
    public function show($id)
    {
        $resource = Resource::approved()->findOrFail($id);
        $resource->incrementViews();
        
        $suggestions = Resource::approved()
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        $isSaved = false;
        if (Auth::check()) {
            $isSaved = Auth::user()->savedResources()->where('resource_id', $id)->exists();
        }
        
        return view('library.show', compact('resource', 'suggestions', 'isSaved'));
    }
    
    public function save($id)
    {
        $resource = Resource::findOrFail($id);
        Auth::user()->savedResources()->toggle($resource);
        
        return back()->with('success', 'Recurso actualizado en tu lista');
    }
    
    public function download($id)
    {
        $resource = Resource::findOrFail($id);
        $resource->incrementDownloads();
        
        return response()->json(['success' => true]);
    }
}