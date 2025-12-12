@props([
    'href' => '#',
    'icon' => 'bi-circle',
    'label' => 'Menu',
    'active' => false,
    'target' => null,
])

<a href="{{ $href }}"
   @if($target) target="{{ $target }}" @endif
    @if($label === 'Logout') id="logout-btn" @endif
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-medium transition-all duration-300
          hover:bg-white/20 hover:shadow-lg hover:translate-x-2
          {{ $active ? 'bg-white/25 font-semibold shadow-xl border border-white/30' : '' }}">
  
  <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/10 
              group-hover:bg-white/20 transition-all duration-300 group-hover:rotate-12">
      <i class="bi {{ $icon }} text-2xl"></i>
  </div>

  <span class="text-base">{{ $label }}</span>

  <i class="bi bi-chevron-right ml-auto opacity-0 group-hover:opacity-100 transition-all duration-300"></i>
</a>
