@extends('admin.layouts.app')

@section('title', 'Hero Section & Driver Profile')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-white">Edit Hero & Driver Information</h2>
            <p class="text-xs text-gray-400">All changes made here dynamically update the live 3D hero stage, stats odometer, and bio.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 bg-dark-700 hover:bg-dark-600 text-xs font-bold text-primary rounded-xl transition">
            Preview on Site ↗
        </a>
    </div>

    <form action="{{ route('admin.hero.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Driver Identity -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 space-y-4">
            <h3 class="font-racing text-sm text-primary tracking-wider uppercase border-b border-dark-600 pb-2">Driver Identity</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Driver Name</label>
                    <input type="text" name="driver_name" value="{{ old('driver_name', $settings['driver_name'] ?? 'Nick Ho') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">City & Country</label>
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" name="city" value="{{ old('city', $settings['city'] ?? 'Rotterdam') }}" placeholder="City" required
                            class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                        <input type="text" name="country" value="{{ old('country', $settings['country'] ?? 'The Netherlands') }}" placeholder="Country" required
                            class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Driver Bio / Main Tagline</label>
                <textarea name="hero_bio" rows="3" required
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl p-4 text-sm text-white focus:outline-none focus:border-primary transition leading-relaxed">{{ old('hero_bio', $settings['hero_bio'] ?? '') }}</textarea>
                <p class="text-[11px] text-gray-500 mt-1">Displayed directly underneath the large Nick Ho heading.</p>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Sub-Quote / Mantra</label>
                <input type="text" name="hero_subquote" value="{{ old('hero_subquote', $settings['hero_subquote'] ?? '') }}"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
            </div>
        </div>

        <!-- Career Statistics (Odometers) -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 space-y-4">
            <h3 class="font-racing text-sm text-primary tracking-wider uppercase border-b border-dark-600 pb-2">Career Numbers & Stats</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Car Number</label>
                    <input type="text" name="car_number" value="{{ old('car_number', $settings['car_number'] ?? '98') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Career Podiums</label>
                    <input type="text" name="podiums" value="{{ old('podiums', $settings['podiums'] ?? '17') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Circuits Raced</label>
                    <input type="text" name="circuits_raced" value="{{ old('circuits_raced', $settings['circuits_raced'] ?? '14') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Years in Motorsport</label>
                    <input type="text" name="years_in_motorsport" value="{{ old('years_in_motorsport', $settings['years_in_motorsport'] ?? '10+') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Current Age</label>
                    <input type="text" name="age" value="{{ old('age', $settings['age'] ?? '21') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                </div>
            </div>
        </div>

        <!-- Next Race Countdown -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 space-y-4">
            <h3 class="font-racing text-sm text-primary tracking-wider uppercase border-b border-dark-600 pb-2">Next Race Countdown Timer</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Countdown Label</label>
                    <input type="text" name="next_race_name" value="{{ old('next_race_name', $settings['next_race_name'] ?? 'Next race') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1.5">Next Race Datetime String</label>
                    <input type="text" name="next_race_time" value="{{ old('next_race_time', $settings['next_race_time'] ?? 'February 20, 2026 14:10') }}"
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary transition" placeholder="e.g. February 20, 2026 14:10">
                    <p class="text-[11px] text-gray-500 mt-1">This drives the live odometer countdown clock in the hero section.</p>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex items-center justify-end space-x-4">
            <button type="submit"
                class="px-8 py-3 bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-lg rounded-xl transition shadow-lg shadow-primary/20 tracking-wider uppercase">
                SAVE CHANGES
            </button>
        </div>
    </form>
</div>
@endsection
