<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PartnerController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Partners/Index', [
            'partners' => Partner::orderBy('sort_order')->get(),
        ]);
    }

    public function publicIndex(): Response
    {
        return Inertia::render('Public/Partners/Index', [
            'partners' => Partner::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Partners/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'dimensions:width=600,height=600'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $path = $request->file('image')->store('partners', 'public');

        Partner::create([
            'image_path' => $path,
            'alt_text' => $validated['alt_text'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('partners.index');
    }

    public function edit(Partner $partner): Response
    {
        return Inertia::render('Partners/Edit', [
            'partner' => $partner,
        ]);
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'dimensions:width=600,height=600'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data = [
            'alt_text' => $validated['alt_text'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('partners.index');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('partners.index');
    }
}
