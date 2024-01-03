<?php

namespace Modules\NC\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\NC\Entities\NonConformity;
use App\Models\User;

class SeedFakeNonConformitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NonConformity::factory()
            ->has(User::factory()->count(3))
            ->count(10)
            ->create();
    }
}
