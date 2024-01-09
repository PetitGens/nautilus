<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\DivingNumberModel;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivingNumberController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        if ($user) {
            $userId = $user->US_ID;
        }else{
            $userId = 1;
        }
        
        $dives = 99;
        $usersCount = DivingNumberModel::join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
            ->join('car_diving_group', function ($dg) {
                $dg->on('car_registration.ds_code', '=', 'car_diving_group.ds_code')
                    ->on('car_registration.dg_number', '=', 'car_diving_group.dg_number');
            })
            ->where('car_user.US_ID', $userId)
            ->count();
        $usersCount = 99 - $usersCount;

        return view('diveractivities', compact('usersCount'));
    }

    public function allIndex(): View
    {
        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, car_user.US_FIRST_NAME, car_user.US_NAME')
    ->join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
    ->join('car_diving_group', function ($join) {
        $join->on('car_registration.ds_code', '=', 'car_diving_group.ds_code')
            ->on('car_registration.dg_number', '=', 'car_diving_group.dg_number');
    })
    ->groupBy('car_user.us_id', 'car_user.US_NAME', 'car_user.US_FIRST_NAME')
    ->get();

        return view('alldiversactivities', ['datas' => $usersDatas]);

    }

    public function filteredSearch(DateTime $after, DateTime $before): View
    {
        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, car_user.US_FIRST_NAME, car_user.US_NAME')
    ->join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
    ->join('car_diving_session', 'car_registration.ds_code', '=', 'car_diving_session.ds_code')
    ->where('car_divin_session.ds_date' > $after)
    ->where('car_divin_session.ds_date' < $before)
    ->groupBy('car_user.us_id')
    ->get();

        return view('alldiversactivities', ['datas' => $usersDatas]);
    }

}

