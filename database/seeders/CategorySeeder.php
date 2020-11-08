<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array('Communauté', 'Services', 'Forums de discussion', 'Immobilier', 'A vendre', 'Emploi', 'Petits boulots', );

        foreach ($categories as $categorie) {
            $slug = Str::slug($categorie, '-');

            Category::create([
                'title' => $categorie,
                'slug' => $slug,
            ]);
        }
    }
}
