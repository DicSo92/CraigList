<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Category;
use App\Models\Department;
use App\Models\Favorite;
use App\Models\SubCategory;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use JD\Cloudder\Facades\Cloudder;

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

        $nb = $request->query('nb') ? $request->query('nb') : 12;
        $subCategory = $subCategory->where('slug', $subCategorySlug)->first();
        $category = $category->where('slug', $categorySlug)->first();

        $ads = $annonce->with(['subCategory.category', 'department', 'user'])->where([['sub_category_id', $subCategory->id], ['department_id', $current_department->id]])->orderBy('created_at', 'DESC')->paginate($nb);

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
        foreach ($request->images as $image) {
            Cloudder::upload($image->getRealPath(), null, array("folder" => env('CLOUDINARY_MAIN_FOLDER')));
            $cloudinary_upload = Cloudder::getResult();
            array_push($imagesArray, $cloudinary_upload['url']);
        }

        $annonce = new Annonce();
        $annonce->title = $request->get('title');
        $annonce->slug = $slug;
        $annonce->description = $request->get('description');
        $annonce->price = $request->get('price');
        $annonce->department_id = $request->get('departmentId');
        $annonce->sub_category_id = $request->get('subCategoryId');
        $annonce->user_id = Auth::id();

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
     * @param \App\Models\Annonce  $annonce
     * @param \App\Models\Category $category
     * @param                      $currentDepartmentSlug
     * @param                      $categorySlug
     * @param                      $subCategorySlug
     * @param                      $annonceSlug
     *
     * @return \Inertia\Response
     */
    public function show(Annonce $annonce, Category $category, $currentDepartmentSlug, $categorySlug, $subCategorySlug, $annonceSlug)
    {
        $category = $category->where('slug', $categorySlug)->first();

        return Inertia::render('Annonce/Index', [
            "category" => $category,
            "annonce" => $annonce->where('slug', $annonceSlug)->with(['department', 'subCategory'])->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Annonce $annonce
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Annonce      $annonce
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Annonce $annonce
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Favorite     $favorite
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleFavorite(Request $request, Favorite $favorite)
    {
        $request->validate([
            'annonceId' => 'required|exists:annonces,id',
        ]);

        if (!Auth::check())
//            return response()->json(["error" => true, "message" => "Unauthorized", 'user' => Auth::user()], 401);
            return back()->with([
                'message' => 'Unauthorized.'
            ]);

        $fav = $favorite->where([['annonce_id', $request->annonceId], ['user_id', Auth::id()]])->first();
        if ($fav) {
            $fav->delete();
            return back()->with([
                'message' => 'Deleted',
                "fav" => $fav
            ]);
        } else {
            $favo = new Favorite;
            $favo->user_id = Auth::id();
            $favo->annonce_id = $request->annonceId;
            $favo->save();

            return back()->with([
                'message' => 'Deleted',
                "fav" => $favo
            ]);
        }
    }
}
