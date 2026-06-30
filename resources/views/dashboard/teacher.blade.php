@extends('layouts.app')

@section('title', 'Mi Panel - Docente')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gold mb-2">📝 Panel del Docente</h1>
            <p class="text-gray-400">Gestiona tus recursos y visualiza estadísticas de tu contenido</p>
        </div>
        <a href="{{ route('resources.create') }}" class="btn-primary self-fit">+ Nuevo Recurso</a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="glass border border-teal/30 rounded-2xl p-6 hover:border-teal/60 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total de Recursos</p>
                    <p class="text-3xl font-bold text-gold">{{ $stats['total'] }}</p>
                </div>
                <div class="text-4xl">📚</div>
            </div>
        </div>

        <div class="glass border border-teal/30 rounded-2xl p-6 hover:border-teal/60 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Aprobados</p>
                    <p class="text-3xl font-bold text-teal">{{ $stats['approved'] }}</p>
                </div>
                <div class="text-4xl">✓</div>
            </div>
        </div>

        <div class="glass border border-teal/30 rounded-2xl p-6 hover:border-teal/60 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Pendientes</p>
                    <p class="text-3xl font-bold text-yellow-500">{{ $stats['pending'] }}</p>
                </div>
                <div class="text-4xl">⏳</div>
            </div>
        </div>

        <div class="glass border border-teal/30 rounded-2xl p-6 hover:border-teal/60 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Descargas</p>
                    <p class="text-3xl font-bold text-blue-400">{{ $stats['total_downloads'] }}</p>
                </div>
                <div class="text-4xl">⬇️</div>
            </div>
        </div>
    </div>

    <!-- Mis Recursos -->
    <div class="glass border border-teal/30 rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gold mb-6">📋 Mis Recursos</h2>

        @if($myResources->count())
            <div class="space-y-4">
                @foreach($myResources as $resource)
                    <div class="glass-light border border-teal/20 rounded-xl p-6 hover:border-teal/50 transition">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-white mb-2">{{ $resource->title }}</h3>
                                <p class="text-gray-400 text-sm mb-3">{{ $resource->description }}</p>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="bg-teal/20 text-teal text-xs px-3 py-1 rounded-full">
                                        {{ $resource->subject }}
                                    </span>
                                    <span class="bg-gold/20 text-gold text-xs px-3 py-1 rounded-full">
                                        {{ $resource->level }}
                                    </span>
                                    <span class="bg-blue/20 text-blue-300 text-xs px-3 py-1 rounded-full">
                                        {{ ucfirst($resource->type) }}
                                    </span>
                                    <span class="text-xs px-3 py-1 rounded-full @if($resource->status == 'approved') bg-teal/20 text-teal @elseif($resource->status == 'pending') bg-yellow-500/20 text-yellow-400 @else bg-red-500/20 text-red-400 @endif">
                                        {{ ucfirst($resource->status === 'approved' ? 'Publicado' : ($resource->status === 'pending' ? 'Pendiente' : 'Rechazado')) }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('library.show', $resource->id) }}" class="px-3 py-2 text-teal hover:text-gold transition text-sm font-semibold">👁️ Ver</a>
                                <a href="{{ route('resources.edit', $resource->id) }}" class="px-3 py-2 text-gold hover:text-gold/80 transition text-sm font-semibold">✏️ Editar</a>
                                <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 text-red-400 hover:text-red-300 transition text-sm font-semibold" onclick="return confirm('¿Eliminar este recurso?')">🗑️ Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($myResources->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $myResources->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg mb-4">No has creado ningún recurso aún</p>
                <a href="{{ route('resources.create') }}" class="btn-primary">Crear mi primer recurso</a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const subjectLabels = @json($subjectLabels);
    const subjectCounts = @json($subjectCounts);

    const ctx = document.getElementById('subjectChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: subjectLabels,
                datasets: [{
                    data: subjectCounts,
                    backgroundColor: ['#178582', '#BFA181', '#0A1828', '#9F7255', '#154A47'],
                    borderColor: '#0A1828',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: { color: '#fff' }
                    }
                }
            }
        });
    }
</script>
@endpush