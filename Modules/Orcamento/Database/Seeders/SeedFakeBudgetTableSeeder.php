<?php

namespace Modules\Orcamento\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orcamento\Entities\Budget;
class SeedFakeBudgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Budget::factory()
        ->count(10)
        ->create();

        // $this->call("OthersTableSeeder");
    }
}
