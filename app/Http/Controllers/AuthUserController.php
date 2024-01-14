<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthUserController extends Controller
{
    //
    function register(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:20|unique:users',
            'no_telp' => 'required|string|max:20',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'failed', 'errors' => $validator->errors()], 422);
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
        // dd($id_user);
        $user = new User();
        $user->id_user = $request->input('role_id').$generate_id_user;
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->gender = $request->input('gender');
        $user->no_telp = $request->input('no_telp');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->save();

        return response()->json(['message' => 'Registration is successfully'], 201);
    }

    function login(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'period_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'message' => $validator->errors()], 422);
        }

        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $email = $user['email'];
            // $token = Str::random(30);
            $token = Uuid::uuid4();
            
            $preiod_id = $request->input('period_id');
            $get_period = DB::table('periods')
            ->where('id_period', $preiod_id)
            ->first();
            
            if(!$get_period) {
                return response()->json(['status' => 'failed', 'message' => 'Period tidak ditemukan.'], 401);
            }
            
            User::where('email', $email)->update(['token' => $token, 'last_login' => date('Y-m-d H:i:s')]);
            
            $data = [
                'token' => $token, 
                'preiod_id' => $preiod_id,
                'current_year' => $get_period->year,
                'current_month' => $get_period->month
            ];
            
            return response()->json(['status' => 'success', 'message' => 'Logged in successfully', 'data' => $data]);
        }
        
        return response()->json(['status' => 'failed', 'message' => 'Email or Password is wrong.'], 401);
    }
    
    function logout()
    {
        // dd(Auth::check());
        User::where('token', '8b15aaea-8f88-47c4-b20c-0ec56e710631')->update(['token' => NULL, 'last_login' => date('Y-m-d H:i:s')]);
        Auth::logout();
        
        return response()->json(['status' => 'success', 'message' => 'You has been logged out'], 200);
    }
}
