<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Department;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dropdownSearch(Request $request, $search)
    {
        if (!$search) {
            return response()->json(["error" => true, "message" => "No query Search"], 400);
        }

        $departments = Department::where('name', 'like', '%' . $search . '%')->paginate(10);
        $categories = SubCategory::where('title', 'like', '%' . $search . '%')->paginate(10);
        $annonces = Annonce::where('title', 'like', '%' . $search . '%')->with(['subCategory.category', 'department'])->paginate(10);


        return response()->json([
            "departments" => $departments,
            "categories" => $categories,
            "annonces" => $annonces
        ]);
    }
}
