<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaArticle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaArticleController extends Controller
{
    /**
     * List all press & media articles.
     */
    public function index(): View
    {
        $articles = MediaArticle::orderBy('sort_order')->get();

        return view('admin.media.index', compact('articles'));
    }

    /**
     * Store a new media article.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:500'],
            'url' => ['required', 'url', 'max:500'],
            'image' => ['required', 'file', 'mimes:avif,webp,png,jpg,jpeg', 'max:10240'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $filename);
            $imagePath = $filename;
        }

        MediaArticle::create([
            'title' => $validated['title'],
            'url' => $validated['url'],
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? (MediaArticle::max('sort_order') + 1),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media article added successfully.');
    }

    /**
     * Update an existing media article.
     */
    public function update(Request $request, MediaArticle $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:500'],
            'url' => ['required', 'url', 'max:500'],
            'image' => ['nullable', 'file', 'mimes:avif,webp,png,jpg,jpeg', 'max:10240'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $filename);
            $article->image_path = $filename;
        }

        $article->title = $validated['title'];
        $article->url = $validated['url'];
        $article->sort_order = $validated['sort_order'] ?? $article->sort_order;
        $article->is_active = $request->has('is_active');
        $article->save();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media article updated successfully.');
    }

    /**
     * Delete a media article.
     */
    public function destroy(MediaArticle $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media article deleted successfully.');
    }
}
