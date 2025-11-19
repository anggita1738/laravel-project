@extends('layouts.app')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <a href="{{ route('pendaftar.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 mb-4">
            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Detail Pendaftar</h1>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $pendaftar->name }}</h2>
                    <p class="mt-2 text-sm text-gray-500">Mendaftar pada {{ $pendaftar->created_at->format('d F Y') }}</p>
                </div>
                @if($pendaftar->status === 'pending')
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">
                        Pending
                    </span>
                @elseif($pendaftar->status === 'accepted')
                    <span class="px-4 py-2 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                        Diterima
                    </span>
                @else
                    <span class="px-4 py-2 bg-red-100 text-red-800 text-sm font-semibold rounded-full">
                        Ditolak
                    </span>
                @endif
            </div>

            <div class="mb-8 p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                <h3 class="text-sm font-semibold text-indigo-900 mb-1">Melamar untuk:</h3>
                <p class="text-lg font-bold text-indigo-900">{{ $pendaftar->lowongan->posisi }}</p>
                <p class="text-sm text-indigo-700">{{ $pendaftar->lowongan->departemen->name }}</p>
            </div>

            <div class="space-y-4 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pribadi</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Jenis Kelamin</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">{{ $pendaftar->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">{{ $pendaftar->dob->format('d F Y') }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Alamat</p>
                    <p class="mt-1 text-base font-semibold text-gray-900">{{ $pendaftar->address }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Nomor Telepon</p>
                    <p class="mt-1 text-base font-semibold text-gray-900">{{ $pendaftar->no_telp }}</p>
                </div>
            </div>

            <div class="space-y-4 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pendidikan</h3>
                
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Universitas</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">{{ $pendaftar->university }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Jurusan</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">{{ $pendaftar->major }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">IPK</p>
                        <p class="mt-1 text-2xl font-bold text-indigo-600">{{ number_format($pendaftar->ipk, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Curriculum Vitae</h3>
                <a href="{{ Storage::url($pendaftar->path_cv) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-900 text-sm font-medium rounded-lg transition duration-150">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Lihat CV
                </a>
            </div>

            @if($pendaftar->status === 'pending')
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <form action="{{ route('pendaftar.updateStatus', $pendaftar) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftar ini?')">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                        Tolak
                    </button>
                </form>
                <form action="{{ route('pendaftar.updateStatus', $pendaftar) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menerima pendaftar ini?')">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="accepted">
                    <button type="submit" class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                        Terima
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

