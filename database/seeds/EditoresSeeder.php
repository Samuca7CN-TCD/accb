<?php

use Illuminate\Database\Seeder;

class EditoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('editores')->insert(['nome' => 'Dany Sanchez Dominguez', 'departamentos' => 'UESC/DCET', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('editores')->insert(['nome' => 'Gustavo Joaquim Lisboa', 'departamentos' => 'UESC/DCEC', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('editores')->insert(['nome' => 'Marcelo Inácio Ferreira Ferraz', 'departamentos' => 'UESC/DCET', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('editores')->insert(['nome' => 'Mônica de Moura Pires', 'departamentos' => 'UESC/DCEC', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('editores')->insert(['nome' => 'Paulo César Cruz Dantas', 'departamentos' => 'UESC', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }
}
