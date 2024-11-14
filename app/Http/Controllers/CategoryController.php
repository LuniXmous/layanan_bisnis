<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Unit;

class CategoryController extends Controller
{
    public function getCategoryByUnit($id)
    {
        $categories = Unit::findOrFail($id)->category();
        if (!$categories) {
            return response(["status" => "not found"], 422);
        }
        return response(["status" => "ok", "data" => $categories], 200);
    }
}
