@props(['type' => 'info', 'message'])

@if($message)
    @php
        $colors = [
            'success' => 'bg-green-500 text-white',
            'error' => 'bg-red-500 text-white',
            'warning' => 'bg-yellow-400 text-gray-900',
            'info' => 'bg-blue-500 text-white',
        ];
        $colorClass = $colors[$type] ?? 'bg-gray-500 text-white';

        $icons = [
            'success' => 'check-circle',
            'error' => 'exclamation-circle', 
            'warning' => 'exclamation-triangle',
            'info' => 'information-circle',
        ];
        $iconName = $icons[$type] ?? 'information-circle';
    @endphp

    <div x-data="{ show: true }"
         x-show="show"
         x-transition
         class="flex items-center px-4 py-3 rounded-lg shadow-md {{ $colorClass }} mb-4"
    >
        @if($iconName === 'check-circle')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m0 0a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
        @elseif($iconName === 'exclamation-circle')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 110 20 10 10 0 010-20z" />
            </svg>
        @elseif($iconName === 'exclamation-triangle')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.29 3.86L1.82 18a1 1 0 00.86 1.5h18.64a1 1 0 00.86-1.5L13.71 3.86a1 1 0 00-1.72 0zM12 9v4m0 4h.01" />
            </svg>
        @elseif($iconName === 'information-circle')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20 10 10 0 010-20z" />
            </svg>
        @endif

        <span class="text-sm">{{ $message }}</span>
    </div>

    <script>
        setTimeout(() => {
            const alertEl = document.currentScript.previousElementSibling;
            if(alertEl) {
                alertEl.classList.add('opacity-0', 'transition', 'duration-500');
                setTimeout(() => alertEl.remove(), 500);
            }
        }, 3000);
    </script>
@endif
