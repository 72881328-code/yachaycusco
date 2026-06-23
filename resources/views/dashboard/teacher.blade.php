@extends('layouts.app')

@section('title', 'Mi Panel - Docente')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-primary">📝 Panel del Docente</h1>
            <p class="text-gray-600 mt-2">Bienvenido al panel de estadísticas y gestión de recursos.</p>
        </div>
        <a href="{{ route('resources.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg shadow hover:bg-red-800">+ Nuevo Recurso</a>
    </div>

    <div class="grid md:grid-cols-2 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Resumen rápido</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 border rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold text-primary">{{ $stats['total'] }}</div>
                    <div class="text-sm text-gray-500">Recursos creados</div>
                </div>
                <div class="bg-gray-50 border rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['approved'] }}</div>
                    <div class="text-sm text-gray-500">Aprobados</div>
                </div>
                <div class="bg-gray-50 border rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
                    <div class="text-sm text-gray-500">Pendientes</div>
                </div>
                <div class="bg-gray-50 border rounded-lg p-4 text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $stats['total_downloads'] }}</div>
                    <div class="text-sm text-gray-500">Descargas totales</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Top generales</h2>
            <div class="grid gap-4">
                <div class="border rounded-lg p-4 bg-gradient-to-r from-primary/10 to-white">
                    <p class="text-sm text-gray-500">Docente con más material</p>
                    @if($topTeacher && $topTeacher->author)
                        <p class="mt-2 text-xl font-bold text-gray-800">{{ $topTeacher->author->name }} {{ $topTeacher->author->lastname }}</p>
                        <p class="text-sm text-gray-600">{{ $topTeacher->total }} recursos</p>
                    @else
                        <p class="text-gray-500">Aún no hay datos suficientes.</p>
                    @endif
                </div>
                <div class="border rounded-lg p-4 bg-gradient-to-r from-blue-100 to-white">
                    <p class="text-sm text-gray-500">Recurso más visto</p>
                    @if($topResource)
                        <p class="mt-2 text-xl font-bold text-gray-800">{{ $topResource->title }}</p>
                        <p class="text-sm text-gray-600">{{ $topResource->views }} vistas · {{ $topResource->downloads }} descargas</p>
                        <p class="text-sm text-gray-500">Autor: {{ $topResource->author?->name }} {{ $topResource->author?->lastname }}</p>
                    @else
                        <p class="text-gray-500">Aún no hay recursos aprobados.</p>
                    @endif
                </div>
                <div class="border rounded-lg p-4 bg-gradient-to-r from-green-100 to-white">
                    <p class="text-sm text-gray-500">Top recursos por descargas</p>
                    @if($topResourcesByDownloads->count())
                        <ul class="mt-3 space-y-2 text-sm text-gray-700">
                            @foreach($topResourcesByDownloads as $resource)
                                <li>• {{ Str::limit($resource->title, 45) }} — {{ $resource->downloads }} descargas</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Sin datos de descargas todavía.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <div class="grid lg:grid-cols-2 gap-6">
            <div class="border rounded-xl p-6 bg-gray-50">
                <h3 class="text-lg font-semibold mb-4">Recursos por materia</h3>
                <canvas id="subjectChart" width="400" height="300"></canvas>
            </div>
            <div class="border rounded-xl p-6 bg-gray-50">
                <h3 class="text-lg font-semibold mb-4">Docentes con más recursos</h3>
                <ul class="space-y-3">
                    @foreach($topTeachers as $teacher)
                        <li class="flex items-center justify-between p-3 rounded-lg bg-white shadow-sm">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $teacher->author?->name }} {{ $teacher->author?->lastname }}</p>
                                <p class="text-sm text-gray-500">{{ $teacher->total }} recursos</p>
                            </div>
                            <span class="text-sm text-primary font-bold">#{{ $loop->iteration }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="p-6 border-b flex gap-3 flex-wrap">
            <button id="tab-my-resources" class="tab-button px-4 py-2 rounded-lg bg-primary text-white">Mis Recursos</button>
            <button id="tab-stats" class="tab-button px-4 py-2 rounded-lg bg-gray-100 text-gray-700">Estadísticas</button>
        </div>

        <div id="panel-my-resources" class="p-6">
            @if($myResources->count())
            <div class="space-y-4">
                @foreach($myResources as $resource)
                <div class="p-6 bg-gray-50 rounded-xl flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div>
                        <h3 class="font-bold text-lg">{{ $resource->title }}</h3>
                        <div class="flex flex-wrap gap-3 text-sm text-gray-500 mt-2">
                            <span>{{ $resource->subject }}</span>
                            <span>{{ $resource->level }}</span>
                            <span>{{ $resource->lang }}</span>
                            <span class="px-2 py-0.5 rounded text-xs @if($resource->status == 'approved') bg-green-100 text-green-800 @elseif($resource->status == 'pending') bg-yellow-100 text-yellow-800 @else bg-red-100 text-red-800 @endif">{{ ucfirst($resource->status) }}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 text-sm">
                        <a href="{{ route('library.show', $resource->id) }}" class="text-blue-600 hover:underline">Ver</a>
                        <a href="{{ route('resources.edit', $resource->id) }}" class="text-yellow-600 hover:underline">Editar</a>
                        <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar este recurso?')">Eliminar</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $myResources->links() }}</div>
            @else
            <div class="p-12 text-center text-gray-500">
                No has creado ningún recurso aún.
                <a href="{{ route('resources.create') }}" class="text-primary hover:underline">Crear mi primer recurso</a>
            </div>
            @endif
        </div>

        <div id="panel-stats" class="p-6 hidden">
            <div class="grid lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-primary/10 rounded-xl p-5">
                    <p class="text-sm text-gray-600">Ratio de aprobación</p>
                    <p class="text-3xl font-bold text-primary">
                        @if($stats['total'] > 0)
                            {{ round(($stats['approved'] / $stats['total']) * 100) }}%
                        @else
                            0%
                        @endif
                    </p>
                </div>
                <div class="bg-blue-50 rounded-xl p-5">
                    <p class="text-sm text-gray-600">Descargas promedio</p>
                    <p class="text-3xl font-bold text-blue-700">
                        @if($stats['total'] > 0)
                            {{ round($stats['total_downloads'] / $stats['total'], 1) }}
                        @else
                            0
                        @endif
                    </p>
                </div>
                <div class="bg-yellow-50 rounded-xl p-5">
                    <p class="text-sm text-gray-600">Recursos pendientes</p>
                    <p class="text-3xl font-bold text-yellow-700">{{ $stats['pending'] }}</p>
                </div>
            </div>
            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detalles del recurso más buscado</h3>
                @if($topResource)
                    <p class="text-xl font-bold">{{ $topResource->title }}</p>
                    <p class="text-gray-600 mb-2">Vistas: {{ $topResource->views }} · Descargas: {{ $topResource->downloads }}</p>
                    <p class="text-gray-500">Creado por {{ $topResource->author?->name }} {{ $topResource->author?->lastname }}</p>
                @else
                    <p class="text-gray-500">No hay recursos aprobados disponibles aún.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const tabMyResources = document.getElementById('tab-my-resources');
    const tabStats = document.getElementById('tab-stats');
    const panelMyResources = document.getElementById('panel-my-resources');
    const panelStats = document.getElementById('panel-stats');

    function activateTab(activeButton, inactiveButton, showPanel, hidePanel) {
        activeButton.classList.add('bg-primary', 'text-white');
        activeButton.classList.remove('bg-gray-100', 'text-gray-700');
        inactiveButton.classList.remove('bg-primary', 'text-white');
        inactiveButton.classList.add('bg-gray-100', 'text-gray-700');
        showPanel.classList.remove('hidden');
        hidePanel.classList.add('hidden');
    }

    tabMyResources.addEventListener('click', () => {
        activateTab(tabMyResources, tabStats, panelMyResources, panelStats);
    });

    tabStats.addEventListener('click', () => {
        activateTab(tabStats, tabMyResources, panelStats, panelMyResources);
    });

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
                    backgroundColor: ['#E11D48', '#F59E0B', '#2563EB', '#16A34A', '#8B5CF6'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.formattedValue}`;
                            }
                        }
                    }
                }
            }
        });
    }
</script>
@endpush