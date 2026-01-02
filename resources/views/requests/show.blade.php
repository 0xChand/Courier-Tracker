@extends('layouts.app', ['title' => 'Request Details'])

@section('content')
<div class="max-w-4xl mx-auto card rounded-3xl border border-white/10 p-6 space-y-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <h1 class="text-xl font-semibold text-white">Request #{{ $shipment->id }}</h1>
            <span class="px-3 py-1 rounded-full text-[11px] font-semibold border border-white/10 bg-white/5 text-slate-200">{{ $shipment->status }}</span>
        </div>
        <div class="text-sm text-slate-300">Submitted by {{ $shipment->user->name ?? 'N/A' }}</div>
        </div>
        @if(auth()->user()->isAdmin() && $shipment->status === 'Pending')
            <div class="flex gap-2">
                <form method="POST" action="{{ route('requests.deny', $shipment) }}">
                    @csrf
                    <button class="px-4 py-2 rounded-xl border border-red-500/40 text-red-200 font-semibold bg-white/5 hover:border-red-300 hover:text-white">Deny</button>
                </form>
                <form method="POST" action="{{ route('requests.approve', $shipment) }}">
                    @csrf
                    <button class="px-4 py-2 rounded-xl bg-gradient-to-r from-emerald-400 to-brand-600 text-white font-semibold shadow-card hover:-translate-y-[1px] transition">Approve</button>
                </form>
            </div>
        @endif
    </div>

    <div class="grid md:grid-cols-2 gap-4 text-slate-200">
        <div class="p-4 rounded-xl border border-white/10 bg-white/5">
            <div class="text-sm text-slate-400">Sender</div>
            <div class="font-semibold text-white">{{ $shipment->sender_name }}</div>
            <div class="text-sm text-slate-300">{{ $shipment->sender_address }}</div>
        </div>
        <div class="p-4 rounded-xl border border-white/10 bg-white/5">
            <div class="text-sm text-slate-400">Receiver</div>
            <div class="font-semibold text-white">{{ $shipment->receiver_name }}</div>
            <div class="text-sm text-slate-300">{{ $shipment->receiver_address }}</div>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div class="p-4 border border-white/10 bg-white/5 rounded-xl">
            <div class="text-sm text-slate-400">Weight</div>
            <div class="text-lg font-semibold text-white">{{ $shipment->package_weight }} kg</div>
        </div>
        <div class="p-4 border border-white/10 bg-white/5 rounded-xl">
            <div class="text-sm text-slate-400">Status</div>
            <div class="text-lg font-semibold text-white">{{ $shipment->status }}</div>
        </div>
    </div>

    @if($shipment->notes)
        <div class="p-4 rounded-xl border border-brand-300/30 bg-white/5 text-brand-100">
            <div class="text-sm font-semibold">Notes</div>
            <p class="text-sm">{{ $shipment->notes }}</p>
        </div>
    @endif

    @if($shipment->package)
        <div class="p-4 rounded-xl border border-emerald-400/30 bg-white/5 text-emerald-100">
            <div class="text-sm font-semibold">Package Created</div>
            <div class="text-lg font-semibold">Tracking: {{ $shipment->package->tracking_number }}</div>
            <div class="text-sm">Status: {{ $shipment->package->status }}</div>
        </div>
    @endif
</div>
@endsection
