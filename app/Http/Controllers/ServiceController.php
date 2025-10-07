<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    public function index(): Response
    {
        // Admin listing
        return Inertia::render('Services/Index', [
            'services' => Service::all(),
        ]);
    }

    /**
     * Display a public listing of the services.
     */
    public function publicIndex(string $lang): Response
    {
        return Inertia::render('Public/Services/Index', [
            'menu_style' => 'black',
            'footer_style' => 'light',
            'lang' => $lang,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Services/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_es' => ['required', 'string', 'max:255'],
            'short_en' => ['nullable', 'string'],
            'short_es' => ['nullable', 'string'],
            'long_en' => ['nullable', 'string'],
            'long_es' => ['nullable', 'string'],
        ]);

        $service = new Service();
        $service->name_en = $validated['name_en'];
        $service->name_es = $validated['name_es'];
        $service->short_en = $validated['short_en'] ?? null;
        $service->short_es = $validated['short_es'] ?? null;
        $service->long_en = $validated['long_en'] ?? null;
        $service->long_es = $validated['long_es'] ?? null;
        $service->save();

        return redirect()->route('services.index');
    }

    public function edit(Service $service): Response
    {
        return Inertia::render('Services/Edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_es' => ['required', 'string', 'max:255'],
            'short_en' => ['nullable', 'string'],
            'short_es' => ['nullable', 'string'],
            'long_en' => ['nullable', 'string'],
            'long_es' => ['nullable', 'string'],
        ]);

        $service->name_en = $validated['name_en'];
        $service->name_es = $validated['name_es'];
        $service->short_en = $validated['short_en'] ?? null;
        $service->short_es = $validated['short_es'] ?? null;
        $service->long_en = $validated['long_en'] ?? null;
        $service->long_es = $validated['long_es'] ?? null;
        $service->save();

        return redirect()->route('services.index');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index');
    }
}