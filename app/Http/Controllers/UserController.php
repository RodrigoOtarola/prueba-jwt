<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * RETORNAMOS LISTA DE USUARIOS
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function list(){
        $users = User::all();

        return view('userIndex',compact('users'));
    }
    public function create(){
        return view('createUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
        ]);

        return view('createuser');
    }

    /**
     * USER POR ID.
     */
    public function show($id)
    {
        $user= User::findOrFail($id);

        return response()->json($user);
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
