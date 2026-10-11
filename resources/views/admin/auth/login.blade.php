<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Nick Ho Motorsports</title>
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
</head>
<body class="bg-dark-900 text-gray-200 min-h-screen flex items-center justify-center p-4 antialiased selection:bg-primary selection:text-black">

    <div class="w-full max-w-md">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <h1 class="font-racing text-4xl tracking-wider text-primary">NICK HO</h1>
            <p class="text-xs uppercase tracking-widest text-gray-400 mt-1">MOTORSPORTS MANAGEMENT CONSOLE</p>
        </div>

        <!-- Login Card -->
        <div class="bg-dark-800 border border-dark-600 rounded-2xl p-8 shadow-2xl shadow-black/80">
            <h2 class="text-lg font-bold text-white mb-6">Sign in to Admin Panel</h2>

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@nickho-motorsports.nl" required autofocus
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full bg-dark-700 border border-dark-600 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition" placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-dark-700 border-dark-600 text-primary focus:ring-0">
                        <span class="text-gray-400">Remember me</span>
                    </label>
                    <span class="text-gray-500 text-[11px]">Default: password</span>
                </div>

                <button type="submit"
                    class="w-full bg-primary hover:bg-yellow-400 text-black font-racing font-bold text-lg py-3 rounded-xl transition transform active:scale-[0.98] shadow-lg shadow-primary/20 tracking-wider uppercase">
                    LOGIN TO CONSOLE
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-dark-600/60 text-center">
                <a href="{{ route('home') }}" class="text-xs text-gray-400 hover:text-primary transition inline-flex items-center space-x-1">
                    <span>← Return to Public Website</span>
                </a>
            </div>
        </div>
    </div>

</body>
</html>
