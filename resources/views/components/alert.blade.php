@props(['type' => 'success', 'message'])

@php
$styles = [
'success' => 'bg-emerald-50 border-emerald-400 text-emerald-800',
'error' => 'bg-red-50 border-red-400 text-red-800',
'warning' => 'bg-amber-50 border-amber-400 text-amber-800',
'info' => 'bg-blue-50 border-blue-400 text-blue-800',
];
$icons = [
'success' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
'error' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
'warning' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
'info' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition
      class="flex items-start gap-3 border-l-4 rounded-lg px-4 py-3 {{ $styles[$type] ?? $styles['info'] }}"
      role="alert">
      <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icons[$type] ?? $icons['info'] }}" />
      </svg>
      <p class="text-sm font-medium flex-1">{{ $message }}</p>
      <button @click="show = false" class="opacity-60 hover:opacity-100 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
      </button>
</div>