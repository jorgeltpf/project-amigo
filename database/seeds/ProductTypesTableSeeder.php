<?php

use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        \App\Models\ProductType::create([
			'description' => 'Lanche'
		]);
		\App\Models\ProductType::create([
			'description' => 'Bebida'
		]);
        \App\Models\ProductType::create([
            'description' => 'Refeição'
        ]);

    }
}
