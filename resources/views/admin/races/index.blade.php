@extends('admin.layouts.app')

@section('title', 'Race Calendar 2026')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-white">Manage Race Calendar Events</h2>
            <p class="text-xs text-gray-400">All races listed here dynamically appear in the 2026 timeline with dates and series.</p>
        </div>
        <button onclick="document.getElementById('addRaceModal').classList.remove('hidden')"
            class="px-5 py-2.5 bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm rounded-xl transition tracking-wider uppercase flex items-center space-x-2">
            <span>+ ADD NEW RACE</span>
        </button>
    </div>

    <!-- Races Table -->
    <div class="bg-dark-800 border border-dark-600 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-xs">
            <thead class="bg-dark-700/80 text-gray-400 uppercase text-[10px] tracking-wider border-b border-dark-600">
                <tr>
                    <th class="py-3.5 px-4 w-12 text-center">#</th>
                    <th class="py-3.5 px-4">Race Event Name</th>
                    <th class="py-3.5 px-4">Championship / Series</th>
                    <th class="py-3.5 px-4">Date Range</th>
                    <th class="py-3.5 px-4 text-center">Status</th>
                    <th class="py-3.5 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-600/60">
                @forelse($races as $race)
                    <tr class="hover:bg-dark-700/40 transition">
                        <td class="py-3.5 px-4 text-center font-mono text-gray-400">{{ $race->sort_order }}</td>
                        <td class="py-3.5 px-4">
                            <span class="font-bold text-white text-sm block">{{ $race->title }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-gray-300">{{ $race->series }}</td>
                        <td class="py-3.5 px-4 font-mono text-primary font-bold">{{ $race->date_string }}</td>
                        <td class="py-3.5 px-4 text-center">
                            @if($race->is_active)
                                <span class="px-2 py-0.5 rounded-full bg-green-500/10 text-green-400 font-semibold text-[10px]">Active</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-gray-500/10 text-gray-400 font-semibold text-[10px]">Hidden</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right space-x-2">
                            <button onclick="openEditModal({{ json_encode($race) }})"
                                class="px-3 py-1 bg-dark-700 hover:bg-dark-600 text-white rounded-lg text-xs font-semibold transition">
                                Edit
                            </button>

                            <form action="{{ route('admin.races.destroy', $race) }}" method="POST" class="inline" onsubmit="return confirm('Delete this race?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg text-xs font-semibold transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500">No race fixtures added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<!-- Add Race Modal -->
<div id="addRaceModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-dark-800 border border-dark-600 rounded-2xl max-w-lg w-full p-6 shadow-2xl">
        <div class="flex items-center justify-between pb-4 border-b border-dark-600">
            <h3 class="font-racing text-lg text-white">ADD NEW RACE EVENT</h3>
            <button onclick="document.getElementById('addRaceModal').classList.add('hidden')" class="text-gray-400 hover:text-white text-xl">&times;</button>
        </div>

        <form action="{{ route('admin.races.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Event Title</label>
                <input type="text" name="title" required placeholder="e.g. Race 1 - WEC Imola"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Championship / Series</label>
                <input type="text" name="series" required placeholder="e.g. Porsche Sixt Carrera Cup Deutschland"
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-1">Date String</label>
                    <input type="text" name="date_string" required placeholder="e.g. 17-19.04.2026"
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-1">Sort Order #</label>
                    <input type="number" name="sort_order" value="{{ count($races) + 1 }}"
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
                </div>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" id="add_active" checked value="1"
                    class="rounded bg-dark-700 border-dark-600 text-primary focus:ring-0">
                <label for="add_active" class="text-xs text-gray-300 font-medium">Visible on public calendar</label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3">
                <button type="button" onclick="document.getElementById('addRaceModal').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl bg-dark-700 hover:bg-dark-600 text-xs font-semibold text-gray-300">Cancel</button>
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm uppercase">Add Race</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Race Modal -->
<div id="editRaceModal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-dark-800 border border-dark-600 rounded-2xl max-w-lg w-full p-6 shadow-2xl">
        <div class="flex items-center justify-between pb-4 border-b border-dark-600">
            <h3 class="font-racing text-lg text-white">EDIT RACE EVENT</h3>
            <button onclick="document.getElementById('editRaceModal').classList.add('hidden')" class="text-gray-400 hover:text-white text-xl">&times;</button>
        </div>

        <form id="editRaceForm" method="POST" class="mt-4 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Event Title</label>
                <input type="text" id="edit_title" name="title" required
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 mb-1">Championship / Series</label>
                <input type="text" id="edit_series" name="series" required
                    class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-1">Date String</label>
                    <input type="text" id="edit_date_string" name="date_string" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-1">Sort Order #</label>
                    <input type="number" id="edit_sort_order" name="sort_order"
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-primary">
                </div>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" id="edit_active" value="1"
                    class="rounded bg-dark-700 border-dark-600 text-primary focus:ring-0">
                <label for="edit_active" class="text-xs text-gray-300 font-medium">Visible on public calendar</label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3">
                <button type="button" onclick="document.getElementById('editRaceModal').classList.add('hidden')"
                    class="px-4 py-2 rounded-xl bg-dark-700 hover:bg-dark-600 text-xs font-semibold text-gray-300">Cancel</button>
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-sm uppercase">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(race) {
        document.getElementById('edit_title').value = race.title;
        document.getElementById('edit_series').value = race.series;
        document.getElementById('edit_date_string').value = race.date_string;
        document.getElementById('edit_sort_order').value = race.sort_order;
        document.getElementById('edit_active').checked = !!race.is_active;

        document.getElementById('editRaceForm').action = "/admin/races/" + race.id;
        document.getElementById('editRaceModal').classList.remove('hidden');
    }
</script>
@endsection
