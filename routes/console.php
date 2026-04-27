<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Category;
use App\Models\Meal;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('menu:import {path? : Absolute path to index.html}', function () {
    $path = $this->argument('path') ?: '/Users/macbook/Desktop/index.html';

    if (!is_string($path) || !is_file($path)) {
        $this->error("File not found: {$path}");
        return 1;
    }

    $html = file_get_contents($path);
    if ($html === false) {
        $this->error("Failed to read: {$path}");
        return 1;
    }

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    /** @var array<string, Category> $categoryMap */
    $categoryMap = [];

    // Sections are identified by <div class="menu-grid" data-section="..."> and matching <h2 id="...">
    $sectionDivs = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' menu-grid ')][@data-section]");
    if (!$sectionDivs) {
        $this->error('No menu sections found (menu-grid).');
        return 1;
    }

    $importedMeals = 0;
    $importedCategories = 0;

    foreach ($sectionDivs as $sectionDiv) {
        $sectionKey = $sectionDiv->attributes?->getNamedItem('data-section')?->nodeValue ?? null;
        if (!$sectionKey) {
            continue;
        }

        // Find title from h2 with matching id
        $titleNode = $xpath->query("//*[@id='{$sectionKey}']")->item(0);
        $rawTitle = $titleNode?->textContent ?? $sectionKey;
        $title = trim(preg_replace('/\s+/', ' ', $rawTitle) ?: $sectionKey);
        // Remove any trailing counts (if any)
        $title = trim(preg_replace('/\s+\d+\s+صنف$/u', '', $title) ?: $title);

        $category = $categoryMap[$sectionKey] ?? Category::firstOrCreate(['name' => $title], ['name' => $title]);
        $categoryMap[$sectionKey] = $category;
        if ($category->wasRecentlyCreated) {
            $importedCategories++;
        }

        // Cards in this section
        $cards = $xpath->query(".//*[contains(concat(' ', normalize-space(@class), ' '), ' food-card ')]", $sectionDiv);
        if (!$cards) {
            continue;
        }

        foreach ($cards as $card) {
            $nameNode = $xpath->query(".//*[self::h3]", $card)->item(0);
            $name = trim($nameNode?->textContent ?? '');
            if ($name === '') {
                continue;
            }

            $descNode = $xpath->query(".//*[contains(concat(' ', normalize-space(@class), ' '), ' subtitle ')]", $card)->item(0);
            $description = trim($descNode?->textContent ?? '');
            $description = $description !== '' ? $description : null;

            $priceNode = $xpath->query(".//*[contains(concat(' ', normalize-space(@class), ' '), ' price-box ')]", $card)->item(0);
            $priceText = trim($priceNode?->textContent ?? '');
            // Extract first number (supports "20 شيكل" etc)
            $price = null;
            if (preg_match('/(\d+(\.\d+)?)/', $priceText, $m)) {
                $price = (float) $m[1];
            }
            if ($price === null) {
                $price = 0.0;
            }

            $imgNode = $xpath->query(".//img", $card)->item(0);
            $imagePath = $imgNode?->attributes?->getNamedItem('src')?->nodeValue ?? '';
            $imagePath = trim($imagePath);
            if ($imagePath === '') {
                continue;
            }

            Meal::updateOrCreate(
                ['category_id' => $category->id, 'name' => $name],
                ['description' => $description, 'price' => $price, 'image_path' => $imagePath]
            );
            $importedMeals++;
        }
    }

    $this->info("Imported categories: {$importedCategories}");
    $this->info("Imported meals: {$importedMeals}");

    return 0;
})->purpose('Import menu data from index.html into DB');
