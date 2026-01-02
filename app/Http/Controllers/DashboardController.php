<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\ShipmentRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $stats = [
                'pending_requests' => ShipmentRequest::where('status', 'Pending')->count(),
                'packages' => Package::count(),
                'delivered' => Package::where('status', 'Delivered')->count(),
            ];

            $recentRequests = ShipmentRequest::latest()->take(5)->get();
            $recentPackages = Package::with('request')->latest()->take(5)->get();

            return view('dashboard.admin', compact('stats', 'recentRequests', 'recentPackages'));
        }

        $requests = ShipmentRequest::with('package')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard.user', compact('requests'));
    }
}
