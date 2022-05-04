<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SituacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_situacao_curso')->insert([
            'situacao' => 'Confirmado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tb_situacao_curso')->insert([
            'situacao' => 'Em Andamento',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tb_situacao_curso')->insert([
            'situacao' => 'Inscrições Abertas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tb_situacao_curso')->insert([
            'situacao' => 'Inscrições Encerradas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tb_situacao_curso')->insert([
            'situacao' => 'Adiado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tb_situacao_curso')->insert([
            'situacao' => 'Cancelado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tb_situacao_curso')->insert([
            'situacao' => 'Encerrado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
