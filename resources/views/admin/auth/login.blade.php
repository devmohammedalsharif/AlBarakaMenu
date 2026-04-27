@extends('admin.layout')

@section('title', 'تسجيل دخول الأدمن | البركة')

@section('content')
    <div class="w-full min-w-0 max-w-4xl mx-auto">
        <div class="grid w-full min-w-0 grid-cols-1 md:grid-cols-2 gap-4 md:gap-5 items-stretch">
            <div class="min-w-0 rounded-[18px] border border-white/10 bg-black/25 overflow-hidden shadow-[0_12px_30px_rgba(0,0,0,0.40)]">
                <div class="p-5">
                    <div class="inline-flex items-center gap-3 rounded-full px-4 py-2 border border-white/10 bg-black/25 backdrop-blur">
                        <span class="inline-grid place-items-center w-11 h-11 rounded-2xl bg-gradient-to-br from-[var(--color-baraka-gold)] to-[var(--color-baraka-gold)]/60 text-[#0b0b0b] font-black">
                            ب
                        </span>
                        <div class="text-start">
                            <div class="font-black text-white">مطعم البركة</div>
                            <div class="text-white/70 font-bold text-sm">دخول لوحة التحكم</div>
                        </div>
                    </div>

                    <h1 class="mt-4 text-2xl sm:text-3xl font-black text-[var(--color-baraka-gold)]">
                        أهلاً بك من جديد
                    </h1>
                    <p class="text-white/70 mt-2 leading-relaxed">
                        ادخل البريد الإلكتروني وكلمة المرور للوصول لإدارة الأقسام والوجبات.
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-2 bg-white/5 border border-white/10 text-white/80 font-bold">
                            <span class="w-2.5 h-2.5 rounded-full bg-[var(--color-baraka-gold)]"></span>
                            آمن ومحمي
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-2 bg-white/5 border border-white/10 text-white/80 font-bold">
                            <span class="w-2.5 h-2.5 rounded-full bg-[var(--color-baraka-red)]"></span>
                            إدارة سريعة
                        </span>
                    </div>
                </div>
                <div class="h-28 bg-gradient-to-b from-transparent to-black/40"></div>
            </div>

            <div class="min-w-0 rounded-[18px] border border-white/10 bg-[var(--color-baraka-surface)]/60 backdrop-blur-xl p-4 sm:p-5 shadow-[0_18px_50px_rgba(0,0,0,0.55)]">
                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-white font-extrabold mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full rounded-2xl bg-black/30 border border-white/10 px-4 py-3 text-white outline-none focus:border-[var(--color-baraka-gold)] focus:ring-2 focus:ring-[var(--color-baraka-gold)]/20"
                               placeholder="ahmed@admin.com" required>
                        @error('email')
                        <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white font-extrabold mb-2">كلمة المرور</label>
                        <input type="password" name="password"
                               class="w-full rounded-2xl bg-black/30 border border-white/10 px-4 py-3 text-white outline-none focus:border-[var(--color-baraka-gold)] focus:ring-2 focus:ring-[var(--color-baraka-gold)]/20"
                               placeholder="********" required>
                        @error('password')
                        <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <label class="inline-flex items-center gap-2 text-white/80 font-bold">
                            <input type="checkbox" name="remember" value="1" class="accent-[var(--color-baraka-gold)]">
                            تذكرني
                        </label>
                        <a href="{{ url('/') }}" class="text-white/70 hover:text-white font-bold underline underline-offset-4">
                            العودة للصفحة الرئيسية
                        </a>
                    </div>

                    <button type="submit"
                            class="w-full rounded-2xl px-5 py-3 font-black bg-[var(--color-baraka-gold)] text-black hover:opacity-95 transition shadow-[0_12px_30px_rgba(0,0,0,0.40)]">
                        دخول
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

