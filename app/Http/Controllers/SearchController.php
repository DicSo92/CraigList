<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Department;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department   $department
     * @param                          $currentDepartmentSlug
     * @param                          $search
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dropdownSearch(Request $request, Department $department, $currentDepartmentSlug, $search)
    {
        if (!$search) {
            return response()->json(["error" => true, "message" => "No query Search"], 400);
        }
        $current_department = $department->where('slug', $currentDepartmentSlug)->firstOrFail();

        $departments = Department::where('name', 'like', '%' . $search . '%')->paginate(10);
        $categories = SubCategory::where('title', 'like', '%' . $search . '%')->with('category')->paginate(10);
        $annonces = Annonce::where([['title', 'like', '%' . $search . '%'], ['department_id', $current_department->id]])->with(['subCategory.category', 'department'])->paginate(10);


        return response()->json([
            "departments" => $departments,
            "categories" => $categories,
            "annonces" => $annonces
        ]);
    }

    public function index(Request $request, SubCategory $subCategory, Annonce $annonce, Department $department, $currentDepartmentSlug, $search)
    {
        $current_department = $department->where('slug', $currentDepartmentSlug)->firstOrFail();

        $nb = $request->query('nb') ? $request->query('nb') : 12;

        $ads = $annonce->with(['subCategory.category', 'department', 'user'])->where([['title', 'like', '%' . $search . '%'], ['department_id', $current_department->id]])->orderBy('created_at', 'DESC')->paginate($nb);
        $subCategories = $subCategory->with('category')->where('title', 'like', '%' . $search . '%')->get();
        $departments = $department->where('name', 'like', '%' . $search . '%')->get();;

        return Inertia::render('Search/Index', [
            "annonces" => $ads,
            "subCategories" => $subCategories,
            "departments" => $departments,
            "current" => $current_department,
            "search" => $search
        ]);
    }
}
