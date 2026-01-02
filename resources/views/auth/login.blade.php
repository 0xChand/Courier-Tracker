@extends('layouts.app', ['title' => 'Login'])

@section('content')
<div class="max-w-md mx-auto">
    <div class="card rounded-3xl p-8 border border-white/10 space-y-6">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-brand-100">Access</p>
            <h1 class="text-3xl font-semibold text-white">Welcome back</h1>
            <p class="text-sm text-slate-300">Sign in to track and manage your packages.</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2.5 text-white placeholder:text-slate-400 focus:border-brand-400 focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-200">Password</label>
                <div class="relative">
                    <input id="login-password" name="password" type="password" required class="w-full rounded-xl border border-white/10 bg-white/5 px-3 py-2.5 pr-12 text-white placeholder:text-slate-400 focus:border-brand-400 focus:outline-none">
                    <button type="button" class="absolute inset-y-0 right-2 px-2 text-xs text-slate-300 hover:text-white" onclick="togglePassword('login-password', this)">Show</button>
                </div>
            </div>
            <div class="flex items-center justify-between text-sm text-slate-300">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded border-white/20 bg-transparent">
                    Remember me
                </label>
                <a href="{{ route('register') }}" class="text-brand-200 font-semibold hover:text-white">Create account</a>
            </div>
            <button class="w-full bg-gradient-to-r from-brand-400 to-brand-600 text-white rounded-xl py-2.5 font-semibold shadow-card hover:-translate-y-[1px] transition">
                Login
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
