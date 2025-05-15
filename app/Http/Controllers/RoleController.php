<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkRole()
{
    $user = Auth::user();
    if ($user->status == 1) {
        return redirect(route('dashboard'));
    } else {
        Auth::logout();
        return redirect('/login')->with(["error" => "Akun anda belum aktif"]);
    }
}
}
