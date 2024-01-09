<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;


class DiversBySession extends Controller
{
    public function getDiversBySession($ds_code): View
    {
        $request = User::selectRaw('US_NAME, US_FIRST_NAME')
        ->join('CAR_USER','CAR_USER.US_ID','=','CAR_DIVING_SESSION.US_ID')
        ->get();

        return view('diversinsessions', ['datas' => $request]);
    }

    public function getAllSessions(): View
    {
        $sessions = User::select('US_NAME', 'US_FIRST_NAME', 'DS_CODE')
        ->join('CAR_REGISTRATION', 'CAR_REGISTRATION.US_ID', '=', 'CAR_USER.US_ID')
        ->get();
    
    return view('diversinsessions', ['sessions' => $sessions]);
    
    }
}
