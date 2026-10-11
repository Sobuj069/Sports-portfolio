<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Show general settings edit form.
     */
    public function edit(): View
    {
        $settings = SiteSetting::allKeyed();

        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'contact_email' => ['required', 'email'],
            'contact_phone' => ['required', 'string'],
            'instagram_url' => ['nullable', 'url'],
            'linkedin_url' => ['nullable', 'url'],
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string', 'max:500'],
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, 'general');
        }

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Site settings updated successfully.');
    }
}
