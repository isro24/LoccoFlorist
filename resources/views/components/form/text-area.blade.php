@props([
    'name',
    'label',
    'rows' => 3,
    'value' => '' 
])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-semibold text-pink-600 mb-1">{{ $label }}</label>
    <textarea id="{{ $name }}"
              name="{{ $name }}"
              rows="{{ $rows }}"
              {{ $attributes }}
              class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-500 @error($name) border-red-500 @enderror"
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
