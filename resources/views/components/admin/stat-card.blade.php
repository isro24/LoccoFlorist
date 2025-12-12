@props(['title','value','icon','badgeText','color'=>'primary'])

@php
$colors = [
    'primary' => ['bg' => 'bg-pinkBg', 'text' => 'text-pinkColor', 'bgBadge' => 'bg-lightPinkBg'],
    'success' => ['bg' => 'bg-greenBg', 'text' => 'text-greenColor', 'bgBadge' => 'bg-lightGreenBg'],
    'warning' => ['bg' => 'bg-yellowBg', 'text' => 'text-yellowColor', 'bgBadge' => 'bg-lightYellowBg'],
    'info' => ['bg' => 'bg-blueBg', 'text' => 'text-blueColor', 'bgBadge' => 'bg-lightBlueBg'],
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
