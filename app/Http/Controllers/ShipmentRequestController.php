<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentRequestFormRequest;
use App\Models\ShipmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Package;
use App\Notifications\PackageStatusChanged;

class ShipmentRequestController extends Controller
{
    public function index()
    {
        $requests = ShipmentRequest::with('package', 'user')->latest()->paginate(10);
        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store(ShipmentRequestFormRequest $request)
    {
        ShipmentRequest::create([
            'user_id' => Auth::id(),
            ...$request->validated(),
        ]);

        return redirect()->route('dashboard')->with('status', 'Request submitted for review.');
    }

    public function show(ShipmentRequest $shipment)
    {
        $shipment->loadMissing(['package', 'user']);
        $this->authorizeView($shipment);
        return view('requests.show', ['shipment' => $shipment]);
    }

    public function approve(ShipmentRequest $shipment)
    {
        $shipment->update(['status' => 'Accepted']);

        $package = Package::create([
            'request_id' => $shipment->id,
            'tracking_number' => strtoupper(Str::random(10)),
            'status' => 'Picked Up',
            'package_weight' => $shipment->package_weight,
            'sender_name' => $shipment->sender_name,
            'receiver_name' => $shipment->receiver_name,
        ]);

        

        return redirect()->route('requests.index')->with('status', 'Request accepted and package created (#'.$package->tracking_number.').');
    }

    public function deny(ShipmentRequest $shipment)
    {
        $shipment->update(['status' => 'Denied']);
        return redirect()->route('requests.index')->with('status', 'Request denied.');
    }

    protected function authorizeView(ShipmentRequest $shipmentRequest): void
    {
        if (Auth::user()->isAdmin()) {
            return;
        }

        abort_unless($shipmentRequest->user_id === Auth::id(), 403);
    }
}
