<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Category;
use App\Models\Department;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
            $ads = $annonce->with('user')->where([['sub_category_id', $subCategory->id], ['department_id', $current_department->id]])->orderBy('created_at', 'DESC')->paginate(12);
        else
            $ads = $annonce->with('user')->where([['sub_category_id', $subCategory->id], ['department_id', $current_department->id]])->orderBy('created_at', 'DESC')->paginate($nb);

        return Inertia::render('AdList/Index', [
            "category" => $category,
            "sub_category" => $subCategory,
            "annonces" => $ads,
            "current" => $current_department,
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category     $category
     * @param \App\Models\Department   $department
     *
     * @return \Inertia\Response
     */
    public function create(Request $request, Category $category, Department $department)
    {
        return Inertia::render('CreateAd/Index', [
            "departments" => $department->all(),
            "categories" => $category->with('subCategories')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department   $department
     *
     * @param \App\Models\Category     $category
     *
     * @return \Inertia\Response
     */
    public function store(Request $request, Department $department, Category $category)
    {
        $request->validate([
            'subCategoryId' => 'required',
            'departmentId' => 'required',
            'title' => 'required|max:200',
            'description' => 'required|max:6000',
            'price' => 'required',
            'images' => 'array|max:24',
            'images.*' => 'mimes:jpeg,bmp,jpg,png|between:1, 6000',
        ]);

        $slug = Str::slug($request->get('title'), '-');

        $imagesArray = array();
        $cloudinary_upload = null;
        foreach($request->images as $image) {
            $cloudinary_upload = $image->getRealPath()->storeOnCloudinary( env('CLOUDINARY_MAIN_FOLDER') )->getSecurePath();
            array_push($imagesArray, $cloudinary_upload);
        }
        cloudinary()->upload($request->file('file')->getRealPath())->getSecurePath();

        $annonce = new Annonce();

        $annonce->title = $request->get('title');
        $annonce->slug = $slug;
        $annonce->description = $request->get('description');
        $annonce->price = $request->get('price');
        $annonce->department_id =  $request->get('departmentId');
        $annonce->sub_category_id =  $request->get('subCategoryId');
        $annonce->user_id =  Auth::id();

        if (!empty($imagesArray)) {
            $annonce->images = $imagesArray;
        }

        $annonce->save();

        $current_department = $department->where('id', $request->get('departmentId'))->firstOrFail();

        return Inertia::render('Home/Index', [
            "departments" => $department->all(),
            "categories" => $category->with('subCategories')->get(),
            "current" => $current_department,
        ]);
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
