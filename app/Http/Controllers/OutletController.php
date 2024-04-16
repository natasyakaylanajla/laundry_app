<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OutletController extends Controller
{
    public function viewRegister()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $reqData = $request->validate([
            'outlet_nama' => 'required|min:3|max:100',
            'outlet_alamat' => 'required|min:3|max:100',
            'outlet_tlp' => 'required|min:10|max:15',
            'user_nama' => 'required|min:3|max:100',
            'user_username' => 'required|min:3|max:30',
            'user_password' => 'required|min:3',
        ]);
        
        if (User::where('username', $reqData['user_username'])->exists()) {
            return back()->withErrors([
                'user_username' => 'Username is existed',
            ]);
        }

        $outlet = Outlet::create([
            'nama' => $reqData['outlet_nama'],
            'alamat' => $reqData['outlet_alamat'],
            'tlp' => $reqData['outlet_tlp'],
        ]);

        $outlet->user()->create([
            'nama' => $reqData['user_nama'],
            'username' => $reqData['user_username'],
            'password' => Hash::make($reqData['user_password']),
        ]);

        return redirect()->route('viewLogin');
    }

    public function viewOutlet()
    {
        $outlet = Auth::user()->outlet;
        $admins = $outlet->user()->where('role', 'admin')->get();
        $cashiers = $outlet->user()->where('role', 'kasir')->get();
        $owners = $outlet->user()->where('role', 'owner')->get();
        $packages = $outlet->package()->get();

        return view('dashboard.outlet.index', [
            'outlet' => $outlet,
            'admins' => $admins,
            'cashiers' => $cashiers,
            'owners' => $owners,
            'packages' => $packages,
        ]);
    }

    public function handleUpdate(Request $request)
    {
        $reqData = $request->validate([
            'nama' => 'required|min:3|max:100',
            'alamat' => 'required|min:3|max:100',
            'tlp' => 'required|min:10|max:15',
        ]);

        Auth::user()->outlet->update($reqData);

        return back();
    }
}
