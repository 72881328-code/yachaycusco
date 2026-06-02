<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function create()
    {
        if (!Auth::user()->isTeacher()) {
            abort(403);
        }
        return view('resources.create');
    }
    
    public function store(Request $request)
    {
        if (!Auth::user()->isTeacher()) {
            abort(403);
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'subject' => 'required|in:Matematica,Comunicacion,Ciencia,Quechua,Historia',
            'level' => 'required|in:Primaria,Secundaria',
            'lang' => 'required|in:Castellano,Quechua,Bilingue',
            'type' => 'required|in:pdf,video,audio',
        ]);
        
        $validated['author_id'] = Auth::id();
        $validated['status'] = 'pending';
        
        Resource::create($validated);
        
        return redirect()->route('dashboard')->with('success', 'Recurso creado. Espera moderación.');
    }
    
    public function edit($id)
    {
        if (!Auth::user()->isTeacher()) {
            abort(403);
        }
        
        $resource = Resource::findOrFail($id);
        if ($resource->author_id !== Auth::id()) {
            abort(403);
        }
        return view('resources.edit', compact('resource'));
    }
    
    public function update(Request $request, $id)
    {
        if (!Auth::user()->isTeacher()) {
            abort(403);
        }
        
        $resource = Resource::findOrFail($id);
        if ($resource->author_id !== Auth::id()) {
            abort(403);
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'subject' => 'required|in:Matematica,Comunicacion,Ciencia,Quechua,Historia',
            'level' => 'required|in:Primaria,Secundaria',
            'lang' => 'required|in:Castellano,Quechua,Bilingue',
            'type' => 'required|in:pdf,video,audio',
        ]);
        
        $resource->update($validated);
        
        return redirect()->route('dashboard')->with('success', 'Recurso actualizado');
    }
    
    public function destroy($id)
    {
        if (!Auth::user()->isTeacher()) {
            abort(403);
        }
        
        $resource = Resource::findOrFail($id);
        if ($resource->author_id !== Auth::id()) {
            abort(403);
        }
        
        $resource->delete();
        
        return redirect()->route('dashboard')->with('success', 'Recurso eliminado');
    }
}