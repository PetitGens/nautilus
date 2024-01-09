<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

use App\Models\User;

Route::get('/login', function ()
{
    return view('login', ['wrongPassword' => false]);
});

Route::post('/login', function (Request $request)
{
    $request->validate([
        'mail' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('US_EMAIL', $request->mail)->first();
    if($user->checkPassword($request->password))
    {
        return redirect('/'); // TODO: Redirect to the user's hub page
    }
    else
    {
        return view('login', ['wrongPassword' => true]);
    }
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function()
{
    return view('test', ['user' => User::find(1)]);
});

