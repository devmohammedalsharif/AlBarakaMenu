@extends('admin.layout')

@section('title', 'تعديل وجبة | البركة')

@section('content')
    <div class="flex items-center justify-between gap-3 mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-[var(--color-baraka-gold)]">تعديل وجبة</h1>
            <p class="text-white/70 mt-1">يمكنك تحديث البيانات والصورة.</p>
        </div>
        <a href="{{ route('admin.meals.index') }}"
           class="rounded-xl px-4 py-2 border border-white/10 bg-white/5 hover:bg-white/10 transition font-bold">
            رجوع
        </a>
    </div>

    <form method="POST" action="{{ route('admin.meals.update', $meal) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        @include('admin.meals._form', ['meal' => $meal, 'categories' => $categories])

        <div class="flex justify-end gap-2 pt-2">
            <button type="submit"
                    class="rounded-xl px-5 py-3 font-black bg-[var(--color-baraka-gold)] text-black hover:opacity-95 transition">
                تحديث
            </button>
        </div>
    </form>
@endsection

