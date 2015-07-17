<?php

use Illuminate\Database\Seeder;
 
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = \App\Permission::create([
        	'name' => 'create_user',
        	'display_name' => 'Criar Usuário',
        	'description' => 'Permite a criação de usuários',
    	]);
        $permissions->roles()->sync([1,1]);
    }
}
