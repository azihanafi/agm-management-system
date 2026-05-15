<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGM 2026 - Voting System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0a0a0f;
            color: #e2e8f0;
        }

        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .accent-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #991b1b 100%);
        }

        .glow {
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
        }
    </style>
    @livewireStyles
</head>

<body class="min-h-screen flex flex-col">
    <nav class="glass sticky top-0 z-50 px-6 py-4 flex justify-between items-center border-b border-white/5">

        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/FJB.png') }}" alt="FJB Logo" class="h-10 w-auto">
            <span class="text-xl font-black tracking-tighter uppercase italic text-white">AGM <span
                    class="text-red-500">2026</span></span>
        </div>
        @auth
            <div class="flex items-center space-x-4">
                <span class="text-sm text-slate-400">{{ Auth::user()->name }}</span>
                <div class="w-2 h-2 rounded-full {{ Auth::user()->isPresent() ? 'bg-green-500' : 'bg-red-500' }}"></div>
            </div>
        @endauth
    </nav>

    <main class="flex-grow container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="p-6 text-center text-sm text-slate-600">
        &copy; 2026 Sports Club Annual Grand Meeting. All Rights Reserved.
    </footer>

    @livewireScripts
</body>

</html>