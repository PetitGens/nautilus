<?php

namespace App\Http\Controllers;

use App\Models\DivingSession;
use Illuminate\View\View;

class DivesBySiteList extends Controller
{
    public function index($site): View
    {
        $divesBySite = DivingSession::select('DS_CODE', 'car_diving_session.DL_ID', 'DS_DATE', 'DL_DEPTH', 'CAR_SCHEDULE', 'DL_NAME')
            ->join('car_diving_location', 'car_diving_session.DL_ID', '=', 'car_diving_location.DL_ID')
            ->where('DL_NAME', $site)
            ->get();
        return view('divesBySite', ['divesBySite' => $divesBySite]);
    }
}