<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Pendaftar;
use App\Models\Departemen;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            $totalLowongan = Lowongan::count();
            $totalPendaftar = Pendaftar::count();
            $pendingPendaftar = Pendaftar::where('status', 'pending')->count();
            $acceptedPendaftar = Pendaftar::where('status', 'accepted')->count();
            $rejectedPendaftar = Pendaftar::where('status', 'rejected')->count();
            
            return view('dashboard.admin', compact(
                'totalLowongan',
                'totalPendaftar',
                'pendingPendaftar',
                'acceptedPendaftar',
                'rejectedPendaftar'
            ));
        } else {
            $lowongans = Lowongan::with('departemen')->paginate(6);
            return view('dashboard.guest', compact('lowongans'));
        }
    }
}

