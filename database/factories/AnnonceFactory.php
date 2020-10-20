<?php

namespace Database\Factories;

use App\Models\Annonce;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnnonceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Annonce::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence($this->faker->numberBetween(2, 7), false);
        $slug = Str::slug($title, '-');

        $rand = $this->faker->numberBetween(0, 4);
        $images = array();
        if ($rand !== 0) {
            for ($i = 0; $i <= $rand; $i++) {
//                array_push($images, 'https://loremflickr.com/400/400?random=' . $this->faker->randomNumber($nbDigits = NULL, $strict = false));
                array_push($images, 'https://picsum.photos/300/200?random=' . $this->faker->randomNumber($nbDigits = NULL, $strict = false));
            }
        } else {
            $images = null;
        }

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->paragraph($this->faker->numberBetween(1, 3)),
            'images' => $images,
            'department_id' => $this->faker->numberBetween(1, 106),
            'sub_category_id' => $this->faker->numberBetween(1, 183),
        ];
    }
}
