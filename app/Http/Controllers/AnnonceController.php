<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Category;
use App\Models\Department;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnnonceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category     $category
     * @param \App\Models\SubCategory  $subCategory
     * @param \App\Models\Department   $department
     * @param \App\Models\Annonce      $annonce
     * @param                          $currentDepartmentSlug
     * @param                          $categorySlug
     *
     * @param                          $subCategorySlug
     *
     * @return \Inertia\Response
     */
    public function adsBySubCategory(Request $request, Category $category, SubCategory $subCategory, Annonce $annonce, Department $department, $currentDepartmentSlug, $categorySlug, $subCategorySlug)
    {
        $current_department = $department->where('slug', $currentDepartmentSlug)->firstOrFail();

        $nb = $request->query('nb');
        $subCategory = $subCategory->where('slug', $subCategorySlug)->first();
        $category = $category->where('slug', $categorySlug)->first();

        if (!isset($nb))
            $ads = $annonce->where([['sub_category_id', $subCategory->id], ['department_id', $current_department->id]])->orderBy('created_at', 'DESC')->paginate(15);
        else
            $ads = $annonce->where([['sub_category_id', $subCategory->id], ['department_id', $current_department->id]])->orderBy('created_at', 'DESC')->paginate($nb);

        return Inertia::render('AdList/Index', [
            "category" => $category,
            "sub_category" => $subCategory,
            "annonces" => $ads
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
