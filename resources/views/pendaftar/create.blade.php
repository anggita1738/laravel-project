@extends('layouts.app')

@section('title', 'Daftar Magang')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 mb-4">
            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Daftar Magang</h1>
        <p class="mt-2 text-sm text-gray-600">Lengkapi formulir pendaftaran untuk {{ $lowongan->posisi }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-8 mb-6">
        <div class="border-l-4 border-indigo-500 pl-4">
            <h3 class="text-lg font-semibold text-gray-900">{{ $lowongan->posisi }}</h3>
            <p class="text-sm text-gray-600 mt-1">{{ $lowongan->departemen->name }} • Kuota: {{ $lowongan->quota }} orang</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-8">
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pendaftar.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="id_lowongan" value="{{ $lowongan->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        required 
                        value="{{ old('name') }}"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    >
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                    <select 
                        name="gender" 
                        id="gender" 
                        required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    >
                        <option value="">Pilih</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="dob" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                <input 
                    type="date" 
                    name="dob" 
                    id="dob" 
                    required 
                    value="{{ old('dob') }}"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                >
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                <textarea 
                    name="address" 
                    id="address" 
                    required 
                    rows="3"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                >{{ old('address') }}</textarea>
            </div>

            <div>
                <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                <input 
                    type="tel" 
                    name="no_telp" 
                    id="no_telp" 
                    required 
                    value="{{ old('no_telp') }}"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    placeholder="Contoh: 081234567890"
                >
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="university" class="block text-sm font-medium text-gray-700 mb-2">Universitas *</label>
                    <input 
                        type="text" 
                        name="university" 
                        id="university" 
                        required 
                        value="{{ old('university') }}"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    >
                </div>

                <div>
                    <label for="major" class="block text-sm font-medium text-gray-700 mb-2">Jurusan *</label>
                    <input 
                        type="text" 
                        name="major" 
                        id="major" 
                        required 
                        value="{{ old('major') }}"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    >
                </div>
            </div>

            <div>
                <label for="ipk" class="block text-sm font-medium text-gray-700 mb-2">IPK *</label>
                <input 
                    type="number" 
                    name="ipk" 
                    id="ipk" 
                    required 
                    min="0" 
                    max="4" 
                    step="0.01"
                    value="{{ old('ipk') }}"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    placeholder="Contoh: 3.50"
                >
            </div>

            <div>
                <label for="cv" class="block text-sm font-medium text-gray-700 mb-2">Upload CV (PDF) *</label>
                <input 
                    type="file" 
                    name="cv" 
                    id="cv" 
                    required 
                    accept=".pdf"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                >
                <p class="mt-1 text-xs text-gray-500">Format: PDF, Maksimal 2MB</p>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150"
                >
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

