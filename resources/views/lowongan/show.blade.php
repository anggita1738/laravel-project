@extends('layouts.app')

@section('title', 'Detail Lowongan')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <a href="{{ route('lowongan.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 mb-4">
            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Detail Lowongan</h1>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $lowongan->posisi }}</h2>
                    <p class="mt-2 text-sm text-gray-500">Dibuat pada {{ $lowongan->created_at->format('d F Y') }}</p>
                </div>
                <span class="px-4 py-2 bg-indigo-100 text-indigo-800 text-sm font-semibold rounded-full">
                    {{ $lowongan->departemen->name }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-8 p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="text-sm font-medium text-gray-500">Kuota</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $lowongan->quota }} orang</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Jumlah Pendaftar</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $lowongan->pendaftars->count() }} orang</p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $lowongan->deskripsi }}</p>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Informasi Tambahan</h3>
                <dl class="grid grid-cols-1 gap-4">
                    @if($lowongan->creator)
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <dt class="text-sm font-medium text-gray-500">Dibuat oleh</dt>
                        <dd class="text-sm text-gray-900">{{ $lowongan->creator->name }}</dd>
                    </div>
                    @endif
                    @if($lowongan->updater)
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <dt class="text-sm font-medium text-gray-500">Terakhir diupdate oleh</dt>
                        <dd class="text-sm text-gray-900">{{ $lowongan->updater->name }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <dt class="text-sm font-medium text-gray-500">Tanggal update</dt>
                        <dd class="text-sm text-gray-900">{{ $lowongan->updated_at->format('d F Y H:i') }}</dd>
                    </div>
                    @endif
                </dl>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('lowongan.edit', $lowongan) }}" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                    Edit Lowongan
                </a>
                <form action="{{ route('lowongan.destroy', $lowongan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150">
                        Hapus Lowongan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

