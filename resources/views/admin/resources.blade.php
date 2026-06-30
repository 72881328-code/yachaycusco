@extends('layouts.app')

@section('title', 'Gestionar Recursos')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-yellow-600 mb-2">Gestionar Recursos</h1>
        <p class="text-gray-400">Visualiza y gestiona todos los recursos de la plataforma</p>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6 mb-8">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label class="text-gray-300 block mb-2 text-sm">Estado</label>
                <select name="status" class="w-full bg-gray-700 border border-teal-500/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal-500">
                    <option value="">Todos los estados</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pendientes</option>
                    <option value="approved" @selected(request('status') === 'approved')>Aprobados</option>
                    <option value="rejected" @selected(request('status') === 'rejected')>Rechazados</option>
                </select>
            </div>

            <div class="flex-1">
                <label class="text-gray-300 block mb-2 text-sm">Materia</label>
                <select name="subject" class="w-full bg-gray-700 border border-teal-500/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal-500">
                    <option value="">Todas las materias</option>
                    <option value="Matematica" @selected(request('subject') === 'Matematica')>Matemática</option>
                    <option value="Comunicacion" @selected(request('subject') === 'Comunicacion')>Comunicación</option>
                    <option value="Ciencia" @selected(request('subject') === 'Ciencia')>Ciencia</option>
                    <option value="Quechua" @selected(request('subject') === 'Quechua')>Quechua</option>
                    <option value="Historia" @selected(request('subject') === 'Historia')>Historia</option>
                </select>
            </div>

            <div class="flex gap-2 items-end">
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                    Filtrar
                </button>
                <a href="{{ route('admin.resources') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Resources Table -->
    <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl overflow-hidden">
        @if($resources->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-teal-500/30">
                        <tr>
                            <th class="px-6 py-4 text-left text-yellow-600 font-semibold">Título</th>
                            <th class="px-6 py-4 text-left text-yellow-600 font-semibold">Autor</th>
                            <th class="px-6 py-4 text-left text-yellow-600 font-semibold">Materia</th>
                            <th class="px-6 py-4 text-left text-yellow-600 font-semibold">Estado</th>
                            <th class="px-6 py-4 text-left text-yellow-600 font-semibold">Fecha</th>
                            <th class="px-6 py-4 text-center text-yellow-600 font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-teal-500/20">
                        @foreach($resources as $resource)
                            <tr class="hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 text-white">
                                    <div class="font-semibold">{{ $resource->title }}</div>
                                    <div class="text-sm text-gray-400">{{ Str::limit($resource->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-300">{{ $resource->author->name }}</td>
                                <td class="px-6 py-4 text-gray-300">{{ $resource->subject }}</td>
                                <td class="px-6 py-4">
                                    @if($resource->status === 'pending')
                                        <span class="bg-yellow-500/20 text-yellow-300 text-xs px-3 py-1 rounded-full">
                                            Pendiente
                                        </span>
                                    @elseif($resource->status === 'approved')
                                        <span class="bg-teal-500/20 text-teal-300 text-xs px-3 py-1 rounded-full">
                                            Aprobado
                                        </span>
                                    @else
                                        <span class="bg-red-500/20 text-red-300 text-xs px-3 py-1 rounded-full">
                                            Rechazado
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-sm">{{ $resource->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        @if($resource->status === 'pending')
                                            <form method="POST" action="{{ route('admin.approve', $resource->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-teal-400 hover:text-teal-300 transition text-sm" title="Aprobar">
                                                    ✓ Aprobar
                                                </button>
                                            </form>
                                            <button 
                                                onclick="openRejectModal({{ $resource->id }}, '{{ addslashes($resource->title) }}')"
                                                class="text-red-400 hover:text-red-300 transition text-sm"
                                                title="Rechazar"
                                            >
                                                ✗ Rechazar
                                            </button>
                                        @elseif($resource->status === 'rejected' && $resource->rejection_reason)
                                            <button 
                                                onclick="showReason('{{ addslashes($resource->rejection_reason) }}')"
                                                class="text-yellow-400 hover:text-yellow-300 transition text-sm"
                                                title="Ver motivo"
                                            >
                                                Ver motivo
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($resources->hasPages())
                <div class="border-t border-teal-500/30 px-6 py-4">
                    {{ $resources->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg">No hay recursos que mostrar</p>
            </div>
        @endif
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-gray-800 border border-teal-500/30 rounded-2xl p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold text-yellow-600 mb-4">Rechazar Recurso</h3>
        <p id="resourceTitle" class="text-gray-400 mb-4"></p>
        
        <form id="rejectForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-gray-300 block mb-2">Motivo del Rechazo (opcional)</label>
                <textarea 
                    name="rejection_reason"
                    rows="4"
                    placeholder="Explicar por qué se rechaza este recurso..."
                    class="w-full bg-gray-700 border border-teal-500/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal-500"
                ></textarea>
            </div>

            <div class="flex gap-3">
                <button 
                    type="button"
                    onclick="closeRejectModal()"
                    class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition"
                >
                    Cancelar
                </button>
                <button 
                    type="submit"
                    class="flex-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition"
                >
                    Rechazar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reason Modal -->
<div id="reasonModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-gray-800 border border-teal-500/30 rounded-2xl p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold text-yellow-600 mb-4">Motivo del Rechazo</h3>
        <p id="reasonText" class="text-gray-300 mb-6"></p>
        <button 
            onclick="closeReasonModal()"
            class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-lg transition"
        >
            Cerrar
        </button>
    </div>
</div>

<script>
function openRejectModal(resourceId, title) {
    document.getElementById('resourceTitle').textContent = 'Recurso: ' + title;
    document.getElementById('rejectForm').action = `/admin/resources/${resourceId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

function showReason(reason) {
    document.getElementById('reasonText').textContent = reason;
    document.getElementById('reasonModal').classList.remove('hidden');
}

function closeReasonModal() {
    document.getElementById('reasonModal').classList.add('hidden');
}

// Cerrar modales al hacer clic fuera
document.getElementById('rejectModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeRejectModal();
});

document.getElementById('reasonModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeReasonModal();
});
</script>
@endsection
