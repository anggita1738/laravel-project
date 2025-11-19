<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftars = Pendaftar::with('lowongan.departemen')->paginate(10);
        return view('pendaftar.index', compact('pendaftars'));
    }

    public function create(Lowongan $lowongan)
    {
        return view('pendaftar.create', compact('lowongan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lowongan' => 'required|exists:master_lowongan,id',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'address' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'university' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'ipk' => 'required|numeric|min:0|max:4',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $cvPath = $request->file('cv')->store('cv', 'public');

        Pendaftar::create([
            'id_lowongan' => $request->id_lowongan,
            'name' => $request->name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'university' => $request->university,
            'major' => $request->major,
            'ipk' => $request->ipk,
            'path_cv' => $cvPath,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil! Silakan tunggu konfirmasi.');
    }

    public function show(Pendaftar $pendaftar)
    {
        $pendaftar->load('lowongan.departemen');
        return view('pendaftar.show', compact('pendaftar'));
    }

    public function updateStatus(Request $request, Pendaftar $pendaftar)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $pendaftar->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status pendaftar berhasil diperbarui!');
    }

    public function report()
    {
        $pendaftars = Pendaftar::with('lowongan.departemen')->get();
        
        // Get all lowongan with their departemen
        $lowongans = Lowongan::with('departemen', 'pendaftars')->get();
        
        // Group by department
        $departmentStats = [];
        $totalKuota = 0;
        $totalDiterima = 0;
        $totalDitolak = 0;
        
        foreach ($lowongans as $lowongan) {
            $deptName = $lowongan->departemen->name;
            
            if (!isset($departmentStats[$deptName])) {
                $departmentStats[$deptName] = [
                    'total_kuota' => 0,
                    'diterima' => 0,
                    'ditolak' => 0,
                ];
            }
            
            $departmentStats[$deptName]['total_kuota'] += $lowongan->quota;
            $totalKuota += $lowongan->quota;
            
            foreach ($lowongan->pendaftars as $pendaftar) {
                if ($pendaftar->status === 'accepted') {
                    $departmentStats[$deptName]['diterima']++;
                    $totalDiterima++;
                } elseif ($pendaftar->status === 'rejected') {
                    $departmentStats[$deptName]['ditolak']++;
                    $totalDitolak++;
                }
            }
        }
        
        // Calculate sisa kuota
        foreach ($departmentStats as $dept => &$stats) {
            $stats['sisa_kuota'] = $stats['total_kuota'] - $stats['diterima'];
        }
        
        $sisaKuota = $totalKuota - $totalDiterima;
        
        // Status summary
        $statusStats = [
            'diterima' => $pendaftars->where('status', 'accepted')->count(),
            'ditolak' => $pendaftars->where('status', 'rejected')->count(),
            'pending' => $pendaftars->where('status', 'pending')->count(),
        ];
        
        return view('pendaftar.report', compact(
            'pendaftars',
            'departmentStats',
            'totalKuota',
            'totalDiterima',
            'totalDitolak',
            'sisaKuota',
            'statusStats'
        ));
    }
}

