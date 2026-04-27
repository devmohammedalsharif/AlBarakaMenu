<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $query = Meal::query()->with('category')->latest();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $meals = $query->paginate(15)->withQueryString();
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.meals.index', compact('meals', 'categories'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.meals.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['required_without:image_url', 'nullable', 'file', 'image', 'max:4096'],
            'image_url' => ['required_without:image', 'nullable', 'url', 'max:2048'],
        ], [
            'image.required_without' => 'الصورة مطلوبة (ارفع ملف أو ضع رابط).',
            'image_url.required_without' => 'الصورة مطلوبة (ارفع ملف أو ضع رابط).',
        ]);

        $imagePath = $this->resolveImagePath($request);

        Meal::create([
            'category_id' => (int) $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.meals.index')->with('success', 'تم إضافة الوجبة بنجاح');
    }

    public function edit(Meal $meal)
    {
        $meal->load('category');
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.meals.edit', compact('meal', 'categories'));
    }

    public function update(Request $request, Meal $meal)
    {
        $validated = $request->validate([
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'file', 'image', 'max:4096'],
            'image_url' => ['nullable', 'url', 'max:2048'],
        ]);

        $imagePath = $meal->image_path;
        if ($request->hasFile('image') || $request->filled('image_url')) {
            $imagePath = $this->resolveImagePath($request, $meal->image_path);
        }

        $meal->update([
            'category_id' => (int) $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.meals.index')->with('success', 'تم تحديث الوجبة بنجاح');
    }

    public function destroy(Meal $meal)
    {
        $old = $meal->image_path;
        $meal->delete();

        $this->deleteStoredImageIfLocal($old);

        return redirect()->route('admin.meals.index')->with('success', 'تم حذف الوجبة بنجاح');
    }

    private function resolveImagePath(Request $request, ?string $previous = null): string
    {
        if ($request->hasFile('image')) {
            $this->deleteStoredImageIfLocal($previous);

            $path = $request->file('image')->store('meals', 'public');

            return Storage::disk('public')->url($path);
        }

        return (string) $request->string('image_url');
    }

    private function deleteStoredImageIfLocal(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }

        $prefix = Storage::disk('public')->url('/');
        if (str_starts_with($imagePath, $prefix)) {
            $relative = ltrim(str_replace($prefix, '', $imagePath), '/');
            Storage::disk('public')->delete($relative);
        }
    }
}

