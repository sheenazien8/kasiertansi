<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Parser;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            if ($user->userable_type == "App\Models\Owner") {
                $permissions = Permission::all();
            } elseif ($user->userable_type == "App\Models\Employee") {
                $permissions = $user->userable->roles->first()->permissions;
            }
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] =  $user->load('userable');
            $success['permissions'] =  $permissions->pluck('name');
            return response()->json(
                ['success' => $success,],
                $this->successStatus
            );
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        if ($user->userable_type == "App\Models\Owner") {
            $permissions = Permission::all();
        } elseif ($user->userable_type == "App\Models\Employee") {
            $permissions = $user->userable->roles->first()->permissions;
        }
        return response()->json([
            'user' => $user->load('userable'),
            'permissions' => $permissions->pluck('name')
        ], $this->successStatus);
    }

    public function logout(Request $request)
    {
        $value = $request->bearerToken();
        Cache::forget('owner-cache');
        if ($value) {
            $id = (new Parser())->parse($value)->getHeader('jti');
            $revoked = DB::table('oauth_access_tokens')->where('id', '=', $id)->delete();
        }

        return Response([
            'code' => 200,
            'message' => 'You are successfully logged out'
        ], 200);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
