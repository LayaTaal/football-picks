<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

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
     * @param  \App\Models\Setting  $setting
     *
     * @return void
     */
    public function boot( Setting $setting ): void {
//        $setting = $cache->remember( 'settings', 60, function () use ( $setting ) {
//            return $setting->pluck( 'value', 'name' )->all();
//        } );

        config()->set( 'settings', $setting->pluck( 'value', 'name' )->all() );
    }

}
