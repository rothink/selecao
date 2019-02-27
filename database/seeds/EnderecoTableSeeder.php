<?php

use Illuminate\Database\Seeder;

class EnderecoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('endereco')->insert(
            [
                'pessoa_id' => 1,
                'cep' => 7222544,
                'logradouro' => 'Ceilandia',
                'complemento' => 'Complemento da moradia',
                'localidade' => 'DF',
                'bairro' => 'quebrada'
            ]
        );
        DB::table('endereco')->insert(
            [
                'pessoa_id' => 1,
                'cep' => 7222544,
                'logradouro' => 'Taguatinga',
                'complemento' => 'Complemento da moradia',
                'localidade' => 'DF',
                'bairro' => 'taguá'
            ]
        );
        DB::table('endereco')->insert(
            [
                'pessoa_id' => 1,
                'cep' => 7222544,
                'logradouro' => 'Recando das emas',
                'complemento' => 'Complemento da moradia',
                'localidade' => 'DF',
                'bairro' => 'emas'
            ]
        );
        DB::table('endereco')->insert(
            [
                'pessoa_id' => 1,
                'cep' => 7222544,
                'logradouro' => 'Asa sul',
                'complemento' => 'Complemento da moradia',
                'localidade' => 'DF',
                'bairro' => 'trampo'
            ]
        );
        factory(App\Endereco::class, 10)->create();
    }
}
