<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$faker = \Faker\Factory::create('pt_BR');
$factory->define(App\Endereco::class, function () use ($faker) {

    return [
        'pessoa_id' => function () {
            return factory(App\Pessoa::class)->create()->id;
        },
        'cep' => $faker->postcode,
        'logradouro' => $faker->address,
        'complemento' => $faker->text,
        'localidade' => $faker->locale,
        'bairro' => $faker->word
    ];
});


