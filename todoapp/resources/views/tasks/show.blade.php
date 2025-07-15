@php
$labels = [
    'Pekerjaan' => 'bg-blue-200 text-blue-800',
    'Pribadi' => 'bg-pink-200 text-pink-800',
    'Urgent' => 'bg-red-200 text-red-800',
    'Santai' => 'bg-green-200 text-green-800',
    'Belajar' => 'bg-yellow-200 text-yellow-800',
];
@endphp
@extends('layouts.app')

@section('content')
<div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-8 sm:p-10 max-w-lg mx-auto animate-fade-in">
    <div class="flex items-center gap-2 mb-6">
        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#60a5fa" stroke-width="2.5" fill="#dbeafe"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01" stroke="#2563eb" stroke-width="2.5"/></svg>
        <h2 class="text-2xl font-bold text-blue-700">Detail Tugas</h2>
    </div>
    <div class="mb-6 flex flex-col gap-2">
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold text-base shadow">{{ $task->id }}</span>
            <h3 class="text-xl font-semibold {{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-800' }}">{{ $task->title }}</h3>
            @if($task->label)
                <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-semibold shadow {{ $labels[$task->label] ?? 'bg-gray-200 text-gray-700' }}">{{ $task->label }}</span>
            @endif
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-block px-4 py-1 rounded-full text-xs font-bold tracking-wide shadow border-2
                {{ $task->is_done ? 'bg-green-500/90 text-white border-green-400' : 'bg-yellow-400/90 text-gray-900 border-yellow-300 animate-pulse-slow' }}">
                {{ $task->is_done ? 'Selesai' : 'Belum selesai' }}
            </span>
            @if($task->deadline)
                @php $isLate = \Carbon\Carbon::parse($task->deadline)->isPast() && !$task->is_done; @endphp
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wide shadow border-2
                    {{ $isLate ? 'bg-red-200 text-red-700 border-red-300 animate-pulse' : 'bg-blue-100 text-blue-700 border-blue-200' }}">
                    <svg class="w-4 h-4 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/></svg>
                    {{ $isLate ? 'Tenggat Lewat: ' : 'Deadline: ' }}{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                </span>
            @endif
        </div>
    </div>
    <div class="mb-6">
        <div class="text-gray-600 text-base">{{ $task->description ?: 'Tidak ada deskripsi.' }}</div>
    </div>
    <div class="flex gap-2 mt-6">
        <a href="{{ route('tasks.edit', $task->id) }}" class="flex-1 px-4 py-2 bg-yellow-400 text-gray-900 font-semibold rounded-xl shadow hover:scale-105 hover:bg-yellow-500 transition">Edit</a>
        <a href="{{ route('tasks.index') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-xl shadow hover:bg-gray-300 transition">Kembali</a>
    </div>
</div>
@endsection
