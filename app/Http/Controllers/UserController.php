<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $reqData = $request->validate([
            'username' => 'required|min:3|max:30',
            'password' => 'required|min:3',
        ]);

        if (Auth::attempt($reqData)) {
            $request->session()->regenerate();

            return redirect()->route('viewReport');
        }

        return back()->withErrors([
            'credential' => 'Username atau password anda salah'
        ]);
    }

    public function handleLogout()
    {
        Auth::logout();

        return redirect()->route('viewLogin');
    }

    public function handleCreate(Request $request)
    {
        $reqData = $request->validate([
            'nama' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:30',
            'password' => 'required|min:3',
            'role' => 'required|in:admin,kasir,owner',
        ]);

        if (User::where('username', $reqData['username'])->exists()) {
            return back()->withErrors([
                'username' => 'Username is existed',
            ]);
        }

        $reqData['password'] = Hash::make($reqData['password']);

        Auth::user()->outlet->user()->create($reqData);

        return back();
    }

    public function handleUpdate(User $user, Request $request)
    {
        $reqData = $request->validate([
            'nama' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:30',
            'password' => 'nullable|min:3',
        ]);

        if ($user->username != $reqData['username'] && User::where('username', $reqData['username'])->exists()) {
            return back()->withErrors([
                'username' => 'Username is existed',
            ]);
        }

        if ($reqData['password'] == null) {
            unset($reqData['password']);
        } else {
            $reqData['password'] = Hash::make($reqData['password']);
        }

        $user->update($reqData);

        return back();
    }

    public function handleDelete(User $user)
    {
        $user->delete();

        return back();
    }
}
