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
        <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#facc15" stroke-width="2.5" fill="#fef9c3"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01" stroke="#eab308" stroke-width="2.5"/></svg>
        <h2 class="text-2xl font-bold text-yellow-700">Edit Tugas</h2>
    </div>

    @if ($errors->any())
        <div class="mb-4 px-4 py-2 bg-red-50 text-red-800 rounded-lg border border-red-200 shadow flex items-center gap-2">
            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#f87171" stroke-width="2" fill="#fee2e2"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 9l-6 6m0-6l6 6" stroke="#f87171" stroke-width="2"/></svg>
            <ul class="list-disc pl-5 mb-0 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="title" class="block mb-1 font-semibold text-gray-700">Judul Tugas</label>
            <div class="relative">
                <input type="text" name="title" id="title" required value="{{ old('title', $task->title) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-300 transition placeholder-gray-400 pr-10 shadow-sm bg-white/80">
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-yellow-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 01-8 0"/></svg>
                </span>
            </div>
        </div>

        <div>
            <label for="description" class="block mb-1 font-semibold text-gray-700">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-200 transition placeholder-gray-400 shadow-sm bg-white/80">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label for="deadline" class="block mb-1 font-semibold text-gray-700">Deadline</label>
            <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $task->deadline) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 transition placeholder-gray-400 shadow-sm bg-white/80">
        </div>

        <div>
            <label for="label" class="block mb-1 font-semibold text-gray-700">Kategori/Label</label>
            <select name="label" id="label"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-pink-200 transition placeholder-gray-400 shadow-sm bg-white/80">
                <option value="">Pilih Label</option>
                @foreach($labels as $label => $class)
                    <option value="{{ $label }}" @selected(old('label', $task->label) == $label)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-2 mt-2">
            <input type="hidden" name="is_done" value="0">
            <input type="checkbox" name="is_done" value="1" id="is_done"
                class="h-5 w-5 text-green-500 border-gray-300 rounded focus:ring-green-400 transition"
                {{ old('is_done', $task->is_done) ? 'checked' : '' }}>
            <label for="is_done" class="text-gray-700 select-none">Tandai sebagai selesai</label>
        </div>

        <div class="flex gap-2 mt-6">
            <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-yellow-300 to-yellow-400 text-gray-900 font-semibold rounded-xl shadow hover:scale-105 hover:from-yellow-400 hover:to-yellow-500 transition-all duration-200">Update</button>
            <a href="{{ route('tasks.index') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-xl shadow hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
