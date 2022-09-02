<?php

namespace App\Providers;

use App\Models\Setting;
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
     * @return void
     */
    public function boot( Factory $cache, Setting $setting ) {
        $setting = $cache->remember( 'settings', 60, function () use ( $setting ) {
            return $setting->pluck( 'value', 'name' )->all();
        } );

        config()->set( 'settings', $setting );
    }

}
