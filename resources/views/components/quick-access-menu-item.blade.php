@props(['href' => '#', 'label', 'icon'])

<a href="{{ $href }}" class="group flex flex-col items-center text-center">
      <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 
            flex items-center justify-center shadow-lg shadow-emerald-500/20
            transition-all duration-300 ease-out
            group-hover:shadow-xl group-hover:shadow-emerald-500/30 
            group-hover:-translate-y-1 group-hover:scale-105">
            {!! $icon !!}
      </div>
      <p class="mt-3 text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors duration-200">
            {{ $label }}
      </p>
</a>