<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Courier Tracker') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Manrope', 'Inter', 'ui-sans-serif', 'system-ui'] },
                    colors: {
                        brand: {50:'#fef6e7',100:'#fde8c8',200:'#f7d7a6',300:'#f0c078',400:'#e59d47',500:'#d67921',600:'#b45f17',700:'#8c4713',800:'#5f3010',900:'#3d1f0b'},
                    },
                    boxShadow: { card: '0 18px 55px rgba(7, 10, 18, 0.4)' },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Manrope', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: radial-gradient(circle at 16% 18%, rgba(229, 157, 71, 0.16), transparent 28%),
                        radial-gradient(circle at 82% -4%, rgba(212, 126, 44, 0.14), transparent 24%),
                        radial-gradient(circle at 50% 88%, rgba(16, 185, 129, 0.08), transparent 34%),
                        #0c1016;
        }
        .glass { background: rgba(255, 255, 255, 0.07); border: 1px solid rgba(255, 255, 255, 0.07); backdrop-filter: blur(18px); }
        .card { background: #10151d; border: 1px solid rgba(255, 255, 255, 0.06); box-shadow: 0 24px 60px rgba(0, 0, 0, 0.4); }
        .gradient-bar { background: linear-gradient(90deg, #e59d47, #d67921, #b45f17); }
        select option { color: #0f172a; background: #f8fafc; }
        select option:checked { background: #f6a94b; color: #0f172a; }
    </style>
</head>
<body class="min-h-screen text-slate-50">
    <div class="absolute inset-0 -z-10 opacity-80 pointer-events-none">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_28%_18%,rgba(229,157,71,0.14),transparent_28%),radial-gradient(circle_at_78%_6%,rgba(212,126,44,0.14),transparent_24%),radial-gradient(circle_at_48%_82%,rgba(16,185,129,0.12),transparent_32%)]"></div>
    </div>

    <header class="px-6 lg:px-12 py-6 flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-brand-300 via-brand-500 to-brand-700 flex items-center justify-center shadow-card">
                    <span class="font-semibold text-lg">CT</span>
                </div>
                <div>
                    <p class="text-lg font-semibold">Courier Tracker</p>
                    <p class="text-sm text-slate-300">Real-time package visibility</p>
                </div>
            </a>
        </div>
        <div class="flex flex-wrap items-center gap-2 text-sm text-slate-200">
            <a href="{{ route('home') }}" class="px-3 py-1 rounded bg-white/5 border border-white/10 hover:border-brand-200">Track</a>
            @auth
                <a href="{{ route('dashboard') }}" class="px-3 py-1 rounded bg-white/5 border border-white/10 hover:border-brand-200">Dashboard</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('requests.index') }}" class="px-3 py-1 rounded bg-white/5 border border-white/10 hover:border-brand-200">Requests</a>
                    <a href="{{ route('packages.index') }}" class="px-3 py-1 rounded bg-white/5 border border-white/10 hover:border-brand-200">Packages</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="px-3 py-1 rounded bg-white/5 border border-white/10 text-red-200 hover:border-red-200">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-3 py-1 rounded bg-white/5 border border-white/10 hover:border-brand-200">Login</a>
                <a href="{{ route('register') }}" class="px-3 py-1 rounded bg-gradient-to-r from-brand-400 to-brand-600 text-white font-semibold">Sign up</a>
            @endauth
        </div>
    </header>

    <main class="px-6 lg:px-12 pb-12">
        @include('partials.alerts')
        @yield('content')
    </main>
</body>
</html>
