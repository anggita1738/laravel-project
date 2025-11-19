<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lowongans = [
            [
                'id' => 1,
                'dept_id' => 1,
                'posisi' => 'Staff Akuntansi',
                'quota' => 12,
                'deskripsi' => 'Mengelola jurnal harian, rekonsiliasi, dan closing bulanan.',
                'user_create' => 1, // Admin user
            ],
            [
                'id' => 2,
                'dept_id' => 2,
                'posisi' => 'Business Development Officer',
                'quota' => 10,
                'deskripsi' => 'Riset pasar & membuka peluang kemitraan baru.',
                'user_create' => 1,
            ],
            [
                'id' => 3,
                'dept_id' => 3,
                'posisi' => 'Software Engineer',
                'quota' => 3,
                'deskripsi' => 'Kembangkan fitur ERP/internal apps berbasis Laravel.',
                'user_create' => 1,
            ],
            [
                'id' => 4,
                'dept_id' => 3,
                'posisi' => 'QA/QC Engineer',
                'quota' => 2,
                'deskripsi' => 'Uji kualitas proses/produk & dokumentasi standar.',
                'user_create' => 1,
            ],
            [
                'id' => 5,
                'dept_id' => 4,
                'posisi' => 'HR Generalist',
                'quota' => 8,
                'deskripsi' => 'Rekrutmen, administrasi HR, dan dukungan employee relations.',
                'user_create' => 1,
            ],
            [
                'id' => 6,
                'dept_id' => 5,
                'posisi' => 'Legal Officer (Contract)',
                'quota' => 5,
                'deskripsi' => 'Review kontrak, compliance, dan dokumentasi hukum.',
                'user_create' => 1,
            ],
            [
                'id' => 7,
                'dept_id' => 8,
                'posisi' => 'Account Executive',
                'quota' => 10,
                'deskripsi' => 'Prospek klien, presentasi solusi, dan capai target penjualan.',
                'user_create' => 1,
            ],
            [
                'id' => 8,
                'dept_id' => 9,
                'posisi' => 'Trainer Internal',
                'quota' => 5,
                'deskripsi' => 'Susun materi & melatih user terkait sistem/aplikasi.',
                'user_create' => 1,
            ],
        ];

        foreach ($lowongans as $lowongan) {
            DB::table('master_lowongan')->insert([
                'id' => $lowongan['id'],
                'dept_id' => $lowongan['dept_id'],
                'posisi' => $lowongan['posisi'],
                'quota' => $lowongan['quota'],
                'deskripsi' => $lowongan['deskripsi'],
                'user_create' => $lowongan['user_create'],
                'user_update' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

