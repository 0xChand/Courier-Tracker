@extends('layouts.app', ['title' => 'Track Package'])

@section('content')
@php
    $progressMap = [
        'Picked Up' => 25,
        'In Transit' => 60,
        'Out For Delivery' => 85,
        'Delivered' => 100,
    ];
    $progress = $progressMap[$package->status ?? 'Picked Up'] ?? 40;
@endphp
<div class="grid xl:grid-cols-3 gap-8">
    <div class="xl:col-span-2 space-y-6">
        <section class="card rounded-3xl p-8 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-gradient-to-br from-brand-500/30 to-emerald-300/20 blur-3xl"></div>
            <div class="absolute -bottom-20 -left-12 w-64 h-64 bg-gradient-to-tr from-emerald-400/20 to-brand-600/25 blur-3xl"></div>
            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-3 max-w-xl">
                    <p class="text-xs uppercase tracking-[0.2em] text-brand-100">Courier command center</p>
                    <h1 class="text-3xl lg:text-4xl font-semibold text-white leading-tight">
                        Track every package with a clear, elegant dashboard.
                    </h1>
                    <p class="text-slate-300 text-sm lg:text-base">
                        Enter a tracking number to see live status, delivery ETA, and the exact route your shipment is taking.
                    </p>
                </div>
                <form action="{{ route('home') }}" method="GET" class="w-full lg:max-w-md">
                    <label class="block text-sm font-medium text-slate-200 mb-2">Tracking number</label>
                    <div class="glass rounded-2xl p-2 flex items-center gap-2 shadow-card">
                        <div class="px-3 py-2 rounded-xl bg-white/5 border border-white/10 text-sm text-brand-100">
                            #
                        </div>
                        <input
                            type="text"
                            name="tracking_number"
                            value="{{ $trackingNumber }}"
                            placeholder="e.g. 1, 2, 3, 4"
                            class="bg-transparent w-full text-white placeholder:text-slate-400 text-base focus:outline-none"
                            required
                        >
                        <button type="submit" class="px-4 py-3 rounded-xl bg-gradient-to-r from-brand-400 to-brand-600 text-white font-semibold shadow-lg hover:translate-y-[-1px] transition">
                            Track now
                        </button>
                    </div>
                    <p class="text-xs text-slate-400 mt-3">Tip: use a code from your dashboard or admin list.</p>
                    @if(isset($recent) && $recent->isNotEmpty())
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($recent as $item)
                                <a href="{{ route('home', ['tracking_number' => $item->tracking_number]) }}" class="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs text-brand-100 hover:border-brand-200">
                                    {{ $item->tracking_number }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
        </section>

        @if($package)
            <section class="card rounded-3xl p-6 space-y-4 border border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-300">Tracking</p>
                        <h3 class="text-2xl font-semibold text-white">{{ $package->tracking_number }}</h3>
                    </div>
                    <span class="text-xs px-3 py-1 rounded-full border border-white/10 bg-white/5">{{ $package->status }}</span>
                </div>
                <div class="grid md:grid-cols-2 gap-4 text-sm text-slate-200">
                    <div>
                        <p class="text-slate-400">Sender</p>
                        <p>{{ $package->sender_name }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400">Receiver</p>
                        <p>{{ $package->receiver_name }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-slate-300 mb-2">Progress</p>
                    <div class="h-2 rounded-full bg-white/5 overflow-hidden">
                        <div class="h-full w-full bg-gradient-to-r from-brand-300 via-brand-500 to-emerald-400 origin-left" style="transform: scaleX({{ $progress / 100 }});"></div>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Latest update: {{ optional($package->trackingUpdates()->latest()->first())->created_at?->diffForHumans() ?? 'Awaiting first scan' }}</p>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-semibold text-white">Route timeline</h4>
                    </div>
                    <div class="relative border-l border-white/10 pl-4 space-y-4">
                        @forelse($package->trackingUpdates()->latest()->get() as $log)
                            <div class="relative">
                                <span class="absolute -left-[9px] top-1 w-3 h-3 rounded-full bg-gradient-to-r from-brand-400 to-brand-600"></span>
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold border border-white/10 bg-white/5 text-white">{{ $log->status }}</span>
                                        @if($log->location)
                                            <span class="text-xs text-slate-300">{{ $log->location }}</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-400 whitespace-nowrap">{{ $log->created_at->diffForHumans() }}</p>
                                </div>
                                @if($log->notes)
                                    <p class="text-xs text-slate-400">{{ $log->notes }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-slate-300">No tracking updates yet.</p>
                        @endforelse
                    </div>
                </div>
            </section>
        @elseif($trackingNumber)
            <section class="card rounded-3xl p-6 border border-white/10">
                <p class="text-sm text-amber-200 font-semibold">No package found</p>
                <p class="text-slate-300 mt-2">We could not find a package with tracking code <span class="font-semibold text-white">{{ $trackingNumber }}</span>. Check the code and try again.</p>
            </section>
        @endif
    </div>

    <aside class="space-y-4">
        <div class="card rounded-3xl p-6 border border-white/10 space-y-3">
            <p class="text-sm text-slate-200 font-semibold">Need to track a package?</p>
            <p class="text-slate-300 text-sm">Pick a tracking code from your dashboard or ask admin for a code to preview a full detail page with checkpoints.</p>
            @auth
                <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded bg-gradient-to-r from-brand-400 to-brand-600 inline-flex items-center justify-center text-white font-semibold">Go to dashboard</a>
            @else
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded bg-white/5 border border-white/10 text-sm">Login</a>
                    <a href="{{ route('register') }}" class="px-3 py-2 rounded bg-gradient-to-r from-brand-400 to-brand-600 text-white font-semibold text-sm">Sign up</a>
                </div>
            @endauth
        </div>
    </aside>
</div>
@endsection
