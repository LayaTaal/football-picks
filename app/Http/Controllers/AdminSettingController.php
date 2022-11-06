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

    public function update( Request $request, Factory $cache ) {
        $active_season         = Setting::where( 'name', 'active_season' )->first();
        $active_round          = Setting::where( 'name', 'active_round' )->first();
        $daylight_savings_time = Setting::where( 'name', 'daylight_savings_time' )->first();

        if ( $request->input( 'active_season' ) ) {
            $active_season->value = $request->input( 'active_season' );
            $active_season->save();
        }

        if ( $request->input( 'active_round' ) ) {
            $active_round->value = $request->input( 'active_round' );
            $active_round->save();
        }

        dd(
            [
                'model'   => $daylight_savings_time,
                'request' => $request->input( 'daylight_savings_time' ),
            ]
        );

        if ( $daylight_savings_time ) {
            $daylight_savings_time->value = $request->input( 'daylight_savings_time' ) === "true" ? 1 : 0;
            $daylight_savings_time->save();
        } else {
            $setting        = new Setting;
            $setting->name  = "daylight_savings_time";
            $setting->value = $request->input( 'daylight_savings_time' ) === "true" ? 1 : 0;
            $setting->save();
        }

        $cache->forget( 'settings' );

        return redirect( '/admin/settings/' )->with( 'success', 'Settings updated successfully.' );
    }

}
