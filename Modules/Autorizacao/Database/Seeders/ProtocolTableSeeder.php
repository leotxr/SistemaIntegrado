<?php

namespace Modules\Autorizacao\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Autorizacao\Entities\Protocol;

class ProtocolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Protocol::factory()
            ->count(50)
            ->relExams(2)
            ->create();

        // $this->call("OthersTableSeeder");
    }
}
