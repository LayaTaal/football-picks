<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Factory;

class SettingServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return \Illuminate\Support\Collection|void
     */
    public function boot( Factory $cache, Setting $settings ) {
        if ( ! App::runningInConsole() ) {
            return collect([]);
        }

        $settings = $cache->remember( 'settings', 60, function () use ( $settings ) {
            return $settings->pluck( 'value', 'name' )->all();
        } );

        config()->set( 'settings', $settings );
    }

}
