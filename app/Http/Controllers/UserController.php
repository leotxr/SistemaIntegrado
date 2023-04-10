<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate('10');
        $permissions = Permission::all();



        return view('users.usuarios', compact('users', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();

        return view('dashboard', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $permissions = Permission::all();



        return view('users.edit', compact('user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
        $user = User::where(['id' => $id])->update([
            'name' => $request->name,
            'email' => $request->email ?? NULL,
        ]);
        */


        //$sign = $request->file('signature')->store("storage/user_docs/$id/signature", ['disk' => 'my_files']);


        $update = User::where(['id' => $id])->update([
            'name' => $request->name ?? NULL,
            'lastname' => $request->lastname ?? NULL,
            'email' => $request->email ?? NULL,
            //'profile_img' => $path ?? NULL,
            //'signature_'
        ]);

        $user = User::find($id);

        if ($request->file('profile_img')) {
            $path = $request->file('profile_img')->store("storage/user_docs/$id/profile_photo", ['disk' => 'my_files']);
            $user->profile_img = $path;
        }

        if ($request->file('signature')) {
            $sign = $request->file('signature')->store("storage/user_docs/$id/signature", ['disk' => 'my_files']);
            $user->signature = $sign;
        }
        $user->syncPermissions("$request->permission");
        $user->save();

        if ($update)
            return redirect('users')->with('message', 'Usuário alterado com sucesso!');
    }

    public function passwordUpdate(Request $request, $id)
    {
        $validated = $request->validateWithBag('updatePassword', [
            #'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = User::find($id);
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
