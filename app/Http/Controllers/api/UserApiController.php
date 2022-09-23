<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function index()
    {
        $users = User::all();
        if (!$users) {
            return response()->json([
                'status' => 'false',
                'message' => 'Fail',
                'data' => $users,
            ]);
        }
        return response()->json([
            'status' => 'true',
            'message' => 'Success',
            'data' => $users,
        ]);
    }
}
