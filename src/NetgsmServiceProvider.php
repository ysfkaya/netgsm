<?php

namespace Brkphp\Netgsm;

use Illuminate\Support\ServiceProvider;

class NetgsmServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadTranslationsFrom(__DIR__.'/Lang', 'netgsm');

		$this->publishes([
			__DIR__.'/Config/netgsm.php' => config_path('netgsm.php'),
		], 'config');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// Config
		$this->mergeConfigFrom(__DIR__.'/Config/netgsm.php', 'netgsm');

		$this->app->singleton('Netgsm', function ($app) {
			return new Netgsm;
		});


		$this->app->alias('Santral', 'Brkphp\Netgsm\Santral');
		$this->app->alias('Sms', 'Brkphp\Netgsm\Sms');
	}
}
