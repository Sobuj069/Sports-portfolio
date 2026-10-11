<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroController extends Controller
{
    /**
     * Show the hero section edit form.
     */
    public function edit(): View
    {
        $settings = SiteSetting::allKeyed();

        return view('admin.hero.edit', compact('settings'));
    }

    /**
     * Update the hero section settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'driver_name' => ['required', 'string', 'max:100'],
            'hero_bio' => ['required', 'string'],
            'hero_subquote' => ['nullable', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
            'years_in_motorsport' => ['required', 'string', 'max:50'],
            'age' => ['required', 'string', 'max:50'],
            'car_number' => ['required', 'string', 'max:50'],
            'podiums' => ['required', 'string', 'max:50'],
            'circuits_raced' => ['required', 'string', 'max:50'],
            'next_race_name' => ['required', 'string', 'max:100'],
            'next_race_time' => ['nullable', 'string', 'max:100'],
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, 'hero');
        }

        return redirect()->route('admin.hero.edit')
            ->with('success', 'Hero section updated successfully.');
    }
}
