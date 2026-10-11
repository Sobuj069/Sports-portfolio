@extends('admin.layouts.app')

@section('title', 'Quote & About Text')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-white">Edit Highlight Quote Section</h2>
        <p class="text-xs text-gray-400">The quote features highlighted yellow spans matching Nick Ho's signature statement.</p>
    </div>

    <!-- Live Preview Box -->
    <div class="mb-8 p-6 bg-black border border-dark-600 rounded-2xl relative overflow-hidden">
        <span class="text-[10px] uppercase font-mono tracking-widest text-gray-500 block mb-2">LIVE WEBSITE PREVIEW:</span>
        <blockquote class="text-xl md:text-2xl font-racing tracking-wide text-white leading-relaxed">
            {{ $settings['quote_part1'] ?? "I’m driven by progress, by finding that" }}
            <span class="text-primary">{{ $settings['quote_highlight1'] ?? "one percent of improvement" }}</span>
            {{ $settings['quote_part2'] ?? "that most people overlook. Every mistake is a lesson, every session a chance, to become" }}
            <span class="text-primary">{{ $settings['quote_highlight2'] ?? "sharper, more focused, more complete." }}</span>
        </blockquote>
    </div>

    <form action="{{ route('admin.about.update') }}" method="POST" class="bg-dark-800 border border-dark-600 rounded-2xl p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-xs font-semibold uppercase text-gray-400 mb-1">Quote Lead Text</label>
            <input type="text" name="quote_part1" value="{{ old('quote_part1', $settings['quote_part1'] ?? 'I’m driven by progress, by finding that') }}" required
                class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase text-primary mb-1">Yellow Highlight Text 1</label>
            <input type="text" name="quote_highlight1" value="{{ old('quote_highlight1', $settings['quote_highlight1'] ?? 'one percent of improvement') }}" required
                class="w-full bg-dark-700 border border-primary/50 rounded-xl px-4 py-2.5 text-sm text-primary font-bold focus:outline-none focus:border-primary">
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase text-gray-400 mb-1">Quote Middle Text</label>
            <textarea name="quote_part2" rows="2" required
                class="w-full bg-dark-700 border border-dark-600 rounded-xl p-4 text-sm text-white focus:outline-none focus:border-primary">{{ old('quote_part2', $settings['quote_part2'] ?? 'that most people overlook. Every mistake is a lesson, every session a chance, to become') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase text-primary mb-1">Yellow Highlight Text 2</label>
            <input type="text" name="quote_highlight2" value="{{ old('quote_highlight2', $settings['quote_highlight2'] ?? 'sharper, more focused, more complete.') }}" required
                class="w-full bg-dark-700 border border-primary/50 rounded-xl px-4 py-2.5 text-sm text-primary font-bold focus:outline-none focus:border-primary">
        </div>

        <div class="pt-4 flex justify-end">
            <button type="submit"
                class="px-8 py-3 bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-lg rounded-xl transition shadow-lg shadow-primary/20 tracking-wider uppercase">
                SAVE QUOTE
            </button>
        </div>
    </form>
</div>
@endsection
