<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Unit;
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
}