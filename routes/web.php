<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// routes for authentication

Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin@amdin.com',
        'password' => 'password'
    ];

    // if the user doesn't exist
    if (!Auth::attempt($credentials)) {
        $user = new \App\Models\User();

        $user->name     = "admin";
        $user->email    = $credentials['email'];
        $user->password = Hash::make($credentials['password']);

        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // ignore this error 
            $adminToken  =  $user->createToken('admin-token',  ['create', 'update', 'delete']);
            $updateToken =  $user->createToken('update-token', ['create', 'update']);
            $basicToken  =  $user->createToken('basic-token',  ['readonly']);

            // grapping the token hash

            return [
                'admin'  => $adminToken->plainTextToken,
                'udpate' => $updateToken->plainTextToken,
                'basic'  => $basicToken->plainTextToken,
            ];
        }
    }
});

require __DIR__ . '/auth.php';
