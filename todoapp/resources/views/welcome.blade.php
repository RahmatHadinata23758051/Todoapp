@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] text-center">
    <div class="bg-white/90 dark:bg-[#232946]/80 backdrop-blur-md rounded-3xl shadow-xl p-8 sm:p-12 w-full animate-fade-in">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-blue-700 dark:text-yellow-200 mb-4 flex items-center justify-center gap-2">
            🎯 <span>Welcome to To-Do App</span>
        </h1>
        <p class="text-gray-600 dark:text-gray-200 text-lg mb-8">Kelola tugas harianmu dengan mudah, cepat, dan tampilan modern.</p>
        <a href="{{ route('tasks.index') }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow hover:scale-105 hover:from-blue-700 hover:to-purple-700 transition-all duration-200 text-lg">
            🚀 Mulai Sekarang
        </a>
    </div>
</div>
@endsection
