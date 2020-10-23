<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @param \App\Models\Category     $category
     *
     * @param \App\Models\Department   $department
     *
     * @return \Inertia\Response
     */
    public function __invoke(Request $request, Category $category, Department $department, $currentDepartmentSlug)
    {
        $current_department = $department->where('slug', $currentDepartmentSlug)->firstOrFail();

        return Inertia::render('Home/Index', [
            "departments" => $department->all(),
            "categories" => $category->with('subCategories')->get(),
            "current" => $current_department,

//            "categories" => $category->whereHas('subCategories', function ($query) {
//                return $query->has('annonces');
//            })->get()
        ]);
    }
}
