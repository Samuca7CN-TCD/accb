<?php

use Illuminate\Database\Seeder;

class MesesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meses')->insert(['posicao' => 0, 'numeracao' => 1, 'nome'=> 'janeiro', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 1, 'numeracao' => 2, 'nome'=> 'fevereiro', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 2, 'numeracao' => 3, 'nome'=> 'março', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 3, 'numeracao' => 4, 'nome'=> 'abril', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 4, 'numeracao' => 5, 'nome'=> 'maio', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 5, 'numeracao' => 6, 'nome'=> 'junho', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 6, 'numeracao' => 7, 'nome'=> 'julho', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 7, 'numeracao' => 8, 'nome'=> 'agosto', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 8, 'numeracao' => 9, 'nome'=> 'setembro', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 9, 'numeracao' => 10, 'nome'=> 'outubro', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 10, 'numeracao' => 11, 'nome'=> 'novembro', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('meses')->insert(['posicao' => 11, 'numeracao' => 12, 'nome'=> 'dezembro', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }
}
