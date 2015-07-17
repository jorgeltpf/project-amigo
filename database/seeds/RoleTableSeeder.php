<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Role::create([
        	'name' => 'admin',
        	'display_name' => 'Administrador',
        	'description' => 'Administrador do Sistema'
    	]);
        $role->users()->sync([1]);
    }
}
