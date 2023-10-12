<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\BookmarkService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BookmarkController extends BaseController
{

    public function create(Request $request){
        $rv = BookmarkService::create($request);
        return response()->json($rv, 200);
    }

    public function list(Request $request){
        $rv = BookmarkService::list($request);
        return response()->json($rv, 200);
    }

    public function single(Request $request){
        $rv = BookmarkService::single($request);
        return response()->json($rv, 200);
    }

    public function update(Request $request){
        $rv = BookmarkService::update($request);
        return response()->json($rv, 200);
    }

    public function delete(Request $request){
        $rv = BookmarkService::delete($request);
        return response()->json($rv, 200);
    }

}
