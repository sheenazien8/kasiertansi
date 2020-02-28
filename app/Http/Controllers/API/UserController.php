<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailAfterRegistration;
use App\Models\Owner;
use App\Models\Permission;
use App\Models\User;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
            if ($user->status) {
                if ($user->userable_type == "App\Models\Owner") {
                    $permissions = Permission::all();
                } elseif ($user->userable_type == "App\Models\Employee") {
                    if ($user->userable->roles->first()) {
                        $permissions = $user->userable->roles->first()->permissions;
                    }else{
                        return response()->json([
                            'message'=>'Karyawan Belum Punya Jabatan segera hubungi admin Jabatan'
                        ], 401);
                    }
                }

                return response()->json(
                    [
                        'token' =>  $user->createToken('MyApp')->accessToken,
                        'token_type' => 'Bearer',
                        'expires_in' => 3600,
                    ],
                    $this->successStatus
                );
            } else {
                return response()->json([
                    'message'=>'Akun belum diferivikasi'
                ], 401);
            }
        } else {
            return response()->json([
                'error'=>'Password dan email tidak cocok'
            ], 401);
        }
    }

    private function guard()
    {
        return Auth::Guard('api');
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
            'password_confirmation' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['join_date'] = Carbon::now()->format('Y-m-d');
        $owner = new Owner();
        $owner->fill($input);
        $owner->save();
        $input['verification_code'] = Carbon::now()->format('mdhis').$this->generateRandomString();
        $user = new User();
        $user->fill($input);
        $user->userable()->associate($owner);
        $user->save();
        if ($user->userable_type == "App\Models\Owner") {
            $permissions = Permission::all();
        } elseif ($user->userable_type == "App\Models\Employee") {
            $permissions = $user->userable->roles->first()->permissions;
        }
        $success['user'] =  $user->load('userable');
        $success['url'] = env('APP_URL').'/login?user_id='.$user->id.'&verification_code='.$user->verification_code;

        Mail::to($user->email)->send(new SendEmailAfterRegistration($success));

        return response()->json([
            'success'=>$success
        ], $this->successStatus);
    }
    public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
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

    public function activatingAccount(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            if ($user->verification_code == $request->verification_code) {
                $user->status = 1;
                $user->email_verified_at = Carbon::now()->format('Y-m-d h:i:s');
                $user->save();

                return Response([
                    'code' => 200,
                    'message' => 'Akun anda telah di aktifkan dan silahkan login'
                ], 200);
            }
        }
    }

    public function update(Request $request,User $user)
    {
        $user = Auth::user();
        if ($user->userable_type == "App\Models\Owner") {
            $model = $user->userable;
            $model->fill($request->json()->all());
            $model->save();
        } elseif ($user->userable_type == "App\Models\Employee") {
            $model = $user->userable;
            $model->fill($request->json()->all());
            $model->save();
        }
        $user->fill($request->all());
        $user->save();
    }
}
