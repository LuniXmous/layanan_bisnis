<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Unit::all();
            $json = DataTables::collection($data)
                ->addIndexColumn()
                ->addColumn('activities', function ($row) {
                    return $row->activity->count();
                })
                ->addColumn('action', function ($row) {
                    $html = '
                        <a href="' . route('unit.detail', ['id' => $row->id]) . '" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    ';

                    if (env('GOD_MODE')) {
                        $html .= '
                            <a class="btn btn-sm btn-outline-dark mt-2" href="' . route('god_mode.forcelogin', ['id' => $row->admin_id]) . '">Login as admin unit ' . $row->name . '</a>
                        ';
                    }
                    return $html;
                })
                ->rawColumns(['activities', 'action'])
                ->toJson();
            return $json;
        }
        return view('unit.index');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->type == 'services') {
            } elseif ($request->type == 'users') {
                # code...
            }
            $data = Activity::where('unit_id', $id)->orderBy('category_id')->get();
            $json = DataTables::collection($data)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('action', function ($row) {
                    $html = '
                        <button type="button" onclick="updateActivity(' . $row->id . ',' . $row->category_id . ',\'' . $row->name . '\')" class="btn btn-warning">Edit</button>
                    ';
                    return $html;
                })
                ->rawColumns(['category', 'action'])
                ->toJson();
            return $json;
        }

        $unit = Unit::find($id);
        $categories = Category::all();
        return view('unit.detail', [
            'unit' => $unit,
            'categories' => $categories,
        ]);
    }

    public function updateOrCreateActivity(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $update = false;
        if ($request->activity) {
            $update = Activity::findOrFail($request->activity)->update([
                'name' => $request->name,
            ]);
        } else {
            $request->validate([
                'category' => 'required|exists:App\Models\Category,id',
            ]);
            $update = Activity::create([
                'unit_id' => $id,
                'category_id' => $request->category,
                'name' => $request->name,
            ]);
        }

        if ($update) {
            return redirect()->back()->with('success', 'Layanan Berhasil diubah/ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Layanan Gagal diubah/ditambahkan');
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:units,name'
        ]);

        $create = Unit::create([
            'admin_id' => Auth::user()->id,
            'name'=>$request->name
        ]);
        if ($create) {
            return redirect()->back()->with('success', 'Unit Berhasil diubah/ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Unit Gagal diubah/ditambahkan');
        }
    }
}
