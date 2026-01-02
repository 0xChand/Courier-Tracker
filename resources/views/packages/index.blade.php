@extends('layouts.app', ['title' => 'Packages'])

@section('content')
@php
    $statusColors = [
        'Picked Up' => 'bg-brand-400/20 text-brand-50 border-brand-300/30',
        'In Transit' => 'bg-brand-600/20 text-brand-50 border-brand-500/30',
        'Out For Delivery' => 'bg-amber-500/20 text-amber-100 border-amber-400/30',
        'Delivered' => 'bg-emerald-500/20 text-emerald-100 border-emerald-400/30',
    ];
@endphp
<div class="card rounded-3xl shadow-card border border-white/10">
    <div class="p-4 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold text-white">Packages</h1>
            <p class="text-sm text-slate-300">Manage shipments and tracking updates.</p>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-slate-200">
            <thead class="bg-white/5 text-slate-300">
                <tr>
                    <th class="px-4 py-3 text-left">Tracking</th>
                    <th class="px-4 py-3 text-left">Sender</th>
                    <th class="px-4 py-3 text-left">Receiver</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Weight</th>
                    <th class="px-4 py-3 text-left">User</th>
                    <th class="px-4 py-3 text-left"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($packages as $pkg)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-4 py-3 font-semibold text-white">{{ $pkg->tracking_number }}</td>
                        <td class="px-4 py-3">{{ $pkg->sender_name }}</td>
                        <td class="px-4 py-3">{{ $pkg->receiver_name }}</td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusColors[$pkg->status] ?? 'border-white/10 bg-white/5 text-slate-200' }}">{{ $pkg->status }}</span>
                        </td>
                        <td class="px-4 py-3">{{ number_format($pkg->package_weight, 2) }} kg</td>
                        <td class="px-4 py-3 text-slate-400">{{ $pkg->request?->user?->name }}</td>
                        <td class="px-4 py-3 flex gap-3">
                            <a href="{{ route('packages.edit', $pkg) }}" class="text-brand-200 font-semibold hover:text-white">Edit</a>
                            <form method="POST" action="{{ route('packages.destroy', $pkg) }}" onsubmit="return confirm('Delete package?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-200 font-semibold hover:text-white">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-slate-400">No packages yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $packages->links() }}
    </div>
</div>
@endsection
