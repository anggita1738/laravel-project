@extends('layouts.app')

@section('title', 'Laporan Pendaftar')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Laporan Pendaftar</h1>
            <p class="mt-2 text-sm text-gray-600">Data lengkap semua pendaftar magang</p>
        </div>
        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Laporan
        </button>
    </div>

    @php
        $totalPendaftar = $pendaftars->count();
        $totalPending = $pendaftars->where('status', 'pending')->count();
        $totalAccepted = $pendaftars->where('status', 'accepted')->count();
        $totalRejected = $pendaftars->where('status', 'rejected')->count();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <p class="text-sm font-medium text-gray-600">Total Pendaftar</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPendaftar }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
            <p class="text-sm font-medium text-gray-600">Pending</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPending }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-600">Diterima</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalAccepted }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
            <p class="text-sm font-medium text-gray-600">Ditolak</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalRejected }}</p>
        </div>
    </div>

    @if($pendaftars->count() > 0)
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lowongan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departemen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Universitas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IPK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
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
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $pendaftar->major }}</td>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pendaftar->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada data</h3>
            <p class="mt-2 text-sm text-gray-500">Data pendaftar akan ditampilkan di sini.</p>
        </div>
    @endif
</div>

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

