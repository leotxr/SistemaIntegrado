<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGroup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::paginate('10');
        //$permissions = Permission::all();



        return view('users.usuarios');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = UserGroup::all();
        $permissions = Permission::all();
        $roles = Role::all();

        return view('users.create', compact('groups', 'permissions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'user_group_id' => ['required'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'user_group_id' => $request->user_group_id,
            'password' => Hash::make($request->password),

        ])->assignRole("$request->role");


        if ($request->file('photo')) {
            $user = User::find($user->id);
            $path = $request->file('photo')->store("storage/user_docs/$user->id/profile_photo", ['disk' => 'my_files']);
            $user->profile_img = $path;
            $user->save();
        };


        if ($user)
        return back()->with('status', 'user-created');

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
        $roles = Role::all();
        $groups = UserGroup::all();



        return view('users.edit', compact('user', 'permissions', 'roles', 'groups'));
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

        $update = User::where(['id' => $id])->update([
            'name' => $request->name ?? NULL,
            'lastname' => $request->lastname ?? NULL,
            'email' => $request->email ?? NULL,
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

        if ($update)
            return back()->with('status', 'user-updated');
    }

    public function setUserRole(Request $request, $id)
    {
        $user = User::find($id);
        $user->assignRole("$request->role");

        if ($user->save())
            return back()->with('status', 'permission-updated');
        else
            return back()->with('error', 'Erro ao salvar');
    }

    public function removeUserRole(Request $request, $id)
    {
        $user = User::find($id);
        $user->removeRole("$request->role");

        if ($user->save())
            return back()->with('status', 'permission-updated');
        else
            return back()->with('error', 'Erro ao salvar');
    }

    public function setUserGroup(Request $request, $id)
    {
        $user = User::find($id);
        $user->user_group_id = $request->group;

        if ($user->save())
            return back()->with('status', 'group-updated');
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
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'Usuário excluído com sucesso!');
    }
}
