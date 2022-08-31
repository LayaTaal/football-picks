<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index() {
        return view( 'admin.users.index', [
            'users' => User::all(),
        ] );
    }

    public function destroy() {
        $user_id = request()->get( 'user' ) ?? 0;

        if ( ! $user_id ) {
            return null;
        }

        User::destroy( $user_id );

        return back()->with( 'success', 'User deleted successfully.' );
    }
}
