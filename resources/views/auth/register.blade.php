@extends('layouts.app', ['title' => 'Register'])

@section('content')
<div class="max-w-md mx-auto">
    <div class="card rounded-3xl p-8 border border-white/10 space-y-6">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-brand-100">Join</p>
            <h1 class="text-3xl font-semibold text-white">Create your account</h1>
            <p class="text-sm text-slate-300">Track requests and deliveries in one place.</p>
        </div>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200">Name</label>
                <input name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2.5 text-white placeholder:text-slate-400 focus:border-brand-400 focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2.5 text-white placeholder:text-slate-400 focus:border-brand-400 focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200">Password</label>
                <div class="relative">
                    <input id="register-password" name="password" type="password" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2.5 pr-12 text-white placeholder:text-slate-400 focus:border-brand-400 focus:outline-none">
                    <button type="button" class="absolute inset-y-0 right-2 px-2 text-xs text-slate-300 hover:text-white" onclick="togglePassword('register-password', this)">Show</button>
                </div>
                <p class="text-xs text-slate-400">Min 8 chars, with upper/lowercase, number, and symbol.</p>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200">Confirm Password</label>
                <div class="relative">
                    <input id="register-password-confirm" name="password_confirmation" type="password" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2.5 pr-12 text-white placeholder:text-slate-400 focus:border-brand-400 focus:outline-none">
                    <button type="button" class="absolute inset-y-0 right-2 px-2 text-xs text-slate-300 hover:text-white" onclick="togglePassword('register-password-confirm', this)">Show</button>
                </div>
            </div>
            <button class="w-full bg-gradient-to-r from-brand-400 to-brand-600 text-white rounded-xl py-2.5 font-semibold shadow-card hover:-translate-y-[1px] transition">
                Create account
            </button>
        </form>
    </div>
</div>
<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        if (!input) return;
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        btn.textContent = isPassword ? 'Hide' : 'Show';
    }
</script>
@endsection
