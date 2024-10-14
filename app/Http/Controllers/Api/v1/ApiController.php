<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\UsersAuthMobile;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // ************************************************************************
    // Проверка токена
    public static function checkToken(Request $request): bool
    {
        return UsersAuthMobile::whereBearer($request->bearerToken())->first() ? true : false;
    }
}
