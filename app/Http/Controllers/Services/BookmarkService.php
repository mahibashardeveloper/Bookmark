<?php

namespace App\Http\Controllers\Services;

use App\Models\Bookmark;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookmarkService extends BaseController
{

    public static function create($request){
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'bookmark_name' => 'required',
                    'bookmark_url' => 'required',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $user_id = Auth::guard('users')->id();
            $user = new Bookmark();
            $user -> user_id = $user_id;
            $user -> bookmark_name = $request->bookmark_name;
            $user -> bookmark_url = $request->bookmark_url;
            $user -> save();
            return ['status' => 200, 'msg' => 'data has been saved successfully'];
        }catch (\Exception $e){
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function list($request)
    {
        try {
            $user_id = Auth::guard('users')->id();
            $date = $request->date ?? 'all';
            $limit = $request->limit ?? 10;
            $keyword = $request->q ?? '';
            $results = Bookmark::where('user_id', $user_id)->orderBy('id', 'desc');
            if (isset($keyword) && !empty($keyword)) {
                $results->where(function ($q) use ($keyword) {
                    $q->where('bookmark_name', 'LIKE', '%' . $keyword . '%');
                    $q->orwhere('bookmark_url', 'LIKE', '%' . $keyword . '%');
                });
            }

            if (isset($date) && !empty($date)) {
                if($date == 'today'){
                    $results->whereDay('created_at', now()->day);
                }
                if($date == 'tomorrow'){
                    $results->whereDay('created_at', now()->day + 1);
                }
                if($date == 'week'){
                    $startDate = Carbon::today();
                    $endDate = Carbon::today()->addDays(7);
                    $results->whereBetween('created_at', [$startDate,$endDate]);
                }
                if($date == 'month'){
                    $currentMonth = date('m');
                    $results->whereRaw('MONTH(created_at) = ?',[$currentMonth]);
                }
            }

            $paginatedData = $results->paginate($limit);
            return ['status' => 200, 'data' => $paginatedData];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function single($request)
    {
        try {
            $user_id = Auth::guard('users')->id();
            $validator = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $bookmark = Bookmark::where('user_id', $user_id)->where('id', $request->id)->first();
            if($bookmark == null){
                return ['status' => 500, 'errors' => 'data not found'];
            }
            return ['status' => 200, 'data' => $bookmark];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function update($request)
    {
        try {
            $user_id = Auth::guard('users')->id();
            $validator = Validator::make(
                $request->all(),
                [
                    'bookmark_name' => 'required',
                    'bookmark_url' => 'required',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $bookmark = Bookmark::where('user_id', $user_id)->where('id', $request->id)->first();
            if($bookmark == null){
                return ['status' => 500, 'errors' => 'data not found'];
            }
            $bookmark->bookmark_name = $request->bookmark_name;
            $bookmark->bookmark_url = $request->bookmark_url;
            $bookmark->save();
            return ['status' => 200, 'msg' => 'data has been updated successfully.'];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function delete($request)
    {
        try {
            Bookmark::whereIn('id', $request->ids)->delete();
            return ['status' => 200, 'msg' => 'data has been deleted successfully'];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

}
