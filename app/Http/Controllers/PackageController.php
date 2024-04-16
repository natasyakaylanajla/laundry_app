<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function handleCreate(Request $request)
    {
        $reqData = $request->validate([
            'nama_paket' => 'required|min:3|max:100',
            'jenis' => 'required|in:kiloan,selimut,bed_cover,kaos,lain',
            'harga' => 'required|integer|min:1',
        ]);

        Auth::user()->outlet->package()->create($reqData);

        return back();
    }

    public function handleUpdate(Package $package, Request $request)
    {
        $reqData = $request->validate([
            'nama_paket' => 'required|min:3|max:100',
            'jenis' => 'required|in:kiloan,selimut,bed_cover,kaos,lain',
            'harga' => 'required|integer|min:1',
        ]);

        $package->update($reqData);

        return back();
    }

    public function handleDelete(Package $package)
    {
        $package->delete();

        return back();
    }
}
