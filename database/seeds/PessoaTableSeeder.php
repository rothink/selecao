<?php

use Illuminate\Database\Seeder;

class PessoaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pessoa')->insert(
            [
                'nome' => 'Rodrigo',
                'sobrenome' => 'Araujo',
            ]
        );
    }
}
