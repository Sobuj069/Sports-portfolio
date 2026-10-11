@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-5 relative overflow-hidden">
            <div class="text-xs font-bold uppercase tracking-wider text-gray-400">Races in Calendar</div>
            <div class="text-3xl font-racing text-white mt-2">{{ $stats['races'] }}</div>
            <a href="{{ route('admin.races.index') }}" class="text-xs text-primary hover:underline mt-3 inline-block font-medium">Manage Calendar →</a>
            <div class="absolute -right-2 -bottom-2 opacity-5 text-white font-racing text-6xl">🏁</div>
        </div>

        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-5 relative overflow-hidden">
            <div class="text-xs font-bold uppercase tracking-wider text-gray-400">Active Sponsors</div>
            <div class="text-3xl font-racing text-white mt-2">{{ $stats['sponsors'] }}</div>
            <a href="{{ route('admin.sponsors.index') }}" class="text-xs text-primary hover:underline mt-3 inline-block font-medium">Manage Logos →</a>
            <div class="absolute -right-2 -bottom-2 opacity-5 text-white font-racing text-6xl">🤝</div>
        </div>

        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-5 relative overflow-hidden">
            <div class="text-xs font-bold uppercase tracking-wider text-gray-400">Media Articles</div>
            <div class="text-3xl font-racing text-white mt-2">{{ $stats['articles'] }}</div>
            <a href="{{ route('admin.media.index') }}" class="text-xs text-primary hover:underline mt-3 inline-block font-medium">Manage News →</a>
            <div class="absolute -right-2 -bottom-2 opacity-5 text-white font-racing text-6xl">📰</div>
        </div>

        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-5 relative overflow-hidden">
            <div class="text-xs font-bold uppercase tracking-wider text-gray-400">Gallery Photos</div>
            <div class="text-3xl font-racing text-white mt-2">{{ $stats['gallery'] }}</div>
            <a href="{{ route('admin.gallery.index') }}" class="text-xs text-primary hover:underline mt-3 inline-block font-medium">Manage Photos →</a>
            <div class="absolute -right-2 -bottom-2 opacity-5 text-white font-racing text-6xl">📸</div>
        </div>

        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-5 relative overflow-hidden">
            <div class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Inquiries</div>
            <div class="text-3xl font-racing text-primary mt-2">{{ $stats['contacts'] }}</div>
            <a href="{{ route('admin.contacts.index') }}" class="text-xs text-primary hover:underline mt-3 inline-block font-medium">View Messages →</a>
            <div class="absolute -right-2 -bottom-2 opacity-5 text-white font-racing text-6xl">✉️</div>
        </div>
    </div>

    <!-- Quick Shortcuts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Hero Section Shortcut -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center space-x-3 text-primary mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <h3 class="font-racing text-lg text-white">HERO & DRIVER STATS</h3>
                </div>
                <p class="text-xs text-gray-400">Update Nick Ho's name, bio, car number, career podiums, circuits raced, and live race countdown.</p>
            </div>
            <a href="{{ route('admin.hero.edit') }}" class="mt-4 px-4 py-2 bg-dark-700 hover:bg-dark-600 text-white rounded-xl text-xs font-bold text-center transition">Edit Hero Profile</a>
        </div>

        <!-- Add Race Shortcut -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center space-x-3 text-primary mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <h3 class="font-racing text-lg text-white">ADD RACE FIXTURE</h3>
                </div>
                <p class="text-xs text-gray-400">Add a new race event to the interactive 2026 race calendar timeline with series and dates.</p>
            </div>
            <a href="{{ route('admin.races.index') }}" class="mt-4 px-4 py-2 bg-dark-700 hover:bg-dark-600 text-white rounded-xl text-xs font-bold text-center transition">Manage Races</a>
        </div>

        <!-- Add Sponsor Shortcut -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center space-x-3 text-primary mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <h3 class="font-racing text-lg text-white">ADD SPONSOR LOGO</h3>
                </div>
                <p class="text-xs text-gray-400">Upload new sponsor and partner vector logos to display on the 3D helmet logo wall.</p>
            </div>
            <a href="{{ route('admin.sponsors.index') }}" class="mt-4 px-4 py-2 bg-dark-700 hover:bg-dark-600 text-white rounded-xl text-xs font-bold text-center transition">Upload Sponsor</a>
        </div>
    </div>

    <!-- Recent Tables Split -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Upcoming Races -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-racing text-lg tracking-wider text-white">RACE CALENDAR PREVIEW</h3>
                <a href="{{ route('admin.races.index') }}" class="text-xs text-primary hover:underline">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($upcomingRaces as $race)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-dark-700/60 border border-dark-600/40 text-xs">
                        <div>
                            <div class="font-bold text-white">{{ $race->title }}</div>
                            <div class="text-gray-400 text-[11px]">{{ $race->series }}</div>
                        </div>
                        <div class="text-right">
                            <span class="font-mono text-primary font-bold">{{ $race->date_string }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500 text-xs py-4 text-center">No races scheduled.</div>
                @endforelse
            </div>
        </div>

        <!-- Latest Inquiries -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-racing text-lg tracking-wider text-white">LATEST INQUIRIES</h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-xs text-primary hover:underline">View All</a>
            </div>
            <div class="space-y-3">
                @forelse($recentContacts as $c)
                    <div class="p-3 rounded-xl bg-dark-700/60 border border-dark-600/40 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-white">{{ $c->name }}</span>
                            <span class="text-gray-400 text-[10px]">{{ $c->created_at ? $c->created_at->diffForHumans() : 'Recently' }}</span>
                        </div>
                        <div class="text-gray-400 text-[11px] mt-0.5">{{ $c->email }} @if($c->phone) • {{ $c->phone }} @endif</div>
                        @if($c->message)
                            <p class="text-gray-300 mt-2 line-clamp-1 italic text-[11px]">"{{ $c->message }}"</p>
                        @endif
                    </div>
                @empty
                    <div class="text-gray-500 text-xs py-4 text-center">No messages received yet.</div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
