<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Services\AdminServices;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{

    public function index(){
        return view('app.admin');
    }

    public function register(Request $request){
        $rv = AdminServices::register($request);
        return response()->json($rv, 200);
    }

    public function login(Request $request){
        $rv = AdminServices::login($request);
        return response()->json($rv, 200);
    }

    public function forget(Request $request){
        $rv = AdminServices::forget($request);
        return response()->json($rv, 200);
    }

    public function reset(Request $request){
        $rv = AdminServices::reset($request);
        return response()->json($rv, 200);
    }

    public function profile_details(Request $request){
        $rv = AdminServices::profile_details($request);
        return response()->json($rv, 200);
    }

    public function profile_update(Request $request){
        $rv = AdminServices::profile_update($request);
        return response()->json($rv, 200);
    }

    public function profile_password(Request $request){
        $rv = AdminServices::profile_password($request);
        return response()->json($rv, 200);
    }

    public function profile_logout(Request $request){
        $rv = AdminServices::profile_logout($request);
        return response()->json($rv, 200);
    }

}
