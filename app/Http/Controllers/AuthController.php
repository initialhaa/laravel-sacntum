<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $datauser = new User();

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json(
                [
                    'status' => false,
                    'massage' => 'proses validasi gagal',
                    'data' => $validator->errors()
                ], 401
                );
        }      
                $datauser->name = $request->name;
                $datauser->email = $request->email;
                $datauser->password = Hash::make( $request->password);
                $datauser->save();

            return response()->json(
            [
                'status' => true,
                'massage' => 'Berhasil ditambahkan'
            ], 200
            );
    }

    public function loginUser(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json(
                [
                    'status' => false,
                    'massage' => 'proses login gagal',
                    'data' => $validator->errors()
                ], 401
                );
        } 
        if(!Auth::attempt($request->only(['email', 'password'])))
        {
            return response()->json(
                [
                    'status' => false,
                    'status' => 'Masukan yang benar!'
                ], 401
                );
        }

        $datauser = User::where('email', $request->email)->first();

        return response()->json(
            [
                'status' => true,
                'message' => 'Berhasil Login',
                'tokern' => $datauser->createToken('api-siswa')->plainTextToken
            ]
            );
    }

    public function login()
    {
        return response()->json(
            [
                'status' => true,
                'message' => 'tidak dapat di akses!'
            ], 401
            );
    }
        
}
