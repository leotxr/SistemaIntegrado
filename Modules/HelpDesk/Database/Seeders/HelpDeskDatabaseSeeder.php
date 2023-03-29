<?php

namespace Modules\HelpDesk\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HelpDeskDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('tickets')->insert([
                'solicitante_id' => rand(1, 20),
                'atendente_id' => 1,
                'status_id' => 2,
                'assunto' => Str::random(10),
                'descricao_abertura' => Str::random(10)." ".Str::random(15),
                'hora_abertura' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
