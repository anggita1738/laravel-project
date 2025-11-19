@extends('layouts.app')

@section('title', 'Laporan Pendaftar')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Laporan Pendaftar Magang</h1>
            <p class="mt-2 text-sm text-gray-600">Ringkasan dan statistik lengkap pendaftar</p>
        </div>
        <button onclick="window.print()" class="no-print inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Laporan
        </button>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <p class="text-sm font-medium text-gray-600">Total Kuota</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalKuota }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-600">Diterima</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalDiterima }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
            <p class="text-sm font-medium text-gray-600">Ditolak</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalDitolak }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
            <p class="text-sm font-medium text-gray-600">Sisa Kuota</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $sisaKuota }}</p>
        </div>
    </div>

    <!-- Report Summary per Department -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Summary Pendaftar per Departemen</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Departemen</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Total Kuota</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Diterima</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Ditolak</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Sisa Kuota</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($departmentStats as $department => $stats)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $department }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $stats['total_kuota'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $stats['diterima'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $stats['ditolak'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $stats['sisa_kuota'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100 font-bold">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">GRAND TOTAL</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $totalKuota }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-green-700">{{ $totalDiterima }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-red-700">{{ $totalDitolak }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-yellow-700">{{ $sisaKuota }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Report Status -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Summary Status Pendaftar</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Total Pendaftar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Diterima (Approve)</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-4 py-2 inline-flex text-lg font-bold rounded-lg bg-green-100 text-green-800">
                                {{ $statusStats['diterima'] }}
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Ditolak (Reject)</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-4 py-2 inline-flex text-lg font-bold rounded-lg bg-red-100 text-red-800">
                                {{ $statusStats['ditolak'] }}
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Pending</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-4 py-2 inline-flex text-lg font-bold rounded-lg bg-yellow-100 text-yellow-800">
                                {{ $statusStats['pending'] }}
                            </span>
                        </td>
                    </tr>
                    <tr class="bg-gray-100 font-bold">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">GRAND TOTAL</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-4 py-2 inline-flex text-lg font-bold rounded-lg bg-indigo-100 text-indigo-800">
                                {{ $statusStats['diterima'] + $statusStats['ditolak'] + $statusStats['pending'] }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8 no-print">
        <!-- Chart 1: Status Pendaftar -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Grafik Status Pendaftar</h3>
            <canvas id="statusChart"></canvas>
        </div>

        <!-- Chart 2: Pendaftar per Departemen -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Grafik Pendaftar per Departemen</h3>
            <canvas id="departmentChart"></canvas>
        </div>

        <!-- Chart 3: Kuota vs Diterima -->
        <div class="bg-white rounded-xl shadow-md p-6 lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Grafik Kuota vs Diterima per Departemen</h3>
            <canvas id="quotaChart"></canvas>
        </div>
    </div>

    <!-- Detailed Table -->
    @if($pendaftars->count() > 0)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Detail Data Pendaftar</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lowongan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departemen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Universitas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IPK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pendaftars as $index => $pendaftar)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pendaftar->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pendaftar->gender === 'male' ? 'L' : 'P' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $pendaftar->lowongan->posisi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pendaftar->lowongan->departemen->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $pendaftar->university }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($pendaftar->ipk, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($pendaftar->status === 'pending')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @elseif($pendaftar->status === 'accepted')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Diterima
                                        </span>
                                    @else
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Status Chart (Pie)
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Diterima', 'Ditolak', 'Pending'],
            datasets: [{
                data: [{{ $statusStats['diterima'] }}, {{ $statusStats['ditolak'] }}, {{ $statusStats['pending'] }}],
                backgroundColor: [
                    'rgb(34, 197, 94)',
                    'rgb(239, 68, 68)',
                    'rgb(234, 179, 8)'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Department Chart (Bar)
    const departmentCtx = document.getElementById('departmentChart').getContext('2d');
    new Chart(departmentCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($departmentStats)) !!},
            datasets: [{
                label: 'Diterima',
                data: {!! json_encode(array_column($departmentStats, 'diterima')) !!},
                backgroundColor: 'rgb(34, 197, 94)',
            }, {
                label: 'Ditolak',
                data: {!! json_encode(array_column($departmentStats, 'ditolak')) !!},
                backgroundColor: 'rgb(239, 68, 68)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Quota vs Accepted Chart (Line/Bar Combo)
    const quotaCtx = document.getElementById('quotaChart').getContext('2d');
    new Chart(quotaCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($departmentStats)) !!},
            datasets: [{
                label: 'Total Kuota',
                data: {!! json_encode(array_column($departmentStats, 'total_kuota')) !!},
                backgroundColor: 'rgba(79, 70, 229, 0.7)',
                borderColor: 'rgb(79, 70, 229)',
                borderWidth: 2
            }, {
                label: 'Diterima',
                data: {!! json_encode(array_column($departmentStats, 'diterima')) !!},
                backgroundColor: 'rgba(34, 197, 94, 0.7)',
                borderColor: 'rgb(34, 197, 94)',
                borderWidth: 2
            }, {
                label: 'Sisa Kuota',
                data: {!! json_encode(array_column($departmentStats, 'sisa_kuota')) !!},
                backgroundColor: 'rgba(234, 179, 8, 0.7)',
                borderColor: 'rgb(234, 179, 8)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>

<style>
    @media print {
        .no-print {
            display: none !important;
        }
        body {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
    }
</style>
@endsection
