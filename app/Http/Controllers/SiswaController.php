<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::orderBy('name')->get();
        return response()->json(
            [
                'status' => true,
                'message' => 'Data di temukan',
                'data' => $data
            ],200
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Siswa();
        $rules = [
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return response()->json(
                [
                    'status'=>false,
                    'message'=>'gagal memasukan',
                    'data' =>$validator->errors()
                ], 401
                );
        }
        $data->name = $request->name;
        $data->nim = $request->nim;
        $data->email = $request->email;
        $data->save();

    return response()->json(
    [
        'status' => true,
        'massage' => 'Berhasil ditambahkan'
    ], 200
    );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
