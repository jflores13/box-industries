<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        // Admin listing
        return Inertia::render('Products/Index', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Display a public listing of the products.
     */
    public function publicIndex(string $lang): Response
    {
        return Inertia::render('Public/Products/Index', [
            'products' => Product::all(),
            'menu_style' => 'white',
            'footer_style' => 'dark',
            'lang' => $lang,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Products/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_en' => ['nullable', 'string'],
            'short_es' => ['nullable', 'string'],
            'long_en' => ['nullable', 'string'],
            'long_es' => ['nullable', 'string'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug'],
            'button_en' => ['nullable', 'string', 'max:255'],
            'button_es' => ['nullable', 'string', 'max:255'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'home_en' => ['nullable', 'string', 'max:255'],
            'home_es' => ['nullable', 'string', 'max:255'],
            'image_src' => ['nullable', 'string', 'max:255'],
            'booklet_src' => ['nullable', 'string', 'max:255'],
            'product_id' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string'],
            'on_carrousel' => ['sometimes', 'boolean'],
        ]);

        Product::create($validated);

        return redirect()->route('products.index');
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('Products/Edit', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_en' => ['nullable', 'string'],
            'short_es' => ['nullable', 'string'],
            'long_en' => ['nullable', 'string'],
            'long_es' => ['nullable', 'string'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug,' . $product->id],
            'button_en' => ['nullable', 'string', 'max:255'],
            'button_es' => ['nullable', 'string', 'max:255'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'home_en' => ['nullable', 'string', 'max:255'],
            'home_es' => ['nullable', 'string', 'max:255'],
            'image_src' => ['nullable', 'string', 'max:255'],
            'booklet_src' => ['nullable', 'string', 'max:255'],
            'product_id' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string'],
            'on_carrousel' => ['sometimes', 'boolean'],
        ]);

        $product->update($validated);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
