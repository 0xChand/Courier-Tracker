@extends('layouts.app', ['title' => 'Edit Package'])

@section('content')
<div class="max-w-4xl mx-auto card rounded-3xl border border-white/10 p-6 space-y-6">
    <div class="flex items-center justify-between gap-3 flex-wrap">
        <div>
            <h1 class="text-xl font-semibold text-white">Package {{ $package->tracking_number }}</h1>
            <p class="text-sm text-slate-300">Update details and add tracking events.</p>
        </div>
        <a href="{{ route('packages.index') }}" class="text-sm text-brand-200 font-semibold hover:text-white">Back</a>
    </div>

    <form method="POST" action="{{ route('packages.update', $package) }}" class="grid md:grid-cols-2 gap-4 text-slate-200">
        @csrf
        @method('PUT')
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-200">Status</label>
            <select name="status" class="w-full rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-white focus:border-brand-300 focus:outline-none">
                @foreach(['Picked Up','In Transit','Out For Delivery','Delivered'] as $status)
                    <option value="{{ $status }}" @selected($package->status === $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-200">Weight (kg)</label>
            <input name="package_weight" type="number" step="0.01" value="{{ old('package_weight', $package->package_weight) }}" required class="w-full rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-white placeholder:text-slate-400 focus:border-brand-300 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-200">Sender</label>
            <input name="sender_name" value="{{ old('sender_name', $package->sender_name) }}" required class="w-full rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-white placeholder:text-slate-400 focus:border-brand-300 focus:outline-none">
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-200">Receiver</label>
            <input name="receiver_name" value="{{ old('receiver_name', $package->receiver_name) }}" required class="w-full rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-white placeholder:text-slate-400 focus:border-brand-300 focus:outline-none">
        </div>
        <div class="md:col-span-2 flex items-center gap-3 flex-wrap">
            <button class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-brand-400 to-brand-600 text-white font-semibold shadow-card hover:-translate-y-[1px] transition">Save package</button>
            <span class="text-xs text-slate-400">Editing updates the core package info; use the form below for checkpoints.</span>
        </div>
    </form>

    <div class="border-t border-white/10 pt-4 space-y-3">
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <h2 class="text-lg font-semibold text-white">Tracking Updates</h2>
            <span class="text-xs px-3 py-1 rounded-full bg-white/5 border border-white/10 text-slate-200">Latest first</span>
        </div>
        <form method="POST" action="{{ route('tracking.update', $package) }}" class="grid md:grid-cols-3 gap-3 text-slate-200">
            @csrf
            <div class="space-y-2 md:col-span-1">
                <label class="text-sm font-medium text-slate-200">Status</label>
                <input name="status" required placeholder="Out For Delivery" class="w-full rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-white placeholder:text-slate-400 focus:border-brand-300 focus:outline-none">
            </div>
            <div class="space-y-2 md:col-span-1">
                <label class="text-sm font-medium text-slate-200">Location</label>
                <input name="location" placeholder="City / Branch" class="w-full rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-white placeholder:text-slate-400 focus:border-brand-300 focus:outline-none">
            </div>
            <div class="space-y-2 md:col-span-1">
                <label class="text-sm font-medium text-slate-200">Notes</label>
                <input name="notes" placeholder="Leave at front desk" class="w-full rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-white placeholder:text-slate-400 focus:border-brand-300 focus:outline-none">
            </div>
            <div class="md:col-span-3">
                <button class="px-5 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white font-semibold hover:bg-white/20">Add update</button>
            </div>
        </form>
        <div class="mt-2 divide-y divide-white/5">
            @forelse($package->trackingUpdates()->latest()->get() as $log)
                <div class="py-3 flex items-start justify-between gap-3 text-slate-200">
                    <div>
                        <div class="font-semibold text-white">{{ $log->status }}</div>
                        <div class="text-xs text-slate-400">{{ $log->location ?? 'N/A' }} @if($log->notes) · {{ $log->notes }} @endif</div>
                    </div>
                    <div class="text-xs text-slate-400 whitespace-nowrap">{{ $log->created_at->format('M d, H:i') }}</div>
                </div>
            @empty
                <p class="text-sm text-slate-400">No tracking events yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
