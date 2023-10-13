<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function table()
    {
        $users = User::all();
        return view('user.table')->with('users', $users);
    }   

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            $name = 'name' => 'required',
            $email = 'email' => 'required',
            $role = 'role' => 'required',
            $password = bcrypt(substr($email, 0, 3) . substr($name, 0, 3))
        ]);

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $password,
        ]);

        return redirect()->route('user.table')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('user.table')->with('success', 'Data Berhasil Dihapus');
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('user.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            $name = 'name' => 'required',
            $email = 'email' => 'required',
            $role = 'role' => 'required',
            $password = 'password'
        ]);

        $password = $request->password;

        if(empty($password)){
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }
        else{
            $password = bcrypt($password);
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => $password
            ]);
        }


        return redirect()->route('user.table')->with('success', 'Data Berhasil Diedit');
    }
}
