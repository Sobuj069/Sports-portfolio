@extends('admin.layouts.app')

@section('title', 'Press & Media Articles')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-white">Manage Press & News Coverage</h2>
            <p class="text-xs text-gray-400">Articles appear in the media cards swiper slider on the home page.</p>
        </div>
        <button onclick="document.getElementById('addMediaModal').classList.remove('hidden')"
            class="px-5 py-2.5 bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm rounded-xl transition tracking-wider uppercase flex items-center space-x-2">
            <span>+ ADD NEW ARTICLE</span>
        </button>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $a)
            <div class="bg-dark-800 border border-dark-600 rounded-2xl overflow-hidden flex flex-col justify-between group hover:border-primary/50 transition">
                <div>
                    <!-- Article Thumbnail -->
                    <div class="h-44 bg-dark-900 relative overflow-hidden">
                        <img src="{{ asset('assets/images/' . $a->image_path) }}" alt="{{ $a->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-3 left-3 bg-black/70 backdrop-blur px-2 py-0.5 rounded text-[10px] font-mono text-primary font-bold">#{{ $a->sort_order }}</span>
                    </div>

                    <div class="p-5">
                        <h3 class="font-bold text-white text-sm line-clamp-2 leading-snug">{{ $a->title }}</h3>
                        <a href="{{ $a->url }}" target="_blank" class="mt-3 inline-flex items-center space-x-1 text-xs text-primary hover:underline font-medium">
                            <span>Read Original Article</span>
                            <span>↗</span>
                        </a>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="p-5 pt-0 flex items-center justify-between border-t border-dark-700/60 mt-2">
                    <span class="text-[10px] {{ $a->is_active ? 'text-green-400' : 'text-gray-500' }}">
                        {{ $a->is_active ? '● Active' : '○ Hidden' }}
                    </span>

                    <form action="{{ route('admin.media.destroy', $a) }}" method="POST" onsubmit="return confirm('Delete this article?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-400 hover:text-red-300 font-semibold">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-500 text-xs">No media articles added yet.</div>
        @endforelse
    </div>

</div>

<!-- Add Media Modal -->
<div id="addMediaModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-dark-800 border border-dark-600 rounded-2xl max-w-lg w-full p-6 shadow-2xl">
        <div class="flex items-center justify-between pb-4 border-b border-dark-600">
            <h3 class="font-racing text-lg text-white">ADD MEDIA ARTICLE</h3>
            <button onclick="document.getElementById('addMediaModal').classList.add('hidden')" class="text-gray-400 hover:text-white text-xl">&times;</button>
        </div>

        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Article Headline / Title</label>
                <textarea name="title" rows="2" required placeholder="e.g. Nick Ho claims victory at Assen..."
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Article External Link (URL)</label>
                <input type="url" name="url" required placeholder="https://www.racexpress.nl/..."
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Thumbnail Photo (AVIF / WebP / JPG / PNG)</label>
                <input type="file" name="image" required accept=".avif,.webp,.jpg,.jpeg,.png"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2 text-xs text-white file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary file:text-black hover:file:bg-yellow-400">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Sort Order #</label>
                <input type="number" name="sort_order" value="{{ count($articles) + 1 }}"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" id="media_active" checked value="1"
                    class="rounded bg-dark-700 border-dark-600 text-primary focus:ring-0">
                <label for="media_active" class="text-xs text-gray-300 font-medium">Visible on public slider</label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3">
                <button type="button" onclick="document.getElementById('addMediaModal').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl bg-dark-700 hover:bg-dark-600 text-xs font-semibold text-gray-300">Cancel</button>
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm uppercase">Add Article</button>
            </div>
        </form>
    </div>
</div>
@endsection
