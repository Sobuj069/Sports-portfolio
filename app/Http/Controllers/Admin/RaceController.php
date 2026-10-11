<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Race;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RaceController extends Controller
{
    /**
     * List all races in the calendar.
     */
    public function index(): View
    {
        $races = Race::orderBy('sort_order')->get();

        return view('admin.races.index', compact('races'));
    }

    /**
     * Store a new race.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'series' => ['required', 'string', 'max:255'],
            'date_string' => ['required', 'string', 'max:100'],
            'race_time' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? (Race::max('sort_order') + 1);
        $validated['is_active'] = $request->has('is_active');

        Race::create($validated);

        return redirect()->route('admin.races.index')
            ->with('success', 'Race added to calendar successfully.');
    }

    /**
     * Update an existing race.
     */
    public function update(Request $request, Race $race): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'series' => ['required', 'string', 'max:255'],
            'date_string' => ['required', 'string', 'max:100'],
            'race_time' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $race->update($validated);

        return redirect()->route('admin.races.index')
            ->with('success', 'Race updated successfully.');
    }

    /**
     * Delete a race from calendar.
     */
    public function destroy(Race $race): RedirectResponse
    {
        $race->delete();

        return redirect()->route('admin.races.index')
            ->with('success', 'Race deleted successfully.');
    }
}
