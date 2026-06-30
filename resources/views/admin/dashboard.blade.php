@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-yellow-600 mb-2">⚙️ Panel de Administración</h1>
        <p class="text-gray-400">Gestiona la aprobación de recursos y supervisa el contenido de la plataforma</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-yellow-500/30 rounded-2xl p-6 hover:border-yellow-500/60 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Pendientes</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['total_pending'] }}</p>
                </div>
                <div class="text-4xl">⏳</div>
            </div>
        </div>

        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6 hover:border-teal-500/60 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Aprobados</p>
                    <p class="text-3xl font-bold text-teal-500">{{ $stats['total_approved'] }}</p>
                </div>
                <div class="text-4xl">✓</div>
            </div>
        </div>

        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-red-500/30 rounded-2xl p-6 hover:border-red-500/60 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Rechazados</p>
                    <p class="text-3xl font-bold text-red-500">{{ $stats['total_rejected'] }}</p>
                </div>
                <div class="text-4xl">✗</div>
            </div>
        </div>

        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-gold/30 rounded-2xl p-6 hover:border-gold/60 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Total</p>
                    <p class="text-3xl font-bold text-gold">{{ $stats['total_resources'] }}</p>
                </div>
                <div class="text-4xl">📚</div>
            </div>
        </div>
    </div>

    <!-- User Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6">
            <p class="text-gray-400 text-sm mb-2">👥 Usuarios</p>
            <p class="text-2xl font-bold text-teal-500">{{ $stats['total_users'] }}</p>
        </div>

        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6">
            <p class="text-gray-400 text-sm mb-2">👨‍🏫 Profesores</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['total_teachers'] }}</p>
        </div>

        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6">
            <p class="text-gray-400 text-sm mb-2">👨‍🎓 Estudiantes</p>
            <p class="text-2xl font-bold text-blue-400">{{ $stats['total_students'] }}</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Estado de Recursos -->
        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-yellow-600 mb-4">Estado de Recursos</h3>
            <canvas id="statusChart" height="200"></canvas>
        </div>

        <!-- Recursos por Materia -->
        <div class="lg:col-span-2 bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-yellow-600 mb-4">Recursos por Materia</h3>
            <canvas id="subjectChart" height="200"></canvas>
        </div>
    </div>

    <!-- Second Row Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recursos por Tipo -->
        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-yellow-600 mb-4">Recursos por Tipo</h3>
            <canvas id="typeChart" height="200"></canvas>
        </div>

        <!-- Recursos Recientes -->
        <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-yellow-600 mb-4">Recientes Aprobados</h3>
            <div class="space-y-3 max-h-64 overflow-y-auto">
                @forelse($recentApproved as $resource)
                    <div class="bg-gray-700/50 p-3 rounded-lg border border-teal-500/20">
                        <p class="text-sm text-white font-medium truncate">{{ $resource->title }}</p>
                        <p class="text-xs text-gray-400">{{ $resource->updated_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm text-center py-4">Sin recursos aprobados</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Pending Resources Section -->
    <div class="bg-gray-800 backdrop-blur-md bg-opacity-50 border border-teal-500/30 rounded-2xl p-8 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-yellow-600">⏳ Pendientes de Aprobación</h2>
            <a href="{{ route('admin.resources') }}" class="text-teal-400 hover:text-teal-300 transition font-medium">Ver todos →</a>
        </div>

        @if($pendingResources->count() > 0)
            <div class="space-y-4">
                @foreach($pendingResources as $resource)
                    <div class="bg-gray-700/50 border border-teal-500/20 rounded-xl p-6 hover:border-teal-500/50 transition">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-white mb-2">{{ $resource->title }}</h3>
                                <p class="text-gray-400 text-sm mb-3">{{ Str::limit($resource->description, 100) }}</p>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="bg-teal-500/20 text-teal-300 text-xs px-3 py-1 rounded-full">
                                        {{ $resource->subject }}
                                    </span>
                                    <span class="bg-yellow-500/20 text-yellow-300 text-xs px-3 py-1 rounded-full">
                                        {{ $resource->level }}
                                    </span>
                                    <span class="bg-blue-500/20 text-blue-300 text-xs px-3 py-1 rounded-full">
                                        {{ ucfirst($resource->type) }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500">
                                    👤 {{ $resource->author->name }} | {{ $resource->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <form method="POST" action="{{ route('admin.approve', $resource->id) }}" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    ✓ Aprobar
                                </button>
                            </form>

                            <button 
                                onclick="openRejectModal({{ $resource->id }}, '{{ $resource->title }}')"
                                class="flex-1 bg-red-500/20 hover:bg-red-500/40 text-red-400 hover:text-red-300 font-semibold py-2 px-4 rounded-lg transition border border-red-500/30"
                            >
                                ✗ Rechazar
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($pendingResources->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $pendingResources->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg">✓ ¡No hay recursos pendientes!</p>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Datos para los gráficos
const statusData = {
    labels: ['Pendiente', 'Aprobado', 'Rechazado'],
    data: [{{ $statusDistribution['Pendiente'] }}, {{ $statusDistribution['Aprobado'] }}, {{ $statusDistribution['Rechazado'] }}]
};

const subjectData = {
    labels: [
        @foreach($resourcesBySubject as $subject => $count)
            '{{ $subject }}',
        @endforeach
    ],
    data: [
        @foreach($resourcesBySubject as $subject => $count)
            {{ $count }},
        @endforeach
    ]
};

const typeData = {
    labels: [
        @foreach($resourcesByType as $type => $count)
            '{{ ucfirst($type) }}',
        @endforeach
    ],
    data: [
        @foreach($resourcesByType as $type => $count)
            {{ $count }},
        @endforeach
    ]
};

// Gráfico de Estado (Pie Chart)
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: statusData.labels,
        datasets: [{
            data: statusData.data,
            backgroundColor: ['#fbbf24', '#14b8a6', '#ef4444'],
            borderColor: ['rgba(251, 191, 36, 0.3)', 'rgba(20, 184, 166, 0.3)', 'rgba(239, 68, 68, 0.3)'],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                labels: { color: '#d1d5db', font: { size: 12 } }
            }
        }
    }
});

// Gráfico de Materias (Bar Chart)
const subjectCtx = document.getElementById('subjectChart').getContext('2d');
new Chart(subjectCtx, {
    type: 'bar',
    data: {
        labels: subjectData.labels,
        datasets: [{
            label: 'Recursos',
            data: subjectData.data,
            backgroundColor: '#14b8a6',
            borderColor: 'rgba(20, 184, 166, 0.5)',
            borderWidth: 1,
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                labels: { color: '#d1d5db' }
            }
        },
        scales: {
            y: {
                ticks: { color: '#d1d5db' },
                grid: { color: 'rgba(209, 213, 219, 0.1)' }
            },
            x: {
                ticks: { color: '#d1d5db' },
                grid: { color: 'rgba(209, 213, 219, 0.1)' }
            }
        }
    }
});

// Gráfico de Tipos (Doughnut Chart)
const typeCtx = document.getElementById('typeChart').getContext('2d');
new Chart(typeCtx, {
    type: 'doughnut',
    data: {
        labels: typeData.labels,
        datasets: [{
            data: typeData.data,
            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
            borderColor: ['rgba(59, 130, 246, 0.3)', 'rgba(16, 185, 129, 0.3)', 'rgba(245, 158, 11, 0.3)'],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                labels: { color: '#d1d5db', font: { size: 12 } }
            }
        }
    }
});

// Modal functions
function openRejectModal(resourceId, title) {
    document.getElementById('resourceTitle').textContent = 'Recurso: ' + title;
    document.getElementById('rejectForm').action = `/admin/resources/${resourceId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

// Cerrar modal al hacer clic fuera
document.getElementById('rejectModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});
</script>
@endsection

