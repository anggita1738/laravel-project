<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create dummy CV files
        Storage::disk('public')->makeDirectory('cv');
        
        $pendaftars = [
            [
                'id' => 1,
                'id_lowongan' => 5,
                'name' => 'John Doe',
                'gender' => 'male',
                'dob' => '2000-11-02',
                'address' => 'Jl. Raya Sidoarjo No. 123, Sidoarjo, Jawa Timur',
                'no_telp' => '08785555682',
                'university' => 'Universitas Brawijaya',
                'major' => 'Teknik Informatika',
                'ipk' => 3.88,
                'status' => 'pending',
                'path_cv' => 'cv/john_doe_cv.pdf',
            ],
            [
                'id' => 2,
                'id_lowongan' => 3,
                'name' => 'Jane Smith',
                'gender' => 'female',
                'dob' => '2001-05-15',
                'address' => 'Jl. Merdeka No. 45, Surabaya, Jawa Timur',
                'no_telp' => '08123456789',
                'university' => 'Institut Teknologi Sepuluh Nopember',
                'major' => 'Sistem Informasi',
                'ipk' => 3.75,
                'status' => 'pending',
                'path_cv' => 'cv/jane_smith_cv.pdf',
            ],
            [
                'id' => 3,
                'id_lowongan' => 1,
                'name' => 'Ahmad Zulkifli',
                'gender' => 'male',
                'dob' => '2000-08-22',
                'address' => 'Jl. Diponegoro No. 78, Malang, Jawa Timur',
                'no_telp' => '08567891234',
                'university' => 'Universitas Airlangga',
                'major' => 'Akuntansi',
                'ipk' => 3.65,
                'status' => 'pending',
                'path_cv' => 'cv/ahmad_zulkifli_cv.pdf',
            ],
            [
                'id' => 4,
                'id_lowongan' => 7,
                'name' => 'Siti Nurhaliza',
                'gender' => 'female',
                'dob' => '2001-03-10',
                'address' => 'Jl. Pahlawan No. 56, Gresik, Jawa Timur',
                'no_telp' => '08234567890',
                'university' => 'Universitas Negeri Surabaya',
                'major' => 'Manajemen Bisnis',
                'ipk' => 3.92,
                'status' => 'pending',
                'path_cv' => 'cv/siti_nurhaliza_cv.pdf',
            ],
            [
                'id' => 5,
                'id_lowongan' => 2,
                'name' => 'Budi Santoso',
                'gender' => 'male',
                'dob' => '2000-12-30',
                'address' => 'Jl. Gatot Subroto No. 90, Mojokerto, Jawa Timur',
                'no_telp' => '08998765432',
                'university' => 'Universitas Brawijaya',
                'major' => 'Manajemen',
                'ipk' => 3.55,
                'status' => 'pending',
                'path_cv' => 'cv/budi_santoso_cv.pdf',
            ],
        ];

        foreach ($pendaftars as $pendaftar) {
            // Create dummy CV file
            Storage::disk('public')->put($pendaftar['path_cv'], 'Dummy CV content for ' . $pendaftar['name']);
            
            DB::table('transaksi_pendaftar')->insert([
                'id' => $pendaftar['id'],
                'id_lowongan' => $pendaftar['id_lowongan'],
                'name' => $pendaftar['name'],
                'gender' => $pendaftar['gender'],
                'dob' => $pendaftar['dob'],
                'address' => $pendaftar['address'],
                'no_telp' => $pendaftar['no_telp'],
                'university' => $pendaftar['university'],
                'major' => $pendaftar['major'],
                'ipk' => $pendaftar['ipk'],
                'status' => $pendaftar['status'],
                'path_cv' => $pendaftar['path_cv'],
                'created_at' => now()->subDays(rand(1, 10)),
                'updated_at' => now()->subDays(rand(1, 10)),
            ]);
        }
    }
}

