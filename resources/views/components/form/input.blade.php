@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '' 
])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-semibold text-pink-600 mb-1">{{ $label }}</label>
    <input type="{{ $type }}"
           id="{{ $name }}"
           name="{{ $name }}"
           value="{{ old($name, $value) }}"
           {{ $attributes }}
           class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-500 @error($name) border-red-500 @enderror"
    >
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
