<?php

namespace Modules\Autorizacao\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Autorizacao\Entities\Exam;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::factory()
            ->count(50)
            ->relProtocol(1)
            ->create();

        // $this->call("OthersTableSeeder");
    }
}
