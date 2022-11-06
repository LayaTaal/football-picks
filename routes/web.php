<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/', function() {
    return view( 'welcome' );
} );

Route::get( '/dashboard', [ DashboardController::class, 'index' ] )->middleware( [ 'auth' ] )->name( 'dashboard' );
Route::patch( '/dashboard', [ DashboardController::class, 'update' ] )->middleware( [ 'auth' ] )->name( 'dashboard' );
Route::get( '/admin/settings', [ AdminSettingController::class, 'index' ] )->middleware( [ 'can:admin' ] );
Route::patch( '/admin/settings', [ AdminSettingController::class, 'update' ] )->middleware( [ 'can:admin' ] );

Route::get( '/admin', function () {
    return view( 'admin' );
} )->middleware( 'can:admin' )->name( 'admin' );

require __DIR__ . '/auth.php';
