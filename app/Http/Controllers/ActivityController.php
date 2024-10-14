<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function getActivityByCategory($categoryID,$unitID)
    {
        $activity = Activity::where("category_id",$categoryID)->where('unit_id',$unitID)->get();

        if (!$activity) {
            return response(["status" => "not found"], 422);
        }

        return response(["status" => "ok", "data" => $activity], 200);
    }
}
