<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * List all gallery images.
     */
    public function index(): View
    {
        $gallery = GalleryItem::orderBy('sort_order')->get();

        return view('admin.gallery.index', compact('gallery'));
    }

    /**
     * Store a new gallery item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:avif,webp,png,jpg,jpeg', 'max:15360'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $filename);
            $imagePath = $filename;
        }

        GalleryItem::create([
            'title' => $validated['title'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? (GalleryItem::max('sort_order') + 1),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery photo added successfully.');
    }

    /**
     * Update an existing gallery item.
     */
    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:avif,webp,png,jpg,jpeg', 'max:15360'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $filename);
            $gallery->image_path = $filename;
        }

        $gallery->title = $validated['title'] ?? null;
        $gallery->sort_order = $validated['sort_order'] ?? $gallery->sort_order;
        $gallery->is_active = $request->has('is_active');
        $gallery->save();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery photo updated successfully.');
    }

    /**
     * Delete a gallery photo.
     */
    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery photo deleted successfully.');
    }
}
