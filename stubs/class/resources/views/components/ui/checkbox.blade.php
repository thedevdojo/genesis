@props([
    'label' => null,
    'name' => null,
    'id' => null,
])

<div class="flex items-center h-5">
    <input type="checkbox" {{ $attributes->whereStartsWith('wire:model') }} id="{{ $id ?? '' }}" name="{{ $name ?? '' }}" class="hidden peer">
    <label for="{{ $id ?? '' }}" class="peer-checked:[&_svg]:scale-100 text-sm font-medium text-neutral-600 dark:text-neutral-400 dark:peer-checked:text-gray-300 peer-checked:text-gray-800 [&_svg]:scale-0 peer-checked:[&_.custom-checkbox]:border-gray-800 peer-checked:[&_.custom-checkbox]:bg-gray-800 dark:peer-checked:[&_.custom-checkbox]:bg-white select-none flex items-center space-x-2">
        <span class="flex items-center justify-center w-5 h-5 border border-gray-300 dark:border-gray-700 rounded custom-checkbox text-neutral-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3 text-white dark:text-gray-800 duration-300 ease-out">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </span>
        <span>{{ $label ?? '' }}</span>
    </label>
</div>