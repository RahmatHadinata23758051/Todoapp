<div x-data="{ date: '' }" x-init="date = new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"
    class="font-mono text-sm sm:text-base px-3 py-2 rounded-lg bg-yellow-100 text-yellow-700 shadow select-none text-center max-w-xs w-full mb-2 sm:mb-0 break-words">
    <svg class="w-5 h-5 inline-block mr-2 align-middle text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="4" fill="#fffbe6" stroke="#ffe066" stroke-width="2"/><rect x="7" y="2" width="2" height="4" rx="1" fill="#ffe066"/><rect x="15" y="2" width="2" height="4" rx="1" fill="#ffe066"/></svg>
    <span x-text="date"></span>
</div>
