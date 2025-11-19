@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="mt-2 text-sm text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Lowongan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalLowongan }}</p>
                </div>
                <div class="p-3 bg-indigo-100 rounded-full">
                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pendaftar</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPendaftar }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingPendaftar }}</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Diterima</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $acceptedPendaftar }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Ditolak</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $rejectedPendaftar }}</p>
                </div>
                <div class="p-3 bg-red-100 rounded-full">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('lowongan.create') }}" class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-md p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Tambah Lowongan</h3>
                    <p class="text-sm text-indigo-100">Buat lowongan magang baru</p>
                </div>
            </div>
        </a>

        <a href="{{ route('pendaftar.index') }}" class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl shadow-md p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Kelola Pendaftar</h3>
                    <p class="text-sm text-blue-100">Review dan approval</p>
                </div>
            </div>
        </a>

        <a href="{{ route('pendaftar.report') }}" class="bg-gradient-to-br from-green-500 to-teal-600 rounded-xl shadow-md p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Lihat Laporan</h3>
                    <p class="text-sm text-green-100">Data dan statistik</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

