@extends('admin.layouts.app')

@section('title', 'Visitor Inquiries')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-white">Contact Form Submissions</h2>
            <p class="text-xs text-gray-400">Inquiries sent via the website contact form are saved directly to database.</p>
        </div>
        <span class="text-xs bg-dark-800 border border-dark-600 px-3 py-1.5 rounded-xl text-gray-300 font-mono">
            Total Messages: <strong class="text-primary">{{ $contacts->total() }}</strong>
        </span>
    </div>

    <!-- Contacts Table -->
    <div class="bg-dark-800 border border-dark-600 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-xs">
            <thead class="bg-dark-700/80 text-gray-400 uppercase text-[10px] tracking-wider border-b border-dark-600">
                <tr>
                    <th class="py-3.5 px-4">Date</th>
                    <th class="py-3.5 px-4">Sender Name</th>
                    <th class="py-3.5 px-4">Contact Info</th>
                    <th class="py-3.5 px-4">Company</th>
                    <th class="py-3.5 px-4">Message</th>
                    <th class="py-3.5 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-600/60">
                @forelse($contacts as $c)
                    <tr class="hover:bg-dark-700/40 transition">
                        <td class="py-3.5 px-4 whitespace-nowrap text-gray-400 text-[11px] font-mono">
                            {{ $c->created_at ? $c->created_at->format('M d, Y H:i') : 'N/A' }}
                        </td>
                        <td class="py-3.5 px-4 font-bold text-white whitespace-nowrap">{{ $c->name }}</td>
                        <td class="py-3.5 px-4 whitespace-nowrap">
                            <a href="mailto:{{ $c->email }}" class="text-primary hover:underline block">{{ $c->email }}</a>
                            @if($c->phone)
                                <a href="tel:{{ $c->phone }}" class="text-gray-400 text-[11px] hover:underline">{{ $c->phone }}</a>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-gray-300">{{ $c->company ?? '—' }}</td>
                        <td class="py-3.5 px-4 text-gray-300 max-w-md">
                            <p class="line-clamp-2">{{ $c->message }}</p>
                        </td>
                        <td class="py-3.5 px-4 text-right whitespace-nowrap">
                            <form action="{{ route('admin.contacts.destroy', $c) }}" method="POST" class="inline" onsubmit="return confirm('Delete this inquiry message?');">
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
                        <td colspan="6" class="py-12 text-center text-gray-500 text-xs">No visitor messages received yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $contacts->links() }}
    </div>

</div>
@endsection
