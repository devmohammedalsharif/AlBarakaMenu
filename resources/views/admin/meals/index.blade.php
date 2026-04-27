@extends('admin.layout')

@section('title', 'الوجبات | البركة')

@section('content')
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-[var(--color-baraka-gold)]">الوجبات</h1>
            <p class="text-white/70 mt-1">إدارة الوجبات مع صور وأسعار.</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <form method="GET" action="{{ route('admin.meals.index') }}" class="flex gap-2">
                <select name="category_id"
                        class="rounded-xl bg-black/30 border border-white/10 px-4 py-2 text-white outline-none focus:border-[var(--color-baraka-gold)]">
                    <option value="" class="text-black">كل الأقسام</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((string)request('category_id') === (string)$category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                        class="rounded-xl px-4 py-2 border border-white/10 bg-white/5 hover:bg-white/10 transition font-bold">
                    فلترة
                </button>
            </form>

            <a href="{{ route('admin.meals.create') }}"
               class="inline-flex items-center justify-center rounded-xl px-4 py-2 font-extrabold bg-[var(--color-baraka-gold)] text-black hover:opacity-95 transition">
                + إضافة وجبة
            </a>
        </div>
    </div>

    <div class="rounded-2xl border border-white/10 bg-white/5 overflow-x-auto">
        <table class="min-w-full text-right">
            <thead>
            <tr class="text-white/70">
                <th class="py-3 px-3 font-bold">#</th>
                <th class="py-3 px-3 font-bold">الصورة</th>
                <th class="py-3 px-3 font-bold">الاسم</th>
                <th class="py-3 px-3 font-bold">القسم</th>
                <th class="py-3 px-3 font-bold">السعر</th>
                <th class="py-3 px-3 font-bold">إجراءات</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
            @forelse($meals as $meal)
                <tr class="text-white">
                    <td class="py-3 px-3 text-white/80">{{ $meal->id }}</td>
                    <td class="py-3 px-3">
                        <img src="{{ $meal->image_path }}" alt="{{ $meal->name }}"
                             class="w-14 h-14 rounded-xl object-cover border border-white/10">
                    </td>
                    <td class="py-3 px-3 font-extrabold">{{ $meal->name }}</td>
                    <td class="py-3 px-3 text-white/80">{{ $meal->category?->name }}</td>
                    <td class="py-3 px-3">
                        <span class="inline-flex items-center gap-1 rounded-full bg-[var(--color-baraka-gold)] text-black px-3 py-1 font-black">
                            <span class="tabular-nums">{{ number_format((float)$meal->price, 2) }}</span>
                            <span class="font-black">شيكل</span>
                        </span>
                    </td>
                    <td class="py-3 px-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.meals.edit', $meal) }}"
                               class="rounded-xl px-3 py-2 border border-white/10 bg-white/5 hover:bg-white/10 transition font-bold">
                                تعديل
                            </a>

                            <div x-data="{ open: false }" class="relative">
                                <button type="button"
                                        @click="open = true"
                                        class="rounded-xl px-3 py-2 border border-[var(--color-baraka-red)]/40 bg-[var(--color-baraka-red)]/10 hover:bg-[var(--color-baraka-red)]/20 transition font-bold text-white">
                                    حذف
                                </button>

                                <div x-show="open" x-cloak class="fixed inset-0 z-[9999]">
                                    <div class="absolute inset-0 bg-black/70" @click="open = false"></div>
                                    <div class="absolute inset-0 flex items-center justify-center p-4">
                                        <div class="w-full max-w-md rounded-2xl border border-white/10 bg-[var(--color-baraka-card)] p-5">
                                            <h3 class="text-lg font-black text-[var(--color-baraka-gold)]">تأكيد الحذف</h3>
                                            <p class="text-white/80 mt-2">
                                                هل أنت متأكد من حذف <span class="font-black">{{ $meal->name }}</span>؟
                                            </p>

                                            <div class="mt-5 flex items-center justify-end gap-2">
                                                <button type="button"
                                                        class="rounded-xl px-4 py-2 border border-white/10 bg-white/5 hover:bg-white/10 transition font-bold text-white"
                                                        @click="open = false">
                                                    لا
                                                </button>
                                                <form method="POST" action="{{ route('admin.meals.destroy', $meal) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="rounded-xl px-4 py-2 bg-[var(--color-baraka-red)] hover:opacity-95 transition font-black text-black">
                                                        نعم
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-white/70">
                        لا توجد وجبات بعد.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $meals->links() }}
        </div>
    </div>
@endsection

