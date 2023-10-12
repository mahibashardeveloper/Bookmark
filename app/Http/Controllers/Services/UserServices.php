<?php

namespace App\Http\Controllers\Services;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserServices extends BaseController
{

    public static function register($request)
    {
        try{
            $validator = Validator::make(
                $request->all(),
                [
                    'company_name' => 'required',
                    'full_name' => 'required',
                    'email' => 'required|unique:users,email',
                    'password' => 'required|min:6|confirmed',
                ]
            );
            if($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $admin = new User();
            $admin->company_name = $request->company_name;
            $admin->full_name = $request->full_name;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->avatar = $request->avatar ?? null;
            $admin->save();
            return ['status' => 200, 'msg' => 'Registration Successfully Completed']; }
        catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function login($request)
    {
        try{
            $validator =  Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $credential = ['email' => $request->email, 'password' => $request->password];
            if(Auth::guard('users')->attempt($credential, $request->remember)){
                return ['status' => 200, 'data' => Auth::guard('users')->user()];
            } else {
                return ['status' => 500, 'errors' => ['error' => 'Invalid Credentials! Please Try Again']];
            }
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function forget($request)
    {
        try {
            $input = $request->input();
            $validator = Validator::make($input, [
                'email' => 'required|email'
            ]);
            if($validator -> fails()) {
                return ['status' => 500, 'error' => $validator->errors()];
            }
            $userInfo = User::where('email', $input['email'])->first();
            if($userInfo == null) {
                return ['status' => 500, 'error' => ['email' => ['Email not founded']]];
            }
            $reset_code = rand(100000, 999999);
            $userInfo->reset_code = $reset_code;
            $userInfo->save();
            Mail::send('emails.forgot', ['userInfo' => $userInfo], function ($message) use ($userInfo){
                $message->to($userInfo['email'], $userInfo['name'])->subject(env('MAIL_FROM_NAME'). ': Password reset code');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            return ['status' => 200, 'msg' => 'A reset code has been send to your email'];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }

    public static function reset($request)
    {
        try {
            $input = $request->input();
            $validator = Validator::make($input, [
               'email' => 'required|email',
               'code' => 'required',
               'password' => 'required|min:6|confirmed',
            ]);
            if ($validator->fails()) {
                return ['status' => 500, 'error' => $validator -> errors()];
            }
            $userInfo = User::where(['email' => $input['email'], 'reset_code' => $input['code']])->first();
            if($userInfo == null){
                return ['status' => 500, 'error' => ['code' => ['Invalid request. Kindly check your reset code please']]];
            }
            if(Hash::check($input['password'], $userInfo['password'])){
                return ['status' => 500, 'error' => ['password' => ['Password repetition is not allowed. Please try another password']]];
            }
            $userInfo->password = bcrypt($input['password']);
            $userInfo->reset_code = null;
            $userInfo->save();
            return ['status' => 200, 'msg' => 'The password has been reset successfully.'];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }

    public static function profile_details($request)
    {
        try {
            $user_id = Auth::guard('users')->id();
            $user = User::with('media')->where('id', $user_id)->first();
            return ['status' => 200, 'data' => $user];
        }catch (\Exception $e ) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function profile_update($request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'company_name' => 'required',
                    'full_name' => 'required',
                    'email' => 'required|email',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $user = User::where('id', Auth::guard('users')->id())->first();
            $user->company_name = $request->company_name;
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->avatar = $request->avatar ?? null;
            $user->save();
            return ['status' => 200,];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function profile_password($request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => 'required|min:6|confirmed',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $user = User::where('id', Auth::guard('users')->id())->first();
            $user->password = bcrypt($request->password);
            $user->save();
            return ['status' => 200,];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function profile_logout($request)
    {
        try {
            Auth::guard('users')->logout();
            return ['status' => 200, 'msg' => 'logout successfully'];
        } catch(\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

}
