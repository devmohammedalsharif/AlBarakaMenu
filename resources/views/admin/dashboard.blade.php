@extends('admin.layout')

@section('title', 'لوحة التحكم | البركة')

@section('content')
    <div class="rounded-[18px] border border-white/10 bg-black/20 p-5 overflow-hidden relative">
        <div class="absolute inset-0 pointer-events-none"
             style="background: radial-gradient(900px 220px at 40% 15%, rgba(197,157,95,0.18), transparent 60%);"></div>

        <div class="relative">
            <div class="inline-flex items-center gap-2 rounded-full px-3 py-2 bg-white/5 border border-white/10 text-white/80 font-bold">
                <span class="w-2.5 h-2.5 rounded-full bg-[var(--color-baraka-gold)]"></span>
                جاهز لإدارة المنيو
            </div>

            <h1 class="mt-4 text-2xl sm:text-4xl font-black text-[var(--color-baraka-gold)]">
                لوحة تحكم البركة
            </h1>
            <p class="text-white/70 mt-2 leading-relaxed max-w-2xl">
                أضف الأقسام والوجبات بسرعة، وحدّث الأسعار والصور، مع تجربة قريبة من هوية صفحة المنيو.
            </p>

            <div class="mt-5 flex flex-col sm:flex-row gap-2">
                <a href="{{ route('admin.meals.create') }}"
                   class="inline-flex items-center justify-center rounded-full px-5 py-3 font-black bg-[var(--color-baraka-gold)] text-black hover:opacity-95 transition shadow-[0_12px_30px_rgba(0,0,0,0.40)]">
                    + إضافة وجبة
                </a>
                <a href="{{ route('admin.categories.create') }}"
                   class="inline-flex items-center justify-center rounded-full px-5 py-3 font-black border border-white/10 bg-white/5 hover:bg-white/10 transition">
                    + إضافة قسم
                </a>
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('admin.categories.index') }}"
           class="group rounded-[18px] border border-white/10 bg-white/5 hover:bg-white/10 transition p-5 shadow-[0_12px_30px_rgba(0,0,0,0.40)]">
            <div class="text-white/60 text-sm font-bold">إدارة</div>
            <div class="text-xl font-black mt-1 group-hover:text-white">الأقسام</div>
            <div class="text-white/70 mt-2">إضافة/تعديل/حذف أقسام القائمة.</div>
        </a>

        <a href="{{ route('admin.meals.index') }}"
           class="group rounded-[18px] border border-white/10 bg-white/5 hover:bg-white/10 transition p-5 shadow-[0_12px_30px_rgba(0,0,0,0.40)]">
            <div class="text-white/60 text-sm font-bold">إدارة</div>
            <div class="text-xl font-black mt-1 group-hover:text-white">الوجبات</div>
            <div class="text-white/70 mt-2">صور + وصف + سعر + فلترة حسب القسم.</div>
        </a>
    </div>
@endsection

