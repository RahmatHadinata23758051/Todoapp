@extends('layouts.app')

@section('content')
<div class="bg-white/90 rounded-3xl shadow-2xl p-8 sm:p-10 max-w-md mx-auto animate-fade-in">
    <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-2 justify-center">
        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#60a5fa" stroke-width="2.5" fill="#dbeafe"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01" stroke="#2563eb" stroke-width="2.5"/></svg>
        Login To-Do App
    </h2>
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div>
            <label for="email" class="block mb-1 font-semibold text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-300 transition placeholder-gray-400 shadow-sm bg-white/80">
        </div>
        <div>
            <label for="password" class="block mb-1 font-semibold text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-300 transition placeholder-gray-400 shadow-sm bg-white/80">
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <label for="remember_me" class="text-sm text-gray-600">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>
        <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold rounded-xl shadow hover:scale-105 hover:from-blue-600 hover:to-blue-800 transition-all duration-200">Login</button>
        <div class="text-center text-sm mt-4">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        </div>
    </form>
</div>
@endsection
