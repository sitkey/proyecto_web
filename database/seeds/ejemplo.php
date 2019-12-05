<?php

use Illuminate\Database\Seeder;
use App\Trainer;
use App\Pokemons;
use Illuminate\Support\Facades\DB;
class ejemplo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker =\Faker\Factory::create();
        for($index=0; $index<5; $index++){
           
            Trainer::create(
                [
                    'name' => $faker->firstName(16),
                    'password' => $faker->password(6)
                ]
            );  
            sleep(1);
            $trainer = DB::table('trainers')->latest()
            ->value('id');
            DB::table('pokemons')->insert(
                [
                    'id_trainer' => $trainer
                ]
            );  
        }
    }
}
