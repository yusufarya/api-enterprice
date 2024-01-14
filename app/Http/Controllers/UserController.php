<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        if(User::where('username', $data['username'])->count() == 1) {
            // ada data di database 
            throw new HttpResponseException(response([
                'message' => 'failed',
                'error' => 'Username already registered'
            ], 400));
        }
        
        if(User::where('email', $data['email'])->count() == 1) {
            // ada data di database 
            throw new HttpResponseException(response([
                'message' => 'failed',
                'error' => 'Email already registered'
            ], 400));
        }

        $get_id_user = DB::table('users')->max('id_user');
        // dd($get_id_user);
        if(!$get_id_user) {
            $generate_id_user = date('ymd').'001';
        } else {
            $lastId = substr($get_id_user, -3)+1;
            $lastId = sprintf('%03d', $lastId);
            $generate_id_user = date('ymd').$lastId;
        }
        $id_user = $request->input('role_id').$generate_id_user;

        $user = new User($data);
        $user->id_user = $id_user;
        $user->password = Hash::make($data['password']);
        $user->save();
        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function login(UserLoginRequest $request): UserResource
    {
        $data = $request->validated();

        $user = User::where('username', $data['username'])->orWhere('email', $data['username'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response([
                'message' => 'failed',
                'errors' => [
                    'Username or Password is wrong'
                ]
            ], 401));
        }

        $getPeriod = DB::table('periods')->where('id_period', $data['period_id'])->first();
        if(!$getPeriod) {
            throw new HttpResponseException(response([
                'message' => 'failed',
                'errors' => [
                    'Period not found.'
                ]
            ], 401));
        }

        $token = Str::uuid()->toString();
        User::where('username', $data['username'])->orWhere('email', $data['username'])->update(['token' => $token, 'last_login' => date('Y-m-d H:i:s')]);
        $user->token = $token;

        return new UserResource($user);
    }

    public function get(Request $request): UserResource
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request): UserResource
    {
        $data = $request->validated();
        $user = Auth::user();

        if (isset($data['name'])) {
            $user->name = $data['name'];
        }
        if (isset($data['username'])) {
            $user->username = $data['username'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        if (isset($data['gender'])) {
            $user->gender = $data['gender'];
        }
        if (isset($data['place_of_birth'])) {
            $user->place_of_birth = $data['place_of_birth'];
        }
        if (isset($data['date_of_birth'])) {
            $user->date_of_birth = $data['date_of_birth'];
        }
        if (isset($data['no_telp'])) {
            $user->no_telp = $data['no_telp'];
        }
        if (isset($data['address'])) {
            $user->address = $data['address'];
        }

        $user->save();
        return new UserResource($user);
    }

    public function logout(Request $request): JsonResponse {
        $user = Auth::user();
        $user->token = null;
        $user->save();

        return response()->json([
            "message" => 'success'
        ])->setStatusCode(200);
    }
    
}
