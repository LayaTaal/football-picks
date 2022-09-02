<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\Season;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Factory;

class AdminSettingController extends Controller {

    /**
     * todo: Need to add error handling when no active season or round
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $settings = config( 'settings' );

        return view( 'admin/settings/index', [
            'settings'      => $settings,
            'active_season' => Season::findOrFail( $settings['active_season'] ),
            'active_round'  => Round::findOrFail( $settings['active_round'] ),
            'seasons'       => Season::all(),
            'rounds'        => Round::where( 'season_id', $settings['active_season'] )->get(),
        ] );
    }

    public function update( Request $request, Setting $setting, Factory $cache ) {
        $attributes = request()->validate( [
            'active_season' => [ 'required' ],
            'active_round'  => [ 'required' ],
        ] );

        $active_season = Setting::where( 'name', 'active_season' )->first();
        $active_round  = Setting::where( 'name', 'active_round' )->first();

        $active_season->update( [ 'value' => $attributes['active_season'] ] );
        $active_round->update( [ 'value' => $attributes['active_round'] ] );
        $cache->forget( 'settings' );

        return redirect( '/admin/settings/' )->with( 'success', 'Settings updated successfully.' );
    }

}
