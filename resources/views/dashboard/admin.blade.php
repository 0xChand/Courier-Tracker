@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')
<div class="grid gap-6">
    <div class="grid md:grid-cols-3 gap-4">
        <div class="card rounded-2xl p-4 border border-white/10">
            <div class="text-sm text-slate-300">Pending Requests</div>
            <div class="text-3xl font-semibold text-white">{{ $stats['pending_requests'] }}</div>
        </div>
        <div class="card rounded-2xl p-4 border border-white/10">
            <div class="text-sm text-slate-300">Total Packages</div>
            <div class="text-3xl font-semibold text-white">{{ $stats['packages'] }}</div>
        </div>
        <div class="card rounded-2xl p-4 border border-white/10">
            <div class="text-sm text-slate-300">Delivered</div>
            <div class="text-3xl font-semibold text-emerald-300">{{ $stats['delivered'] }}</div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <div class="card rounded-2xl border border-white/10 shadow-card">
            <div class="p-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-white">Recent Requests</h2>
                <a href="{{ route('requests.index') }}" class="text-sm text-brand-200 font-semibold hover:text-white">View all</a>
            </div>
            <div class="divide-y divide-white/5">
                @forelse($recentRequests as $req)
                    <div class="p-4 flex items-center justify-between text-slate-200">
                        <div>
                            <div class="font-semibold text-white">{{ $req->sender_name }} → {{ $req->receiver_name }}</div>
                            <div class="text-xs text-slate-400">{{ $req->package_weight }} kg · {{ $req->status }}</div>
                        </div>
                        <a href="{{ route('requests.show', $req) }}" class="text-sm text-brand-200 font-semibold hover:text-white">Open</a>
                    </div>
                @empty
                    <p class="p-4 text-sm text-slate-400">No requests.</p>
                @endforelse
            </div>
        </div>
        <div class="card rounded-2xl border border-white/10 shadow-card">
            <div class="p-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-white">Recent Packages</h2>
                <a href="{{ route('packages.index') }}" class="text-sm text-brand-200 font-semibold hover:text-white">Manage</a>
            </div>
            <div class="divide-y divide-white/5">
                @forelse($recentPackages as $pkg)
                    <div class="p-4 flex items-center justify-between text-slate-200">
                        <div>
                            <div class="font-semibold text-white">{{ $pkg->tracking_number }}</div>
                            <div class="text-xs text-slate-400">{{ $pkg->status }} · {{ $pkg->sender_name }} → {{ $pkg->receiver_name }}</div>
                        </div>
                        <a href="{{ route('packages.edit', $pkg) }}" class="text-sm text-brand-200 font-semibold hover:text-white">Edit</a>
                    </div>
                @empty
                    <p class="p-4 text-sm text-slate-400">No packages.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
