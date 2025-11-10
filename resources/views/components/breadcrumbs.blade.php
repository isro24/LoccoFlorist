@props(['items'])

@if ($items && count($items) > 0)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($items as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->url }}" class="text-pink">{{ $breadcrumb->title }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $breadcrumb->title }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif