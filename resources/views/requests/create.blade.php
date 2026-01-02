@extends('layouts.app', ['title' => 'New Request'])

@section('content')
<div class="max-w-3xl mx-auto card border border-white/10 rounded-3xl p-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-semibold text-white">Submit Package Request</h1>
            <p class="text-sm text-slate-300">Provide sender and receiver info. An admin will review it.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="text-sm text-brand-200 font-semibold hover:text-white">Back</a>
    </div>
    <form method="POST" action="{{ route('requests.store') }}" class="grid md:grid-cols-2 gap-4 text-slate-200">
        @csrf
        <div class="space-y-2 md:col-span-2">
            <label class="text-sm font-medium text-slate-200">Sender Name</label>
            <input name="sender_name" value="{{ old('sender_name') }}" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-brand-400 focus:outline-none">
        </div>
        <div class="space-y-2 md:col-span-2">
            <label class="text-sm font-medium text-slate-200">Sender Address</label>
            <textarea name="sender_address" rows="2" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-brand-400 focus:outline-none">{{ old('sender_address') }}</textarea>
        </div>
        <div class="space-y-2 md:col-span-2">
            <label class="text-sm font-medium text-slate-200">Receiver Name</label>
            <input name="receiver_name" value="{{ old('receiver_name') }}" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-brand-400 focus:outline-none">
        </div>
        <div class="space-y-2 md:col-span-2">
            <label class="text-sm font-medium text-slate-200">Receiver Address</label>
            <textarea name="receiver_address" rows="2" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-brand-400 focus:outline-none">{{ old('receiver_address') }}</textarea>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-200">Weight (kg)</label>
            <input name="package_weight" type="number" step="0.01" value="{{ old('package_weight') }}" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-white focus:border-brand-400 focus:outline-none">
        </div>
        <div class="space-y-2 md:col-span-2">
            <label class="text-sm font-medium text-slate-200">Notes</label>
            <textarea name="notes" rows="3" class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-white placeholder:text-slate-400 focus:border-brand-400 focus:outline-none">{{ old('notes') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <button class="w-full md:w-auto px-5 py-2.5 rounded-xl bg-gradient-to-r from-brand-400 to-brand-600 text-white font-semibold shadow-card hover:-translate-y-[1px] transition">Submit request</button>
        </div>
    </form>
</div>
@endsection
