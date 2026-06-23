<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);
        
        if ($validated['type'] === 'pdf' && !$request->hasFile('file')) {
            return back()->withErrors(['file' => 'El archivo PDF es obligatorio para recursos tipo PDF.'])->withInput();
        }

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('resources', 'public');
        }

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
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);
        
        if ($validated['type'] === 'pdf' && !$request->hasFile('file') && !$resource->file_path) {
            return back()->withErrors(['file' => 'El archivo PDF es obligatorio para recursos tipo PDF.'])->withInput();
        }

        if ($request->hasFile('file')) {
            if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                Storage::disk('public')->delete($resource->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('resources', 'public');
        }
        
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

        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }
        
        $resource->delete();
        
        return redirect()->route('dashboard')->with('success', 'Recurso eliminado');
    }
}