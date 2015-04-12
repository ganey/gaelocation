<?php namespace Ganey\GAELocation;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class GAELocationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

    public function boot()
    {
        $this->package('ganey/gaelocation');

        AliasLoader::getInstance()->alias('GAELocation', 'Ganey\GAELocation\GAELocation');
    }
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
