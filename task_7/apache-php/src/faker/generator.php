<?php

require_once '../vendor/autoload.php';
require_once 'FakeDataItem.php';

function generate_data()
{
    $data = array();

    // use the factory to create a Faker\Generator instance
    $faker = Faker\Factory::create();
    // for include russian PersonName
    $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
    $faker->addProvider(new Faker\Provider\ru_RU\Color($faker));

    // generate 50 records for idonotknowwhywedothisthinghelpTask
    for ($i = 0; $i < 50; $i++) {
        $data_row = new FakeDataItem(
            $faker->name(),
            $faker->colorName(),
            $faker->date(),
            $faker->time(),
            $faker->monthName(),
            $faker->century(),
            $faker->countryCode(),
            $faker->randomDigit(),
            $faker->latitude(),
            $faker->longitude()
        );
        $data[] = $data_row;
    }

    $jsonData = json_encode($data);
    //for generated fixture data
    file_put_contents('results.json', $jsonData);
}
