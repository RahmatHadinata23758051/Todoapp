@extends('layouts.app')

@section('content')
<div class="bg-white/90 rounded-3xl shadow-2xl p-8 sm:p-10 max-w-md mx-auto animate-fade-in">
    <h2 class="text-2xl font-bold text-green-700 mb-6 flex items-center gap-2 justify-center">
        <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#4ade80" stroke-width="2.5" fill="#bbf7d0"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01" stroke="#22c55e" stroke-width="2.5"/></svg>
        Register To-Do App
    </h2>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block mb-1 font-semibold text-gray-700">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-300 transition placeholder-gray-400 shadow-sm bg-white/80">
        </div>
        <div>
            <label for="email" class="block mb-1 font-semibold text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-300 transition placeholder-gray-400 shadow-sm bg-white/80">
        </div>
        <div>
            <label for="password" class="block mb-1 font-semibold text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-300 transition placeholder-gray-400 shadow-sm bg-white/80">
        </div>
        <div>
            <label for="password_confirmation" class="block mb-1 font-semibold text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-300 transition placeholder-gray-400 shadow-sm bg-white/80">
        </div>
        <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-green-400 to-emerald-500 text-white font-semibold rounded-xl shadow hover:scale-105 hover:from-green-500 hover:to-emerald-600 transition-all duration-200">Register</button>
        <div class="text-center text-sm mt-4">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-green-600 hover:underline">Login</a>
        </div>
    </form>
</div>
@endsection
