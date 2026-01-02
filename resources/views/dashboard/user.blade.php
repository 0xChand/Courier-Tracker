@extends('layouts.app', ['title' => 'My Dashboard'])

@section('content')
<div class="flex flex-col gap-6">
    <div class="card rounded-3xl p-6 shadow-card border border-white/10">
        <h1 class="text-2xl font-semibold text-white">Hi {{ auth()->user()->name }},</h1>
        <p class="text-sm text-slate-300">Submit new courier requests and follow their status.</p>
        <div class="mt-4 flex gap-3">
            <a href="{{ route('requests.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-brand-400 to-brand-600 text-white font-semibold shadow-card hover:-translate-y-[1px] transition">
                New Request
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-slate-100">Track a package</a>
        </div>
    </div>

    <div class="card rounded-3xl shadow-card border border-white/10">
        <div class="p-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-white">My Requests</h2>
            <a href="{{ route('requests.create') }}" class="text-sm text-brand-200 font-semibold hover:text-white">Submit new</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-slate-200">
                <thead class="bg-white/5 text-slate-300">
                    <tr>
                        <th class="px-4 py-3 text-left">Sender</th>
                        <th class="px-4 py-3 text-left">Receiver</th>
                        <th class="px-4 py-3 text-left">Weight</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Package</th>
                        <th class="px-4 py-3 text-left">Submitted</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($requests as $req)
                        <tr>
                            <td class="px-4 py-3">{{ $req->sender_name }}</td>
                            <td class="px-4 py-3">{{ $req->receiver_name }}</td>
                            <td class="px-4 py-3">{{ number_format($req->package_weight, 2) }} kg</td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold border border-white/10 bg-white/5">
                                    {{ $req->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if($req->package)
                                    <span class="font-semibold text-white">{{ $req->package->tracking_number }}</span>
                                    <span class="text-xs text-slate-400 block">{{ $req->package->status }}</span>
                                @else
                                    <span class="text-slate-500 text-xs">Not created</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-400">{{ $req->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-slate-400">No requests yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
