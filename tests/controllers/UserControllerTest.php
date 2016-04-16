<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
#app/tests/UserControllerTest.php

class UserControllerTest extends TestCase {

	use DatabaseTransactions;

	public function testCreateUser() {
		\App\User::create([
			'name' => 'Teste',
			'email' => 'teste@teste.com',
			'password' => bcrypt(123456),
			'username' => 'teste',
			'confirmation_code' => str_random(32),
			'confirmed' => TRUE,
			'admin' => FALSE
		]);

		$this->seeInDatabase('users', ['name' => 'Teste']);
	}

}