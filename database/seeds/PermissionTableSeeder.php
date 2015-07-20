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
        $permissions = \App\Models\Permission::create([
        	'name' => 'create-user',
        	'display_name' => 'Criar Usuário',
        	'description' => 'Permite a criação de usuários',
    	]);
        $permissions->roles()->attach([1]);

        $permissions = \App\Models\Permission::create([
            'name' => 'edit-user',
            'display_name' => 'Editar Usuário',
            'description' => 'Permite a edição de usuários',
        ]);
        $permissions->roles()->attach([1]);

        $permissions = \App\Models\Permission::create([
            'name' => 'delete-user',
            'display_name' => 'Excluir Usuário',
            'description' => 'Permite a excluir de usuários',
        ]);
        $permissions->roles()->attach([1]);
    }
}
