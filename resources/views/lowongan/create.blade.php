@extends('layouts.app')

@section('title', 'Tambah Lowongan')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Lowongan Baru</h1>
        <p class="mt-2 text-sm text-gray-600">Buat lowongan magang baru untuk perusahaan</p>
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

        <form method="POST" action="{{ route('lowongan.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="dept_id" class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                <select 
                    name="dept_id" 
                    id="dept_id" 
                    required
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                >
                    <option value="">Pilih Departemen</option>
                    @foreach($departemens as $departemen)
                        <option value="{{ $departemen->id }}" {{ old('dept_id') == $departemen->id ? 'selected' : '' }}>
                            {{ $departemen->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="posisi" class="block text-sm font-medium text-gray-700 mb-2">Posisi</label>
                <input 
                    type="text" 
                    name="posisi" 
                    id="posisi" 
                    required 
                    value="{{ old('posisi') }}"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    placeholder="Contoh: Software Engineer Intern"
                >
            </div>

            <div>
                <label for="quota" class="block text-sm font-medium text-gray-700 mb-2">Kuota</label>
                <input 
                    type="number" 
                    name="quota" 
                    id="quota" 
                    required 
                    min="1"
                    value="{{ old('quota') }}"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    placeholder="Jumlah peserta yang dibutuhkan"
                >
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea 
                    name="deskripsi" 
                    id="deskripsi" 
                    required 
                    rows="6"
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                    placeholder="Jelaskan detail lowongan, kualifikasi, dan tanggung jawab..."
                >{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('lowongan.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                    Batal
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150"
                >
                    Simpan Lowongan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

