<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SponsorController extends Controller
{
    /**
     * List all sponsors.
     */
    public function index(): View
    {
        $sponsors = Sponsor::orderBy('sort_order')->get();

        return view('admin.sponsors.index', compact('sponsors'));
    }

    /**
     * Store a new sponsor.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['required', 'file', 'mimes:svg,png,webp,avif,jpg,jpeg', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $logoPath = '';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $filename);
            $logoPath = $filename;
        }

        Sponsor::create([
            'name' => $validated['name'],
            'website_url' => $validated['website_url'] ?? null,
            'logo_path' => $logoPath,
            'sort_order' => $validated['sort_order'] ?? (Sponsor::max('sort_order') + 1),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor added successfully.');
    }

    /**
     * Update an existing sponsor.
     */
    public function update(Request $request, Sponsor $sponsor): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'file', 'mimes:svg,png,webp,avif,jpg,jpeg', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $filename);
            $sponsor->logo_path = $filename;
        }

        $sponsor->name = $validated['name'];
        $sponsor->website_url = $validated['website_url'] ?? null;
        $sponsor->sort_order = $validated['sort_order'] ?? $sponsor->sort_order;
        $sponsor->is_active = $request->has('is_active');
        $sponsor->save();

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor updated successfully.');
    }

    /**
     * Delete a sponsor.
     */
    public function destroy(Sponsor $sponsor): RedirectResponse
    {
        $sponsor->delete();

        return redirect()->route('admin.sponsors.index')
            ->with('success', 'Sponsor deleted successfully.');
    }
}
