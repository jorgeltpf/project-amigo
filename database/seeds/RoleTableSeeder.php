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
        $role = \App\Models\Role::create([
        	'name' => 'admin',
        	'display_name' => 'Administrador',
        	'description' => 'Administrador do Sistema'
    	]);
        $role->users()->sync([1]);

        $role = \App\Models\Role::create([
            'name' => 'establishment',
            'display_name' => 'Estabelecimento',
            'description' => 'Estabelecimentos'
        ]);
        $role->users()->sync([2]);

        $role = \App\Models\Role::create([
            'name' => 'establishment_operator',
            'display_name' => 'Operador - Estabelecimento',
            'description' => 'Operador presente no estabelecimento'
        ]);

        $role = \App\Models\Role::create([
            'name' => 'client',
            'display_name' => 'Cliente',
            'description' => 'Clientes Externos'
        ]);
    }
}
