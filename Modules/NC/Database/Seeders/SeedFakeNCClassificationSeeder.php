<?php

namespace Modules\NC\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\NC\Entities\NCClassification;

class SeedFakeNCClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NCClassification::factory()
            ->count(10)
            ->create();
    }
}
