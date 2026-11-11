@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'required' => true,
    'autofocus' => false,
])

@php
    // the model name for @error, whatever wire:model modifier is used (.live, .blur, ...)
    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $errorId = ($id ?? $name ?? $wireModel).'-error';
@endphp

<div>
    @if($label)
        <label for="{{ $id ?? '' }}" class="block text-sm font-medium leading-5 text-gray-700 dark:text-gray-300">
            {{ $label  }}
        </label>
    @endif

    <div data-model="{{ $wireModel }}" class="mt-1.5 rounded-md shadow-sm">
        <input
            {{ $attributes->class([
                'appearance-none flex w-full h-10 px-3 py-2 text-sm bg-white dark:text-gray-300 dark:bg-white/[4%] border rounded-md border-gray-300 dark:border-white/10 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-gray-300 dark:focus:border-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200/60 dark:focus:ring-white/20 disabled:cursor-not-allowed disabled:opacity-50',
                'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red-200' => isset($errors) && $errors->has($wireModel),
            ]) }}
            id="{{ $id ?? '' }}"
            name="{{ $name ?? '' }}"
            type="{{ $type ?? '' }}"
            @required($required)
            @if($autofocus) autofocus @endif
            @error($wireModel) aria-invalid="true" aria-describedby="{{ $errorId }}" @enderror
        />
    </div>

    @error($wireModel)
        <p id="{{ $errorId }}" class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
