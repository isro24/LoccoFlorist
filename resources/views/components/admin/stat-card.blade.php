@props(['title','value','icon','badgeText','color'=>'primary'])

@php
$colors = [
    'primary' => ['bg' => 'bg-pink-500', 'text' => 'text-pink-500', 'bgBadge' => 'bg-pink-100'],
    'success' => ['bg' => 'bg-green-500', 'text' => 'text-green-500', 'bgBadge' => 'bg-green-100'],
    'warning' => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-500', 'bgBadge' => 'bg-yellow-100'],
    'info' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-500', 'bgBadge' => 'bg-blue-100'],
];
$colorClass = $colors[$color] ?? $colors['primary'];
@endphp

<div class="bg-white shadow-sm rounded-lg p-4 h-full transform transition duration-300 hover:-translate-y-1 hover:shadow-xl flex flex-col justify-between">
    <div class="flex justify-between items-center">
        <div>
            <p class="text-gray-400 text-sm mb-1">{{ $title }}</p>
            <h3 class="text-xl font-bold">{{ $value }}</h3>
        </div>
        <div class="w-14 h-14 flex items-center justify-center rounded-xl {{ $colorClass['bg'] }} text-white text-2xl">
            <i class="bi {{ $icon }}"></i>
        </div>
    </div>
    <div class="mt-2">
        <span class="inline-flex items-center text-xs px-2 py-1 rounded {{ $colorClass['bgBadge'] }} {{ $colorClass['text'] }}">
            {!! $badgeText !!}
        </span>
    </div>
</div>
