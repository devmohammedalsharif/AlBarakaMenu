@php
    /** @var \Illuminate\Support\Collection|\App\Models\Category[] $categories */
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label class="block text-white font-extrabold mb-2">اسم الوجبة</label>
        <input type="text" name="name" value="{{ old('name', $meal->name ?? '') }}"
               class="w-full rounded-xl bg-black/30 border border-white/10 px-4 py-3 text-white outline-none focus:border-[var(--color-baraka-gold)]"
               placeholder="مثال: فرشوحة دبل" required>
        @error('name')
        <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block text-white font-extrabold mb-2">القسم</label>
        <select name="category_id"
                class="w-full rounded-xl bg-black/30 border border-white/10 px-4 py-3 text-white outline-none focus:border-[var(--color-baraka-gold)]"
                required>
            <option value="" class="text-black">اختر القسم</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((string)old('category_id', $meal->category_id ?? '') === (string)$category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
        <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block text-white font-extrabold mb-2">السعر</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $meal->price ?? '') }}"
               class="w-full rounded-xl bg-black/30 border border-white/10 px-4 py-3 text-white outline-none focus:border-[var(--color-baraka-gold)]"
               placeholder="مثال: 25" required>
        @error('price')
        <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-white font-extrabold mb-2">الوصف (اختياري)</label>
        <textarea name="description" rows="4"
                  class="w-full rounded-xl bg-black/30 border border-white/10 px-4 py-3 text-white outline-none focus:border-[var(--color-baraka-gold)]"
                  placeholder="وصف قصير للوجبة...">{{ old('description', $meal->description ?? '') }}</textarea>
        @error('description')
        <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-white font-extrabold mb-2">الصورة</label>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                <div class="text-white font-black mb-2">رفع ملف</div>
                <input type="file" name="image" accept="image/*"
                       class="block w-full text-white file:rounded-xl file:border-0 file:bg-[var(--color-baraka-gold)] file:text-black file:font-black file:px-4 file:py-2">
                @error('image')
                <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
                @enderror
            </div>

            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                <div class="text-white font-black mb-2">أو رابط خارجي</div>
                <input type="url" name="image_url" value="{{ old('image_url') }}"
                       class="w-full rounded-xl bg-black/30 border border-white/10 px-4 py-3 text-white outline-none focus:border-[var(--color-baraka-gold)]"
                       placeholder="https://example.com/image.jpg">
                @error('image_url')
                <div class="mt-2 text-sm font-bold text-[var(--color-baraka-red)]">{{ $message }}</div>
                @enderror
            </div>
        </div>

        @if(!empty($meal?->image_path))
            <div class="mt-4 flex items-center gap-3">
                <img src="{{ $meal->image_path }}" alt="Meal image" class="w-20 h-20 rounded-xl object-cover border border-white/10">
                <div class="text-white/70 text-sm break-all">{{ $meal->image_path }}</div>
            </div>
        @endif
    </div>
</div>

