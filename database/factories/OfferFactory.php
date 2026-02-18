<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\PlaceOfWork;
use App\Models\TypeOfContract;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => fake()->randomElement(['Programista PHP', 'Analityk finansowy', 'Specjalista ds. marketingu', 'Przedstawiciel handlowy', 'Specjalista HR', 'Nauczyciel', 'Pielęgniarka', 'Kierowca', 'Inżynier budownictwa', 'Kucharz']),
            'description' => fake()->paragraph(),
            'pay' => fake()->numberBetween(3000, 15000),
            'experience_required' => fake()->boolean(),
            'localization' => fake()->city(),
            'place_of_work_id' => PlaceOfWork::inRandomOrder()->first()->id,
            'type_of_contract_id' => TypeOfContract::inRandomOrder()->first()->id,
            'company_name' => fake()->company(),
            'contact' => fake()->companyEmail(),
            'created_at' => fake()->optional(0.9)->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
