@php
    $total = count($tasks);
    $done = $tasks->where('is_done', true)->count();
    $percent = $total ? round($done / $total * 100) : 0;
@endphp
@php
$labels = [
    'Pekerjaan' => 'bg-blue-200 text-blue-800',
    'Pribadi' => 'bg-pink-200 text-pink-800',
    'Urgent' => 'bg-red-200 text-red-800',
    'Santai' => 'bg-green-200 text-green-800',
    'Belajar' => 'bg-yellow-200 text-yellow-800',
];
$quotes = [
    'Jangan tunda pekerjaan hari ini, lakukan sekarang! 💪',
    'Setiap langkah kecil adalah kemajuan. 🚀',
    'Kamu lebih hebat dari yang kamu kira! 🌟',
    'Selesaikan tugas, raih impian! ✨',
    'Fokus pada satu tugas, dan selesaikan dengan baik. 🎯',
    'Tugas kecil hari ini, sukses besar esok hari! 🏆',
    'Jangan menyerah, kamu pasti bisa! 🙌',
];
$quote = $quotes[array_rand($quotes)];
@endphp
@extends('layouts.app')

@section('content')
<div x-data="modalConfirm()" class="relative flex flex-col gap-8">
    <!-- Motivasi Harian -->
    <div class="w-full text-center mb-2">
        <div class="inline-flex items-center gap-2 bg-yellow-50 border border-yellow-200 rounded-xl px-4 py-2 shadow text-yellow-700 font-semibold text-base animate-fade-in">
            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#fef9c3" stroke="#fde68a"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m-4-4v8" stroke="#facc15" stroke-width="2"/></svg>
            <span>{{ $quote }}</span>
        </div>
    </div>
    <!-- Toast Notification -->
    <div x-data="{ show: @json(session('success') ? true : false) }"
         x-show="show"
         x-transition
         class="fixed top-6 right-6 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-2"
         x-init="setTimeout(() => show = false, 2500)">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        <span>{{ session('success') }}</span>
    </div>

    <!-- Progress Bar & Tambah Tugas -->
    <div class="mb-2">
        <div class="flex justify-between items-center mb-1">
            <span class="text-sm text-gray-600">Progress</span>
            <span class="text-sm font-semibold text-green-600">{{ $percent }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
            <div class="bg-gradient-to-r from-green-400 to-emerald-500 h-3 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('tasks.create') }}"
               class="w-full sm:w-auto inline-flex items-center gap-2 text-sm px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl shadow-lg hover:scale-105 hover:from-green-600 hover:to-emerald-700 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Tugas
            </a>
        </div>
    </div>

    <div class="space-y-8">
    @forelse($tasks as $task)
        @php $loopIndex = $loop->iteration; @endphp
        <div class="group bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-gray-100 p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:scale-[1.025] hover:shadow-2xl transition-all duration-300 animate-fade-in">
            <div class="flex-1 min-w-0 w-full">
                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-1">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold text-base shadow">{{ $loopIndex }}</span>
                    <span class="text-2xl">{{ $task->is_done ? '✅' : '🕒' }}</span>
                    <h5 class="text-base sm:text-lg font-semibold truncate max-w-[60vw] sm:max-w-xs {{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-800' }} group-hover:text-blue-700 transition">
                        {{ $task->title }}
                    </h5>
                    @if($task->label)
                        <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-semibold shadow {{ $labels[$task->label] ?? 'bg-gray-200 text-gray-700' }}">{{ $task->label }}</span>
                    @endif
                </div>
                @if($task->description)
                <p class="text-gray-500 mb-3 break-words text-xs sm:text-sm">{{ $task->description }}</p>
                @endif
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mt-2">
                    <form :id="'delete-form-' + {{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="button" @click="open({{ $task->id }})" class="w-full sm:w-auto px-3 py-1.5 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 hover:scale-105 text-xs sm:text-sm font-medium transition flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            Hapus
                        </button>
                    </form>
                    <a href="{{ route('tasks.edit', $task->id) }}"
                       class="w-full sm:w-auto px-3 py-1.5 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500 hover:scale-105 text-xs sm:text-sm font-medium transition flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6v-6H3v6z"/></svg>
                        Edit
                    </a>
                    <a href="{{ route('tasks.show', $task->id) }}"
                       class="w-full sm:w-auto px-3 py-1.5 bg-blue-400 text-white rounded-lg shadow hover:bg-blue-500 hover:scale-105 text-xs sm:text-sm font-medium transition flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Detail
                    </a>
                </div>
            </div>
            <div class="flex flex-col items-end gap-2 min-w-[120px] w-full sm:w-auto">
                @if($task->deadline)
                    @php $isLate = \Carbon\Carbon::parse($task->deadline)->isPast() && !$task->is_done; @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold tracking-wide shadow border-2 mb-1
                        {{ $isLate ? 'bg-red-200 text-red-700 border-red-300 animate-pulse' : 'bg-blue-100 text-blue-700 border-blue-200' }} truncate max-w-[40vw] sm:max-w-xs">
                        <svg class="w-4 h-4 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/></svg>
                        {{ $isLate ? 'Tenggat Lewat: ' : 'Deadline: ' }}{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                    </span>
                @endif
                <span class="inline-block px-4 py-1 rounded-full text-xs font-bold tracking-wide shadow border-2
                    {{ $task->is_done ? 'bg-green-500/90 text-white border-green-400' : 'bg-yellow-400/90 text-gray-900 border-yellow-300 animate-pulse-slow' }} truncate max-w-[40vw] sm:max-w-xs">
                    {{ $task->is_done ? 'Selesai' : 'Belum selesai' }}
                </span>
            </div>
        </div>
    @empty
        <div class="flex flex-col items-center justify-center py-16 animate-fade-in">
            <svg class="w-24 h-24 text-blue-200 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="#fef9c3" stroke="#aee9f7"/><ellipse cx="12" cy="16" rx="6" ry="2" fill="#b6e2a1"/><ellipse cx="9" cy="10" rx="1.5" ry="2" fill="#fff"/><ellipse cx="15" cy="10" rx="1.5" ry="2" fill="#fff"/><ellipse cx="12" cy="14" rx="4" ry="2" fill="#fff"/><ellipse cx="12" cy="13" rx="2" ry="1" fill="#aee9f7"/></svg>
            <div class="text-lg text-blue-400 font-semibold mb-2">Belum ada tugas.<br><span class="text-base text-gray-400 font-normal">{{ $quote }}</span></div>
            <a href="{{ route('tasks.create') }}" class="px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition mt-2">Tambah Tugas Pertama</a>
        </div>
    @endforelse
    </div>

    <!-- Floating Action Button (FAB) for mobile -->
    <a href="{{ route('tasks.create') }}"
       class="sm:hidden fixed bottom-6 right-6 z-50 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-full shadow-xl p-4 flex items-center justify-center hover:scale-110 transition-all duration-200">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
    </a>

    <!-- Modal Konfirmasi Hapus -->
    <div x-show="show" x-transition.opacity x-transition.scale.origin.center class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-xs w-full text-center relative animate-fade-in">
            <div class="flex justify-center mb-4">
                <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="#f87171" stroke-width="2.5" fill="#fee2e2"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 9l-6 6m0-6l6 6" stroke="#f87171" stroke-width="2.5"/></svg>
            </div>
            <h3 class="text-lg font-bold mb-2 text-gray-800">Konfirmasi Hapus</h3>
            <p class="text-gray-500 mb-6">Yakin ingin menghapus tugas ini? Tindakan ini tidak bisa dibatalkan.</p>
            <div class="flex gap-2 justify-center">
                <button @click="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">Ya, Hapus</button>
                <button @click="close" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow hover:bg-gray-300 transition">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Alpine.js Modal Logic -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function modalConfirm() {
    return {
        show: false,
        formId: null,
        open(id) {
            this.formId = id;
            this.show = true;
        },
        close() {
            this.show = false;
            this.formId = null;
        },
        confirmDelete() {
            if (this.formId) {
                document.getElementById('delete-form-' + this.formId).submit();
                this.close();
            }
        }
    }
}
</script>
@endsection
