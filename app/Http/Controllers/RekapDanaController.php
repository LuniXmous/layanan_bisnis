<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapDanaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'extra_application_id' => 'required|exists:extra_applications,id',
            'nominal' => 'required|numeric',
        ]);
    
        RekapDana::create([
            'extra_application_id' => $request->extra_application_id,
            'nominal' => $request->nominal,
        ]);
    
        return redirect()->back()->with('success', 'Nominal dana berhasil disimpan');
    }
    
}
