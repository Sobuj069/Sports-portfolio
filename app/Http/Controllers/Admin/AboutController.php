<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Show the about & quotes edit form.
     */
    public function edit(): View
    {
        $settings = SiteSetting::allKeyed();

        return view('admin.about.edit', compact('settings'));
    }

    /**
     * Update the quote settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'quote_part1' => ['required', 'string'],
            'quote_highlight1' => ['required', 'string'],
            'quote_part2' => ['required', 'string'],
            'quote_highlight2' => ['required', 'string'],
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, 'about');
        }

        return redirect()->route('admin.about.edit')
            ->with('success', 'Quote and About text updated successfully.');
    }
}
