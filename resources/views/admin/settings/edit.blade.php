@extends('admin.layouts.app')

@section('title', 'Site Settings & Socials')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-white">General Site Settings</h2>
        <p class="text-xs text-gray-400">Configure contact information, social channels, and SEO meta tags.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Contact Information -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 space-y-4">
            <h3 class="font-racing text-sm text-primary tracking-wider uppercase border-b border-dark-600 pb-2">Public Contact Info</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1">Contact Email</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? 'nick@nickho-motorsports.nl') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase text-gray-400 mb-1">Contact Phone</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '+31 6 83 63 09 88') }}" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
                </div>
            </div>
        </div>

        <!-- Social Links -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 space-y-4">
            <h3 class="font-racing text-sm text-primary tracking-wider uppercase border-b border-dark-600 pb-2">Social Channels</h3>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-400 mb-1">Instagram URL</label>
                <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? 'https://www.instagram.com/nickho_98') }}"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-400 mb-1">LinkedIn URL</label>
                <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? 'https://www.linkedin.com/in/nick-ho-042054327/') }}"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>
        </div>

        <!-- SEO Meta -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 space-y-4">
            <h3 class="font-racing text-sm text-primary tracking-wider uppercase border-b border-dark-600 pb-2">Search Engine Optimization</h3>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-400 mb-1">Page Title (Meta Title)</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? 'Nick Ho - Dutch Racing Driver | Porsche Carrera Cup') }}" required
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gray-400 mb-1">Meta Description</label>
                <textarea name="meta_description" rows="3" required
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl p-4 text-sm text-white focus:outline-none focus:border-primary">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-8 py-3 bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-lg rounded-xl transition shadow-lg shadow-primary/20 tracking-wider uppercase">
                SAVE SETTINGS
            </button>
        </div>
    </form>
</div>
@endsection
