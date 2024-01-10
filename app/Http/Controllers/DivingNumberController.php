<?php

namespace App\Http\Controllers;
use App\Models\DivingNumberModel;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivingNumberController extends Controller
{
    public function index(): View
    {
        if (session()->has('user')) {
            $userId = session('user')->US_ID; // Récupérer l'ID de l'utilisateur connecté
    
            // Faire quelque chose avec l'utilisateur ou son ID
        } else {
            $userId = NULL;
        }

        $dateDives = DivingNumberModel::join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
        ->join('car_diving_session','car_registration.ds_code','=','car_diving_session.ds_code')
        ->join('car_diving_location','car_diving_session.dl_id','=','car_diving_location.dl_id')
        ->join('car_role_attribution','car_user.us_id','=','car_role_attribution.Us_id')
        ->join('car_role','car_role_attribution.rol_code','=','car_role.rol_code')

        ->where('car_user.US_ID',$userId)
        ->get();


        $usersCount = DivingNumberModel::join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
            ->join('car_diving_group', function ($dg) {
                $dg->on('car_registration.ds_code', '=', 'car_diving_group.ds_code')
                    ->on('car_registration.dg_number', '=', 'car_diving_group.dg_number');
            })
            ->join('car_diving_session','car_registration.ds_code','=','car_diving_session.ds_code')
            ->where('car_diving_session.ds_date','>=',date("Y").'-00-00')
            ->where('car_user.US_ID', $userId)
            ->orderBy('ds_date','desc')
            ->count();
        $usersCount = 99 - $usersCount ;

        return view('diveractivities', compact('usersCount'), ['dates' => $dateDives]);
    }

    public function allIndex(Request $request): View
    {

        if($request['afterthe'] != '' and $request['beforethe'] != ''){
            return DivingNumberController::afterAndBefore($request['afterthe'], $request['beforethe']);
        }
        if($request['afterthe'] != '' and $request['beforethe'] == ''){
            return DivingNumberController::after($request['afterthe']);
        }
        if($request['afterthe'] == '' and $request['beforethe'] != ''){
            return DivingNumberController::before($request['beforethe']);
        }

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

    public function afterAndBefore(string $after, string $before): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, car_user.US_FIRST_NAME, car_user.US_NAME')
        ->join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
        ->join('car_diving_session', 'car_registration.DS_CODE', '=', 'car_diving_session.DS_CODE')
        ->where('car_diving_session.DS_DATE', '>=', $after)
                ->where('car_diving_session.DS_DATE', '<=', $before)
        ->groupBy('car_user.us_id', 'car_user.US_NAME', 'car_user.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }


    public function after(string $after): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, car_user.US_FIRST_NAME, car_user.US_NAME')
        ->join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
        ->join('car_diving_session', 'car_registration.DS_CODE', '=', 'car_diving_session.DS_CODE')
        ->where('car_diving_session.DS_DATE', '>=', $after)
        ->groupBy('car_user.us_id', 'car_user.US_NAME', 'car_user.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }


    public function before(string $before): View
    {


        $usersDatas = DivingNumberModel::selectRaw('COUNT(*) as aggregate, car_user.US_FIRST_NAME, car_user.US_NAME')
        ->join('car_registration', 'car_user.us_id', '=', 'car_registration.us_id')
        ->join('car_diving_session', 'car_registration.DS_CODE', '=', 'car_diving_session.DS_CODE')
        ->where('car_diving_session.DS_DATE', '<=', $before)
        ->groupBy('car_user.us_id', 'car_user.US_NAME', 'car_user.US_FIRST_NAME')
        ->get();


        return view('alldiversactivities', ['datas' => $usersDatas]);

    }

}
