<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Resources\ResourceUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $validateUser = validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Erreure de validation',
                    'errors' => $validateUser->errors()
                ], 400);
            }
            if (!Auth::attempt($request->only((['email', 'password'])))) {
                return response()->json([
                    'status' => false,
                    'message' => 'email ou mot de passe incorrecte'
                ], 401);
            }
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'user' => new ResourceUser($user),
                'token' => $user->createToken("API Token")->plainTextToken,
                'status' => true,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th
            ], 500);
        }
    }
    public function logout($id)
    {
        $user = User::find($id);
        Auth::logout($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Deconnection reuisie  '
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
