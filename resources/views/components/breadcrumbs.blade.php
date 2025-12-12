@props(['items'])

@if ($items && count($items) > 0)
    <nav aria-label="breadcrumb">
        <ol class="flex flex-wrap text-sm text-gray-500 space-x-2 font-serif text-xl">
            @foreach ($items as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="flex items-center">
                        <a href="{{ $breadcrumb->url }}" class="text-pink-500 hover:text-pink-600 font-medium">
                            {{ $breadcrumb->title }}
                        </a>
                        <span class="mx-2">/</span>
                    </li>
                @else
                    <li class="flex items-center text-gray-700 font-semibold" aria-current="page">
                        {{ $breadcrumb->title }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
