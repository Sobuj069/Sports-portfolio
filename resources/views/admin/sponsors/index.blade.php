@extends('admin.layouts.app')

@section('title', 'Sponsors & Partners Wall')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-white">Manage Sponsor Logos</h2>
            <p class="text-xs text-gray-400">All logos uploaded here display on the 3D rotating helmet wall.</p>
        </div>
        <button onclick="document.getElementById('addSponsorModal').classList.remove('hidden')"
            class="px-5 py-2.5 bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm rounded-xl transition tracking-wider uppercase flex items-center space-x-2">
            <span>+ UPLOAD NEW SPONSOR</span>
        </button>
    </div>

    <!-- Sponsors Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse($sponsors as $s)
            <div class="bg-dark-800 border border-dark-600 rounded-2xl p-4 flex flex-col justify-between group hover:border-primary/50 transition">
                <div>
                    <!-- Logo Display Box -->
                    <div class="h-24 bg-dark-900 rounded-xl flex items-center justify-center p-3 mb-3 border border-dark-700">
                        <img src="{{ asset('assets/images/' . $s->logo_path) }}" alt="{{ $s->name }}" class="max-h-full max-w-full object-contain filter invert opacity-90 group-hover:opacity-100 transition">
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-white truncate" title="{{ $s->name }}">{{ $s->name }}</span>
                        <span class="text-[10px] font-mono text-gray-500">#{{ $s->sort_order }}</span>
                    </div>

                    @if($s->website_url)
                        <a href="{{ $s->website_url }}" target="_blank" class="text-[10px] text-primary truncate block hover:underline mt-0.5">{{ $s->website_url }}</a>
                    @endif
                </div>

                <!-- Card Actions -->
                <div class="mt-4 pt-3 border-t border-dark-700/60 flex items-center justify-between">
                    <span class="text-[10px] {{ $s->is_active ? 'text-green-400' : 'text-gray-500' }}">
                        {{ $s->is_active ? '● Active' : '○ Hidden' }}
                    </span>

                    <form action="{{ route('admin.sponsors.destroy', $s) }}" method="POST" onsubmit="return confirm('Delete this sponsor logo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[10px] text-red-400 hover:text-red-300 font-semibold">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-500 text-xs">No sponsor logos added yet.</div>
        @endforelse
    </div>

</div>

<!-- Add Sponsor Modal -->
<div id="addSponsorModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-dark-800 border border-dark-600 rounded-2xl max-w-md w-full p-6 shadow-2xl">
        <div class="flex items-center justify-between pb-4 border-b border-dark-600">
            <h3 class="font-racing text-lg text-white">UPLOAD SPONSOR LOGO</h3>
            <button onclick="document.getElementById('addSponsorModal').classList.add('hidden')" class="text-gray-400 hover:text-white text-xl">&times;</button>
        </div>

        <form action="{{ route('admin.sponsors.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Sponsor / Brand Name</label>
                <input type="text" name="name" required placeholder="e.g. Porsche Twente"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Logo File (SVG / PNG / AVIF)</label>
                <input type="file" name="logo" required accept=".svg,.png,.webp,.avif,.jpg,.jpeg"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2 text-xs text-white file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary file:text-black hover:file:bg-yellow-400">
                <p class="text-[10px] text-gray-500 mt-1">SVG vector logos look best against the dark 3D backdrop.</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Website URL (Optional)</label>
                <input type="url" name="website_url" placeholder="https://..."
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Sort Order #</label>
                <input type="number" name="sort_order" value="{{ count($sponsors) + 1 }}"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" id="sponsor_active" checked value="1"
                    class="rounded bg-dark-700 border-dark-600 text-primary focus:ring-0">
                <label for="sponsor_active" class="text-xs text-gray-300 font-medium">Visible on logo wall</label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3">
                <button type="button" onclick="document.getElementById('addSponsorModal').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl bg-dark-700 hover:bg-dark-600 text-xs font-semibold text-gray-300">Cancel</button>
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm uppercase">Upload</button>
            </div>
        </form>
    </div>
</div>
@endsection
