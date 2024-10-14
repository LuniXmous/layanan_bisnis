<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Application; // Pastikan import model Application
use App\Models\User; // Jika User juga digunakan untuk menghitung jumlah pengguna

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
            $jumlahPengajuan = Application::count();
            $jumlahSelesai = Application::where('status', 4)->count(); // Jika 1 artinya selesai????
            $jumlahOnProgress = Application::where('status', 1)->count(); // Jika 0 artinya on progress???
            $jumlahPengguna = User::count();
            if (Auth::User()->role->alias == 'admin') {
                return view('admin.index', compact('jumlahPengajuan', 'jumlahSelesai', 'jumlahOnProgress', 'jumlahPengguna'));
            } elseif (Auth::User()->role->alias == 'wadir4') {
                return view('admin.index', compact('jumlahPengajuan', 'jumlahSelesai', 'jumlahOnProgress', 'jumlahPengguna'));
        }
        else return redirect('/application');
    }
}
