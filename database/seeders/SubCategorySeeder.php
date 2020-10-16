<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/SubCategorySeeder.json");
        $categories = json_decode($json);

        foreach ($categories as $category) {

            foreach ($category->sub_categories as $subCategory) {
                $slug = Str::slug($subCategory, '-');
                SubCategory::create([
                    'title' => $subCategory,
                    'slug' => $slug,
                    'category_id' => $category->category_id
                ]);
            }
        }
    }
}
