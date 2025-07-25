<!DOCTYPE html>
<html lang="en"
      x-data="{ dark: localStorage.getItem('theme') === 'dark' }"
      :class="{ 'dark': dark }"
      x-init="$watch('dark', val => localStorage.setItem('theme', val ? 'dark' : 'light'))">
<head>
    <meta charset="UTF-8">
    <title>To-Do App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="relative min-h-screen overflow-x-hidden bg-gradient-to-b from-blue-100 via-white to-yellow-50 text-gray-900 dark:bg-gradient-to-b dark:from-[#232946] dark:via-[#232946] dark:to-[#393e46] dark:text-white">

    <!-- Background SVG -->
    <div class="hidden sm:block">
        <svg class="absolute top-10 left-10 w-32 opacity-20 z-0 pointer-events-none" viewBox="0 0 128 48"><ellipse cx="40" cy="24" rx="40" ry="18" fill="#fff"/><ellipse cx="90" cy="28" rx="30" ry="12" fill="#fff" fill-opacity="0.7"/></svg>
        <svg class="absolute top-20 right-20 w-40 opacity-20 z-0 pointer-events-none" viewBox="0 0 160 60"><ellipse cx="60" cy="30" rx="50" ry="18" fill="#fff" fill-opacity="0.6"/><ellipse cx="120" cy="35" rx="35" ry="12" fill="#fff" fill-opacity="0.4"/></svg>
        <svg class="absolute top-24 left-1/2 w-12 opacity-20 z-0 pointer-events-none" viewBox="0 0 48 24"><path d="M2 12 Q12 2 24 12 Q36 22 46 12" stroke="#60a5fa" stroke-width="2" fill="none"/></svg>
        <svg class="absolute top-4 right-4 w-20 z-0 animate-spin-slow pointer-events-none" viewBox="0 0 64 64"><circle cx="32" cy="32" r="20" fill="#ffe066" stroke="#ffd60a" stroke-width="4"/><circle cx="26" cy="28" r="2" fill="#fff"/><circle cx="38" cy="28" r="2" fill="#fff"/><path d="M26 38 Q32 44 38 38" stroke="#fff" stroke-width="2" fill="none"/></svg>
        <svg class="absolute bottom-0 left-10 w-16 z-0 pointer-events-none" viewBox="0 0 40 60"><ellipse cx="20" cy="40" rx="18" ry="18" fill="#b6e2a1"/><rect x="16" y="40" width="8" height="20" rx="3" fill="#8d5524"/></svg>
        <svg class="absolute bottom-0 left-40 w-12 z-0 pointer-events-none" viewBox="0 0 32 48"><ellipse cx="16" cy="32" rx="14" ry="14" fill="#b6e2a1"/><rect x="13" y="32" width="6" height="16" rx="2" fill="#8d5524"/></svg>
        <svg class="absolute bottom-0 right-20 w-14 z-0 pointer-events-none" viewBox="0 0 36 54"><ellipse cx="18" cy="36" rx="15" ry="15" fill="#b6e2a1"/><rect x="15" y="36" width="6" height="18" rx="2" fill="#8d5524"/></svg>
        <img src="/images/hill.svg" class="absolute bottom-0 left-0 w-full select-none pointer-events-none z-0" alt="Hill" />
    </div>

    <!-- Maskot Kartun -->
    <div class="hidden sm:flex fixed bottom-4 right-4 z-10 flex-col items-end pointer-events-none max-w-xs">
        <svg class="w-20 h-20 animate-bounce pointer-events-none" viewBox="0 0 64 64"><ellipse cx="32" cy="40" rx="20" ry="16" fill="#fff" stroke="#333" stroke-width="2"/><ellipse cx="32" cy="28" rx="12" ry="10" fill="#fff" stroke="#333" stroke-width="2"/><ellipse cx="28" cy="28" rx="2" ry="2.5" fill="#333"/><ellipse cx="36" cy="28" rx="2" ry="2.5" fill="#333"/><ellipse cx="32" cy="34" rx="4" ry="2" fill="#f9b384"/><path d="M24 22 Q22 18 28 20" stroke="#bfa76f" stroke-width="2" fill="none"/><path d="M40 22 Q42 18 36 20" stroke="#bfa76f" stroke-width="2" fill="none"/></svg>
        <div class="bg-white/90 dark:bg-[#232946] border border-yellow-200 dark:border-yellow-700 rounded-xl shadow px-3 py-2 mt-2 text-sm text-yellow-700 dark:text-yellow-200 animate-wave pointer-events-none max-w-xs break-words">
            Hi, siap menuntaskan tugasmu hari ini?
        </div>
    </div>

    <!-- Kalender Mini -->
    <div class="hidden sm:block fixed bottom-4 left-4 z-10">
        @include('partials.calendar')
    </div>

    <!-- Header -->
    <header class="relative z-20 w-full max-w-2xl mx-auto px-4 pt-6 pb-2 flex flex-col sm:flex-row gap-y-1 items-center sm:items-center justify-between bg-white/70 dark:bg-[#232946]/80 backdrop-blur-md rounded-2xl shadow-lg mt-4">
        <div class="flex flex-col sm:flex-row w-full sm:w-auto items-center gap-2 sm:gap-3 justify-between">
            <div class="flex items-center gap-2 w-full sm:w-auto justify-center sm:justify-start">
                <span class="text-2xl">📝</span>
                <span class="font-extrabold text-lg sm:text-2xl text-blue-700 dark:text-yellow-200 tracking-tight drop-shadow">To-Do App</span>
            </div>
            <div class="flex flex-wrap gap-2 w-full sm:w-auto justify-center sm:justify-end items-center">
                <!-- Jam -->
                <div x-data="{ time: '' }" x-init="setInterval(() => { const d = new Date(); time = d.toLocaleTimeString('id-ID', { hour12: false }); }, 1000)" class="font-mono text-sm sm:text-lg px-3 py-1 rounded-lg bg-blue-100 dark:bg-[#232946] text-blue-700 dark:text-yellow-200 shadow select-none">
                    <span x-text="time"></span>
                </div>
                <!-- Tombol toggle mode -->
                <button type="button"
                        @click="dark = !dark"
                        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-100 to-blue-300 dark:from-[#232946] dark:to-[#232946] border-2 border-white shadow text-xl transition">
                    <span x-show="!dark">🌙</span>
                    <span x-show="dark">☀️</span>
                </button>
                <span class="text-xs sm:text-sm text-gray-500 dark:text-yellow-200">Hi, @auth{{ Auth::user()->name }}@else User @endauth</span>
                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-blue-200 to-green-200 dark:from-[#393e46] dark:to-[#232946] border-2 border-white shadow">
                    <span class="text-xl">🐮</span>
                </span>
                @auth
                <form method="POST" action="{{ route('logout') }}" class="ml-0 sm:ml-2">
                    @csrf
                    <button type="submit" class="px-2 py-1 sm:px-3 sm:py-1 rounded-lg bg-red-500 text-white text-xs sm:text-sm font-semibold shadow hover:bg-red-600 transition">Logout</button>
                </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="flex-1 flex items-center justify-center px-2 py-8 relative z-10 w-full pb-24 sm:pb-0">
        <div class="w-full max-w-2xl mx-auto animate-fade-in">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
