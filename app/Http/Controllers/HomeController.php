<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Application; // Pastikan import model Application
use App\Models\User;  
use App\Models\RekapDana; // This should be present at the top of your HomeController
use Illuminate\Contracts\Support\Renderable;    
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;// Jika User juga digunakan untuk menghitung jumlah pengguna


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    if (Auth::check()) {
        if (Auth::user()->role->id == 0) {
            return redirect()->route('dashboard');
        } else {
            return redirect('/application');
        }
    } else {
        return view('home');
    }
    }

    public function dashboard(Request $request)
    {
            $jumlahPengajuan = Application::count();
            $jumlahSelesai = Application::where('approve_status', 4)->count();
            $jumlahOnProgress = Application::whereIn('approve_status', [1, 2])->count();
            $jumlahPengguna = User::count();

            $year = $request->input('year', date('Y')); 
    
            // Ambil rekapDana untuk tahun tersebut
            $rekapDana = RekapDana::whereYear('created_at', $year)->get();
            $totalNominal = $rekapDana->sum('nominal');
        
            return view('admin.index', compact('jumlahPengajuan', 'jumlahSelesai', 'jumlahOnProgress', 'jumlahPengguna','year', 'totalNominal'));
    }
}
