@extends('layouts.app', ['title' => 'Requests'])

@section('content')
@php
    $statusColors = [
        'Pending' => 'bg-amber-500/20 text-amber-100 border-amber-400/30',
        'Accepted' => 'bg-emerald-500/20 text-emerald-100 border-emerald-400/30',
        'Denied' => 'bg-rose-500/20 text-rose-100 border-rose-400/30',
    ];
@endphp
<div class="card rounded-3xl shadow-card border border-white/10">
    <div class="p-4 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold text-white">All Requests</h1>
            <p class="text-sm text-slate-300">Approve or deny user submissions.</p>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-slate-200">
            <thead class="bg-white/5 text-slate-300">
                <tr>
                    <th class="px-4 py-3 text-left">User</th>
                    <th class="px-4 py-3 text-left">Sender</th>
                    <th class="px-4 py-3 text-left">Receiver</th>
                    <th class="px-4 py-3 text-left">Weight</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Created</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($requests as $req)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-4 py-3">{{ $req->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $req->sender_name }}</td>
                        <td class="px-4 py-3">{{ $req->receiver_name }}</td>
                        <td class="px-4 py-3">{{ number_format($req->package_weight, 2) }} kg</td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusColors[$req->status] ?? 'border-white/10 bg-white/5 text-slate-200' }}">
                                {{ $req->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-400">{{ $req->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            <a href="{{ route('requests.show', $req) }}" class="text-brand-200 font-semibold hover:text-white">Open</a>
                            @if($req->status === 'Pending')
                                <form method="POST" action="{{ route('requests.approve', $req) }}">
                                    @csrf
                                    <button class="px-3 py-1 rounded bg-gradient-to-r from-emerald-400 to-brand-600 text-white text-xs font-semibold hover:-translate-y-[1px] transition">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('requests.deny', $req) }}">
                                    @csrf
                                    <button class="px-3 py-1 rounded border border-red-500/40 text-red-200 text-xs font-semibold bg-white/5 hover:border-red-300 hover:text-white">Deny</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-slate-400">No requests yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $requests->links() }}
    </div>
</div>
@endsection
