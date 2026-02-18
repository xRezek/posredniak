<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PlaceOfWork;
use App\Models\User;
use App\Models\Offer;
use App\Models\TypeOfContract;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Category::factory()->sequence(
            ['name' => 'Informatyka'],
            ['name' => 'Finanse'],
            ['name' => 'Marketing'],
            ['name' => 'Sprzedaż'],
            ['name' => 'HR'],
            ['name' => 'Edukacja'],
            ['name' => 'Służba zdrowia'],
            ['name' => 'Transport'],
            ['name' => 'Budownictwo'],
            ['name' => 'Gastronomia']
        )
        ->count(10)
        ->create();

        PlaceOfWork::factory()->sequence(
            ['name' => 'Zdalna'],
            ['name' => 'Hybrydowa'],
            ['name' => 'Stacjonarna']
        )
        ->count(3)
        ->create();

        TypeOfContract::factory()->sequence(
            ['name' => 'Umowa o pracę'],
            ['name' => 'Umowa zlecenie'],
            ['name' => 'Umowa o dzieło'],
            ['name' => 'B2B']
        )
        ->count(4)
        ->create();

        User::factory()->count(20)->create();

        User::factory()
            ->count(40)
            ->has(Offer::factory()->count(5))
            ->create();
    }
}
