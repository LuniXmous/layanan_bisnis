<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Unit;
use App\Models\RekapDana;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function chartData()
    {
        // Count the number of activities per unit and category
        $data = Activity::join('units', 'activities.unit_id', '=', 'units.id')
            ->select(
                'units.name as unit_name',
                'activities.category_id',
                DB::raw('count(activities.id) as activity_count')
            )
            ->groupBy('units.name', 'activities.category_id')
            ->get();

        return response()->json(['data' => $data]);
    }

    public function chartvalue()
    {
    $data = RekapDana::select(
            DB::raw('EXTRACT(YEAR FROM created_at) as year'), // Mengambil tahun dari created_at
            DB::raw('SUM(nominal) as total_nominal'), // Totalkan nominal berdasarkan tahun
            DB::raw('SUM(nilai_kontrak) as total_kontrak') // Totalkan nilai kontrak berdasarkan tahun
        )
        ->groupBy(DB::raw('EXTRACT(YEAR FROM created_at)')) // Kelompokkan berdasarkan tahun
        ->orderBy('year', 'asc') // Urutkan berdasarkan tahun
        ->get();

    return response()->json(['data' => $data]);
    }
}