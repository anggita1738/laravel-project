@extends('layouts.app')

@section('title', 'Dashboard Guest')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Lowongan Magang</h1>
        <p class="mt-2 text-sm text-gray-600">Temukan dan daftar lowongan magang yang sesuai dengan minat Anda</p>
    </div>

    @if($lowongans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($lowongans as $lowongan)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded-full">
                                {{ $lowongan->departemen->name }}
                            </span>
                            <span class="text-sm text-gray-500">Kuota: {{ $lowongan->quota }}</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $lowongan->posisi }}</h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $lowongan->deskripsi }}</p>
                        
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-500">
                                {{ $lowongan->created_at->diffForHumans() }}
                            </span>
                            <a href="{{ route('pendaftar.create', $lowongan) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition duration-150">
                                Daftar
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $lowongans->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada lowongan tersedia</h3>
            <p class="mt-2 text-sm text-gray-500">Lowongan magang akan ditampilkan di sini ketika tersedia.</p>
        </div>
    @endif
</div>
@endsection

