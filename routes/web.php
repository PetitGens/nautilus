<?php

use App\Http\Controllers\DivesList;
use App\Models\DivingSession;
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
use App\Models\DivingLocation;
use App\Models\Boat;
use App\Models\Prerogative;


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
    if($user == null)
    {
        return view('login', ['wrongPassword' => true]);
    }
    if($user->checkPassword($request->password))
    {
        return redirect('/'); // TODO: Redirect to the user's hub page
    }
    else
    {
        return view('login', ['wrongPassword' => true]);
    }
});

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/dives', [DivesList::class, 'index']);

Route::get('/test', function()
{
    return view('test', ['user' => User::find(1)]);
});

Route::get('/create/dive', function()
{
    return view('create_dive', ['locations' => DivingLocation::all(),  'boats' => Boat::all(), 'levels' => Prerogative::all(), 'users' => User::all()]);
});
