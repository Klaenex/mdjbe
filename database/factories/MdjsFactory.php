<?php

namespace Database\Factories;

use App\Models\Mdjs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MdjsFactory extends Factory
{
    protected $model = Mdjs::class;

    public function definition(): array
    {
        $name = $this->faker->company().' Maison de Jeunes';

        return [
            'name' => $name,
            'location' => $this->faker->address(),
            'objective' => $this->faker->sentence(10),
            'tagline' => $this->faker->catchPhrase(),
            'street' => $this->faker->streetAddress(),
            'dispositif_particulier' => null,
            'number' => $this->faker->buildingNumber(),
            'postal_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'email' => $this->faker->unique()->safeEmail(),
            'site' => $this->faker->url(),
            'facebook' => 'https://facebook.com/'.Str::slug($name),
            'instagram' => 'https://instagram.com/'.Str::slug($name),
            'tel' => $this->faker->e164PhoneNumber(),
            'slug' => Str::slug($name),
            'region' => $this->faker->randomElement(['Wallonie', 'Bruxelles', 'Flandre']),
            'active' => $this->faker->boolean(90),
            'id_user' => null,
        ];
    }
}
