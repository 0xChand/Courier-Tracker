<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageUpdateRequest;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('request.user')->latest()->paginate(10);
        return view('packages.index', compact('packages'));
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(PackageUpdateRequest $request, Package $package)
    {
        $package->update($request->validated());
        return redirect()->route('packages.index')->with('status', 'Package updated.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')->with('status', 'Package deleted.');
    }
}
