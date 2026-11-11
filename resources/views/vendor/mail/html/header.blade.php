@props(['url'])
<tr>
    <td class="header">
        {{-- Text instead of the inline SVG logo, which Gmail and Outlook don't display --}}
        <a href="{{ $url }}" style="display: inline-block;">
            {{ $slot }}
        </a>
    </td>
</tr>
