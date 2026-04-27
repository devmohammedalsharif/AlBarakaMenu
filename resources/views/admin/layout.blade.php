<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'لوحة تحكم البركة')</title>

    <meta name="theme-color" content="#0c0c0c">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .baraka-bg {
            background:
                radial-gradient(1200px 600px at 12% 6%, rgba(197,157,95,0.12), transparent 60%),
                radial-gradient(900px 500px at 90% 10%, rgba(231,76,60,0.08), transparent 55%),
                #0c0c0c;
        }
    </style>
</head>
<body class="baraka-bg min-h-screen text-white font-sans">

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<header class="sticky top-0 z-40 border-b border-white/10 bg-black/60 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-3">
                <span class="inline-grid place-items-center w-11 h-11 rounded-2xl bg-gradient-to-br from-[var(--color-baraka-gold)] to-[var(--color-baraka-gold)]/60 text-[#0b0b0b] font-black shadow-[0_10px_25px_rgba(197,157,95,0.22)]">
                    ب
                </span>
                <span class="inline-flex flex-col text-start">
                    <span class="font-black text-[var(--color-baraka-gold)] leading-tight">مطعم البركة</span>
                    <span class="text-white/60 text-sm font-bold leading-tight">لوحة التحكم — إدارة المنيو</span>
                </span>
            </a>

            <div class="flex items-center gap-2 flex-wrap">
                @auth
                    <span class="hidden sm:inline-flex items-center gap-2 rounded-full px-3 py-2 bg-white/5 border border-white/10 text-white/80 font-bold">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        {{ auth()->user()->name }}
                    </span>
                    <a href="{{ route('menu') }}" target="_blank" rel="noopener"
                       class="rounded-full px-4 py-2 border border-white/10 bg-white/5 hover:bg-white/10 transition font-black">
                        عرض المنيو
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit"
                                class="rounded-full px-4 py-2 border border-white/10 bg-white/5 hover:bg-white/10 transition font-black">
                            تسجيل خروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('admin.login') }}"
                       class="rounded-full px-4 py-2 bg-[var(--color-baraka-gold)] text-black font-black hover:opacity-95 transition shadow-[0_12px_30px_rgba(0,0,0,0.40)]">
                        تسجيل دخول الأدمن
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<div class="max-w-7xl mx-auto px-4 py-7">
    <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-4">
        @auth
            <aside class="rounded-[18px] border border-white/10 bg-[var(--color-baraka-surface)]/70 backdrop-blur-xl p-4 shadow-[0_12px_30px_rgba(0,0,0,0.40)]">
                <div class="mb-3 rounded-[14px] border border-white/10 bg-black/20 p-3">
                    <div class="text-white/70 text-sm font-bold">تنقل سريع</div>
                    <div class="text-[var(--color-baraka-gold)] font-black">إدارة القائمة</div>
                </div>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                       class="group block rounded-full px-4 py-3 font-black border border-white/10 bg-white/5 hover:bg-white/10 transition {{ request()->routeIs('admin.dashboard') ? 'ring-1 ring-[var(--color-baraka-gold)]' : '' }}">
                        <span class="text-white/90 group-hover:text-white">الرئيسية</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                       class="group block rounded-full px-4 py-3 font-black border border-white/10 bg-white/5 hover:bg-white/10 transition {{ request()->is('admin/categories*') ? 'ring-1 ring-[var(--color-baraka-gold)]' : '' }}">
                        <span class="text-white/90 group-hover:text-white">الأقسام</span>
                    </a>
                    <a href="{{ route('admin.meals.index') }}"
                       class="group block rounded-full px-4 py-3 font-black border border-white/10 bg-white/5 hover:bg-white/10 transition {{ request()->is('admin/meals*') ? 'ring-1 ring-[var(--color-baraka-gold)]' : '' }}">
                        <span class="text-white/90 group-hover:text-white">الوجبات</span>
                    </a>
                </nav>
            </aside>
        @endauth

        <main class="rounded-[18px] border border-white/10 bg-[var(--color-baraka-surface)]/70 backdrop-blur-xl p-5 shadow-[0_18px_50px_rgba(0,0,0,0.55)]">
            @if(session('success'))
                <div class="mb-4 rounded-[14px] border border-white/10 bg-white/5 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>

