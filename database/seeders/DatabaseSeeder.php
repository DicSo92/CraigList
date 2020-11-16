<?php

namespace Database\Seeders;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        $this->call(DepartmentSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);

//        Annonce::factory(30000)->create();
        Annonce::factory(9800)->create();
    }
}
