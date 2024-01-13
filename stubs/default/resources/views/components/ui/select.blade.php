@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'options' => [],
    'selected'=>null
])

@php $wireModel = $attributes->get('wire:model');@endphp
<div>

    <div data-model="{{ $wireModel }}" class="mt-1.5 rounded-md shadow-sm">
        <label for="{{ $id }}"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
        <select {{ $attributes->whereStartsWith('wire:model') }} id="{{ $id }}" name="{{ $name }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option >Seleccione</option>
            @foreach ($options as $idoption => $option)
                <option value="{{ $idoption }}" @if($selected !=null and $idoption===$selected) selected @endif >{{ $option }}</option>
            @endforeach
        </select>
        @error($wireModel)
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
