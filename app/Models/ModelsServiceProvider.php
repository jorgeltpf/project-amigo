<?php
namespace App\Models;

use Illuminate\Support\ServiceProvider;

class ModelsServiceProvider extends ServiceProvider {

	public function register()
	{

	    $this->app->booting(function()
	    {
	        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
	        $loader->alias('User', 'App\Models\User');

	    });

	}
}