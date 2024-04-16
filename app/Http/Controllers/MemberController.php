<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function handleCreate(Request $request)
    {
        $reqData = $request->validate([
            'nama' => 'required|min:3|max:100',
            'alamat' => 'required|min:3|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tlp' => 'required|min:10|max:15',
        ]);

        Auth::user()->outlet->member()->create($reqData);

        return back();
    }
}
