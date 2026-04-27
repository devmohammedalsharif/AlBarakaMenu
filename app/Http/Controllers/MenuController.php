<?php

namespace App\Http\Controllers;

use App\Models\Category;

class MenuController
{
    public function __invoke()
    {
        $categories = Category::query()
            ->with(['meals' => fn ($q) => $q->orderBy('id')])
            ->orderBy('id')
            ->get();

        return view('menu', compact('categories'));
    }
}

