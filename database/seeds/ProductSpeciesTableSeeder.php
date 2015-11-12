<?php

use Illuminate\Database\Seeder;

class ProductSpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        \App\Models\ProductSpecie::create([
			'description' => 'Normal'
		]);
		\App\Models\ProductSpecie::create([
			'description' => 'Diet'
		]);
        \App\Models\ProductSpecie::create([
            'description' => 'Ligth'
        ]);
        \App\Models\ProductSpecie::create([
            'description' => 'Fitness'
        ]);

        
    }
}
