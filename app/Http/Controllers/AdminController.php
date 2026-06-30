<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Crear una nueva instancia del controlador
     */
    public function __construct()
    {
        // Middleware aplicado en rutas, solo verificar admin aquí
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                abort(403, 'Acceso denegado. Solo administradores.');
            }
            return $next($request);
        });
    }

    /**
     * Mostrar dashboard del admin con recursos pendientes
     */
    public function dashboard()
    {
        $pendingResources = Resource::where('status', 'pending')
            ->with('author')
            ->orderByDesc('created_at')
            ->paginate(15);

        // Estadísticas básicas
        $stats = [
            'total_pending' => Resource::where('status', 'pending')->count(),
            'total_approved' => Resource::where('status', 'approved')->count(),
            'total_rejected' => Resource::where('status', 'rejected')->count(),
            'total_resources' => Resource::count(),
            'total_users' => User::count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_students' => User::where('role', 'student')->count(),
        ];

        // Datos para gráfica de recursos por materia
        $resourcesBySubject = Resource::select('subject')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('subject')
            ->get()
            ->pluck('count', 'subject');

        // Datos para gráfica de estado de recursos
        $statusDistribution = [
            'Pendiente' => Resource::where('status', 'pending')->count(),
            'Aprobado' => Resource::where('status', 'approved')->count(),
            'Rechazado' => Resource::where('status', 'rejected')->count(),
        ];

        // Datos para gráfica de recursos por tipo
        $resourcesByType = Resource::select('type')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('type')
            ->get()
            ->pluck('count', 'type');

        // Recursos recientes
        $recentApproved = Resource::where('status', 'approved')
            ->orderByDesc('updated_at')
            ->limit(5)
            ->get();

        $recentRejected = Resource::where('status', 'rejected')
            ->orderByDesc('updated_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'pendingResources',
            'stats',
            'resourcesBySubject',
            'statusDistribution',
            'resourcesByType',
            'recentApproved',
            'recentRejected'
        ));
    }

    /**
     * Listar todos los recursos con filtros
     */
    public function resources(Request $request)
    {
        $query = Resource::with('author');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->subject) {
            $query->where('subject', $request->subject);
        }

        $resources = $query->orderByDesc('created_at')->paginate(20);

        return view('admin.resources', compact('resources'));
    }

    /**
     * Aprobar un recurso
     */
    public function approve($id)
    {
        $resource = Resource::findOrFail($id);

        if ($resource->status !== 'pending') {
            return back()->with('error', 'Este recurso no está en estado pendiente.');
        }

        $resource->update(['status' => 'approved']);

        return back()->with('success', "Recurso '{$resource->title}' aprobado correctamente.");
    }

    /**
     * Rechazar un recurso
     */
    public function reject(Request $request, $id)
    {
        $resource = Resource::findOrFail($id);

        if ($resource->status !== 'pending') {
            return back()->with('error', 'Este recurso no está en estado pendiente.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'nullable|max:500',
        ]);

        $resource->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'] ?? null,
        ]);

        return back()->with('success', "Recurso '{$resource->title}' rechazado correctamente.");
    }

    /**
     * Cambiar estado de un recurso a draft
     */
    public function draft($id)
    {
        $resource = Resource::findOrFail($id);
        $resource->update(['status' => 'pending']);

        return back()->with('success', "Recurso '{$resource->title}' movido a revisión.");
    }
}
