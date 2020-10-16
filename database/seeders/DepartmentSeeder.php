<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/DepartmentSeeder.json");
        $departments = json_decode($json);

        foreach ($departments as $department) {
            $slug = Str::slug($department->name, '-');

            Department::create([
                'code' => $department->code,
                'name' => $department->name,
                'slug' => $slug,
            ]);
        }
    }
}
