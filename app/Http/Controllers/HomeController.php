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
    public function index(){
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('home');
        }
    }

    public function dashboard(Request $request)
{
    $user = auth()->user(); 
    $year = $request->input('year', date('Y')); 

    if ($user && $user->role->alias == 'applicant') { 
        $jumlahPengajuan = Application::where('user_id', $user->id)->count();
        $jumlahSelesai = Application::where('user_id', $user->id)
            ->where(function($query) {
                $query->where('status', 1)
                      ->where('approve_status', 4);
            })->orWhere(function($query) use ($user) {
                $query->whereIn('status', [2, 3])
                      ->where('approve_status', 3)
                      ->where('user_id', $user->id); // Filter user_id
            })->count();
        $jumlahOnProgress = Application::where('user_id', $user->id) 
            ->whereIn('approve_status', [1, 2])->count();
        $jumlahDiTolak = Application::where('user_id', $user->id) 
            ->where(function($query) {
                $query->where('status', 0)
                      ->where('approve_status', 0);
            })->orWhere(function($query) use ($user) { 
                $query->whereIn('status', [2, 3])
                      ->where('approve_status', 0)
                      ->where('user_id', $user->id); // Filter user_id
            })->count();
        $jumlahPengguna = 1;

        $rekapDana = RekapDana::whereYear('created_at', $year)->get();

    } else {
        $jumlahPengajuan = Application::count();
        $jumlahSelesai = Application::where(function($query) {
            $query->where('status', 1)
                  ->where('approve_status', 4);
        })->orWhere(function($query) {
            $query->whereIn('status', [2, 3])
                  ->where('approve_status', 3);
        })->count();
        $jumlahOnProgress = Application::whereIn('approve_status', [1, 2])->count();
        $jumlahDiTolak = Application::where(function($query) {
            $query->where('status', 0)
                  ->where('approve_status', 0);
        })->orWhere(function($query) {
            $query->whereIn('status', [2, 3])
                  ->where('approve_status', 0);
        })->count();
        $jumlahPengguna = User::count();

        $rekapDana = RekapDana::whereYear('created_at', $year)->get();
    }

    $totalNilaiKontrak = $rekapDana->sum('nilai_kontrak');
    $totalNominal = $rekapDana->sum('nominal');

    return view('admin.index', compact(
        'jumlahPengajuan', 
        'jumlahSelesai', 
        'jumlahOnProgress', 
        'jumlahDiTolak', 
        'jumlahPengguna', 
        'year', 
        'totalNilaiKontrak'
    ));
}




    
}
