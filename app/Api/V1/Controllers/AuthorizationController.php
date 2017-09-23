<?php

namespace App\Api\V1\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthorizationController extends Controller
{
    protected $guard = 'api';

    public function signUp(Request $request)
    {
        $user = new User($request->all());
        if (!$user->save()) {
            throw new HttpException(500);
        }
        $token = Auth::guard($this->guard)->login($user);

        return response()->json([
            'status' => 'ok',
            'token' => $token,
        ], 201);
    }

    /**
     * 获取token.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function token(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        try {
            if (!$token = Auth::guard($this->guard)->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /**
     * @return mixed
     */
    public function refershToken()
    {
        $token = Auth::guard($this->guard)->refresh();

        return $this->response->array(compact('token'));
    }

    /**
     * 个人信息.
     *
     * @return User|null
     */
    public function me()
    {
        return Auth::guard('api')->user();
    }

    /**
     * 退出.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard($this->guard)->logout();

        return response()->json(['status' => 'ok']);
    }
}
