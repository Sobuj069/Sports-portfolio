<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Nick Ho Motorsports</title>
    
    <!-- Google Fonts & Tailwind CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#FED60A',
                        dark: {
                            900: '#0a0a0a',
                            800: '#141414',
                            700: '#1e1e1e',
                            600: '#2a2a2a',
                        }
                    },
                    fontFamily: {
                        racing: ['Anton', 'sans-serif'],
                        sans: ['Space Grotesk', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #0a0a0a; color: #f3f4f6; }
        .font-racing { font-family: 'Anton', sans-serif; letter-spacing: 0.05em; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #141414; }
        ::-webkit-scrollbar-thumb { background: #2a2a2a; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #FED60A; }
    </style>
</head>
<body class="bg-dark-900 text-gray-200 min-h-screen flex antialiased">

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-dark-800 border-r border-dark-600 flex flex-col justify-between shrink-0 select-none">
        <div>
            <!-- Branding -->
            <div class="p-6 border-b border-dark-600 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <span class="font-racing text-2xl tracking-wider text-primary">NICK HO</span>
                    <span class="text-xs px-2 py-0.5 rounded bg-primary/20 text-primary font-bold uppercase tracking-wider">ADMIN</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1 text-sm font-medium">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 5M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-gray-500">SECTIONS</div>

                <a href="{{ route('admin.hero.edit') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.hero.*') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Hero & Profile</span>
                </a>

                <a href="{{ route('admin.races.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.races.*') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Race Calendar</span>
                </a>

                <a href="{{ route('admin.sponsors.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.sponsors.*') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Sponsors Wall</span>
                </a>

                <a href="{{ route('admin.media.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.media.*') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <span>Press & Media</span>
                </a>

                <a href="{{ route('admin.gallery.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.gallery.*') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Radial Gallery</span>
                </a>

                <a href="{{ route('admin.about.edit') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.about.*') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                    <span>Quote & About</span>
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold uppercase tracking-wider text-gray-500">MANAGEMENT</div>

                <a href="{{ route('admin.contacts.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.contacts.*') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Inquiries</span>
                    @php $unread = \App\Models\Contact::count(); @endphp
                    @if($unread > 0)
                        <span class="ml-auto text-xs px-2 py-0.5 rounded-full bg-primary/20 text-primary font-bold">{{ $unread }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.settings.edit') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-black font-semibold' : 'text-gray-400 hover:text-white hover:bg-dark-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Site Settings</span>
                </a>
            </nav>
        </div>

        <!-- Footer / Live site & Logout -->
        <div class="p-4 border-t border-dark-600 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-gray-400 hover:text-primary transition rounded-lg hover:bg-dark-700">
                <span class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Live Website</span>
                </span>
                <span class="text-primary font-bold">↗</span>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-2 w-full px-3 py-2 text-xs font-semibold text-red-400 hover:text-red-300 transition rounded-lg hover:bg-red-500/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <!-- Top Bar -->
        <header class="h-16 bg-dark-800/80 backdrop-blur border-b border-dark-600 px-8 flex items-center justify-between sticky top-0 z-20">
            <h1 class="text-xl font-bold font-racing uppercase tracking-wider text-white">@yield('title')</h1>
            <div class="flex items-center space-x-4">
                <span class="text-xs text-gray-400">Logged in as <strong class="text-white">{{ Auth::user()->name ?? 'Administrator' }}</strong></span>
                <div class="w-8 h-8 rounded-full bg-primary text-black font-bold flex items-center justify-center text-sm font-racing">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <main class="p-8 flex-1 max-w-7xl w-full mx-auto">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400 flex items-center justify-between text-sm">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-400 hover:text-white">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                    <div class="font-bold mb-1">Please fix the following errors:</div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
