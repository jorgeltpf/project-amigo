<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		$person = \App\Models\Person::create([
                  'name' => 'Admin',
                  'email' => 'admin@admin.com',
                  'people_type' => '1',
                  'cpf' => '999999999',
                  'phone' => '99999',
                  'cell_phone' => '999999',
                  'street' => 'Teste Admin',
                  'street_number' => '1',
                  'cep' => '97010340',
                  'neighborhood' => 'Teste',
                  'complement' => 'Teste',
                  'city' => 'Teste',
                  'state' => 'RS',
                  'country' => 'Brasil'
            ]);

		\App\User::create([
			'person_id' => $person->id,
			'name' => 'Admin User',
			'username' => 'admin_user',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),
			'confirmed' => 1,
                  'admin' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

      	$person = \App\Models\Person::create([
                  'name' => 'Test User',
                  'email' => 'user@user.com',
                  'people_type' => '1',
                  'cpf' => '888888888',
                  'phone' => '99999',
                  'cell_phone' => '999999',
                  'street' => 'Teste Admin',
                  'street_number' => '1',
                  'cep' => '97010340',
                  'neighborhood' => 'Teste',
                  'complement' => 'Teste',
                  'city' => 'Teste',
                  'state' => 'RS',
                  'country' => 'Brasil'
              ]);

		\App\User::create([
			'person_id' => $person->id,
			'name' => 'Test User',
			'username' => 'test_user',
			'email' => 'user@user.com',
			'password' => bcrypt('user'),
			'confirmed' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

		$person = \App\Models\Person::create([
                  'name' => 'Test Client',
                  'email' => 'client@client.com',
                  'people_type' => '1',
                  'cpf' => '777777777',
                  'phone' => '99999',
                  'cell_phone' => '999999',
                  'street' => 'Teste Admin',
                  'street_number' => '1',
                  'cep' => '97010340',
                  'neighborhood' => 'Teste',
                  'complement' => 'Teste',
                  'city' => 'Teste',
                  'state' => 'RS',
                  'country' => 'Brasil'
            ]);

		\App\User::create([
			'person_id' => $person->id,
			'name' => 'Test Client',
			'username' => 'test_client',
			'email' => 'client@client.com',
			'password' => bcrypt('client'),
			'confirmed' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);
	}

}
