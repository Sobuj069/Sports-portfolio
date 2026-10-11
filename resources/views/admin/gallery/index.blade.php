@extends('admin.layouts.app')

@section('title', 'Radial Gallery Photos')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-white">Manage Gallery Slider Photos</h2>
            <p class="text-xs text-gray-400">All photos uploaded here dynamically appear in the radial rotating track slider.</p>
        </div>
        <button onclick="document.getElementById('addGalleryModal').classList.remove('hidden')"
            class="px-5 py-2.5 bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm rounded-xl transition tracking-wider uppercase flex items-center space-x-2">
            <span>+ UPLOAD PHOTO</span>
        </button>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @forelse($gallery as $item)
            <div class="bg-dark-800 border border-dark-600 rounded-2xl overflow-hidden group hover:border-primary/50 transition flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-dark-900 relative overflow-hidden">
                        <img src="{{ asset('assets/images/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-2 left-2 bg-black/70 backdrop-blur px-2 py-0.5 rounded text-[10px] font-mono text-primary font-bold">#{{ $item->sort_order }}</span>
                    </div>

                    <div class="p-3">
                        <span class="text-xs font-semibold text-white truncate block">{{ $item->title ?? 'Untitled Photo' }}</span>
                    </div>
                </div>

                <div class="p-3 pt-0 border-t border-dark-700/60 flex items-center justify-between">
                    <span class="text-[10px] {{ $item->is_active ? 'text-green-400' : 'text-gray-500' }}">
                        {{ $item->is_active ? '● Active' : '○ Hidden' }}
                    </span>

                    <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this photo from gallery?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-400 hover:text-red-300 font-semibold">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-500 text-xs">No gallery photos uploaded yet.</div>
        @endforelse
    </div>

</div>

<!-- Add Gallery Modal -->
<div id="addGalleryModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-dark-800 border border-dark-600 rounded-2xl max-w-md w-full p-6 shadow-2xl">
        <div class="flex items-center justify-between pb-4 border-b border-dark-600">
            <h3 class="font-racing text-lg text-white">UPLOAD GALLERY PHOTO</h3>
            <button onclick="document.getElementById('addGalleryModal').classList.add('hidden')" class="text-gray-400 hover:text-white text-xl">&times;</button>
        </div>

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Photo Caption / Title (Optional)</label>
                <input type="text" name="title" placeholder="e.g. Zolder Round 6"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Image File (AVIF / WebP / JPG / PNG)</label>
                <input type="file" name="image" required accept=".avif,.webp,.jpg,.jpeg,.png"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2 text-xs text-white file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary file:text-black hover:file:bg-yellow-400">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Sort Order #</label>
                <input type="number" name="sort_order" value="{{ count($gallery) + 1 }}"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" id="gallery_active" checked value="1"
                    class="rounded bg-dark-700 border-dark-600 text-primary focus:ring-0">
                <label for="gallery_active" class="text-xs text-gray-300 font-medium">Visible in radial slider</label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3">
                <button type="button" onclick="document.getElementById('addGalleryModal').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl bg-dark-700 hover:bg-dark-600 text-xs font-semibold text-gray-300">Cancel</button>
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm uppercase">Upload</button>
            </div>
        </form>
    </div>
</div>
@endsection
