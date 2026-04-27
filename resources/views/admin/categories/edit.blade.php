@extends('admin.layout')

@section('title', 'تعديل قسم | البركة')

@section('content')
    <div class="flex items-center justify-between gap-3 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-[var(--color-baraka-gold)]">تعديل قسم</h1>
            <p class="text-white/70 mt-1">حدّث اسم القسم.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}"
           class="rounded-xl px-4 py-2 border border-white/10 bg-white/5 hover:bg-white/10 transition font-bold">
            رجوع
        </a>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-4 max-w-xl">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-white font-extrabold mb-2">اسم القسم</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                   class="w-full rounded-xl bg-black/30 border border-white/10 px-4 py-3 text-white outline-none focus:border-[var(--color-baraka-gold)]"
                   placeholder="مثال: شاورما" required>
            @error('name')
            <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-end gap-2 pt-2">
            <button type="submit"
                    class="rounded-xl px-5 py-3 font-black bg-[var(--color-baraka-gold)] text-black hover:opacity-95 transition">
                تحديث
            </button>
        </div>
    </form>
@endsection

