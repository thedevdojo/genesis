@props(['type', 'size', 'tag', 'href'])

@php
    $defaultClasses = 'px-4 py-2 text-sm font-medium rounded-md';

    switch ($size ?? 'md') {
        case 'sm':
            $sizeClasses = 'px-2.5 py-1.5 text-xs font-medium rounded-md';
            break;
        case 'md':
            $sizeClasses = $defaultClasses;
            break;
        case 'lg':
            $sizeClasses = 'px-5 py-3  text-sm font-medium rounded-md';
            break;
        case 'xl':
            $sizeClasses = 'px-6 py-3.5 text-base font-medium rounded-md';
            break;
        case '2xl':
            $sizeClasses = 'px-7 py-4 text-base font-medium rounded-md';
            break;
        default:
            $sizeClasses = $defaultClasses;
            break;
    }
@endphp

@php
$primaryButtonClasses = 'bg-gray-900 text-gray-100 hover:bg-gray-800 focus:ring-2 focus:ring-gray-900 focus:ring-offset-2';
switch ($type ?? 'primary') {
    case 'primary':
        $typeClasses = $primaryButtonClasses;
        break;
    case 'secondary':
        $typeClasses = 'bg-white rounded-md border text-gray-500 hover:text-gray-700 border-gray-200/70 hover:bg-gray-50 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200/60 focus:shadow-outline';
        break;
    default:
        $typeClasses = $primaryButtonClasses;
        break;
}
@endphp

@php
switch ($tag ?? 'button') {
    case 'button':
        $tagAttr = 'button type="button"';
        $tagClose = 'button';
        break;
    case 'submit':
        $tagAttr = 'button type="submit"';
        $tagClose = 'button';
        break;
    case 'a':
        $link = $href ?? '';
        $tagAttr = 'a  href="' . $link . '"';
        $tagClose = 'a';
        break;
    default:
        $tagAttr = 'button type="button"';
        $tagClose = 'button';
        break;
}
@endphp

<{!! $tagAttr !!} {!! $attributes->except(['class']) !!} class="{{ $sizeClasses }} {{ $typeClasses }} cursor-pointer inline-flex w-full justify-center items-center font-medium focus:outline-none">
    {{ $slot }}
</{{ $tagClose }}>
