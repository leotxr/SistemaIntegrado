<?php

namespace Modules\NC\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\NC\Entities\NonConformity;

class SeedFakeNonConformitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NonConformity::factory()
            ->count(10)
            ->create();
    }
}
