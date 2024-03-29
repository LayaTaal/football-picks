<?php

use App\Http\Controllers\AdminGameController;
use App\Http\Controllers\AdminTeamController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminRoundController;
use App\Http\Controllers\AdminSeasonController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware( 'guest' )->group( function () {
    // Temporarily blocking registration while season is in progress
    if ( env( 'APP_ENV', 'production' ) === 'local' ) {
        Route::get( 'register', function () {
            return redirect( 'login' );
        } );
    } else {
        Route::get( 'register', [ RegisteredUserController::class, 'create' ] )
             ->name( 'register' );
    }

    Route::post( 'register', [ RegisteredUserController::class, 'store' ] );

    Route::get( 'login', [ AuthenticatedSessionController::class, 'create' ] )
         ->name( 'login' );

    Route::post( 'login', [ AuthenticatedSessionController::class, 'store' ] );

    Route::get( 'forgot-password', [ PasswordResetLinkController::class, 'create' ] )
         ->name( 'password.request' );

    Route::post( 'forgot-password', [ PasswordResetLinkController::class, 'store' ] )
         ->name( 'password.email' );

    Route::get( 'reset-password/{token}', [ NewPasswordController::class, 'create' ] )
         ->name( 'password.reset' );

    Route::post( 'reset-password', [ NewPasswordController::class, 'store' ] )
         ->name( 'password.update' );
} );

Route::middleware( 'auth' )->group( function () {
    Route::get( 'verify-email', [ EmailVerificationPromptController::class, '__invoke' ] )
         ->name( 'verification.notice' );

    Route::get( 'verify-email/{id}/{hash}', [ VerifyEmailController::class, '__invoke' ] )
         ->middleware( [ 'signed', 'throttle:6,1' ] )
         ->name( 'verification.verify' );

    Route::post( 'email/verification-notification', [ EmailVerificationNotificationController::class, 'store' ] )
         ->middleware( 'throttle:6,1' )
         ->name( 'verification.send' );

    Route::get( 'confirm-password', [ ConfirmablePasswordController::class, 'show' ] )
         ->name( 'password.confirm' );

    Route::post( 'confirm-password', [ ConfirmablePasswordController::class, 'store' ] );

    Route::post( 'logout', [ AuthenticatedSessionController::class, 'destroy' ] )
         ->name( 'logout' );
    Route::get( 'profile', [ UserProfileController::class, 'index' ] );
    Route::patch( 'profile', [ UserProfileController::class, 'update' ] );
} );

Route::middleware( 'can:admin' )->group( function () {
    Route::resource( 'admin/seasons', AdminSeasonController::class );
    Route::resource( 'admin/rounds', AdminRoundController::class );
    Route::resource( 'admin/teams', AdminTeamController::class )->except( 'show' );
    Route::resource( 'admin/games', AdminGameController::class )->except( 'show' );
    Route::get( 'admin/settings/', [ AdminSettingController::class, 'index' ] );
    Route::patch( 'admin/settings/', [ AdminSettingController::class, 'update' ] );

    Route::get( 'admin/users', [ AdminUserController::class, 'index' ] );
    Route::delete( 'admin/user/{id}', [ AdminUserController::class, 'destroy' ] );
} );
