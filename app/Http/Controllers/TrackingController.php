<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Notifications\PackageStatusChanged;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function search(Request $request)
    {
        $trackingNumber = $request->get('tracking_number');
        $package = null;
        $recent = Package::latest()->take(4)->get();

        if ($trackingNumber) {
            $package = Package::with(['trackingUpdates' => fn ($q) => $q->latest()])
                ->where('tracking_number', $trackingNumber)
                ->first();
        }

        return view('tracking.search', compact('package', 'trackingNumber', 'recent'));
    }

    public function storeUpdate(Request $request, Package $package)
    {
        $data = $request->validate([
            'status' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $package->update(['status' => $data['status']]);
        $package->trackingUpdates()->create($data);


        return redirect()->route('packages.index')->with('status', 'Tracking updated.');
    }
}
