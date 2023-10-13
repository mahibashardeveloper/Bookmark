<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{

    public function index(){
        return view('app.index');
    }

    public function register(Request $request){
        $rv = UserServices::register($request);
        return response()->json($rv, 200);
    }

    public function login(Request $request){
        $rv = UserServices::login($request);
        return response()->json($rv, 200);
    }

    public function forget(Request $request){
        $rv = UserServices::forget($request);
        return response()->json($rv, 200);
    }

    public function reset(Request $request){
        $rv = UserServices::reset($request);
        return response()->json($rv, 200);
    }

    public function profile_details(Request $request){
        $rv = UserServices::profile_details($request);
        return response()->json($rv, 200);
    }

    public function profile_update(Request $request){
        $rv = UserServices::profile_update($request);
        return response()->json($rv, 200);
    }

    public function profile_password(Request $request){
        $rv = UserServices::profile_password($request);
        return response()->json($rv, 200);
    }

    public function profile_logout(Request $request){
        $rv = UserServices::profile_logout($request);
        return response()->json($rv, 200);
    }

    public function userLogList(Request $request){
        $rv = UserServices::userLogList($request);
        return response()->json($rv, 200);
    }

}
