<?php

?>
<x-layouts.app>
    <div class="flex items-center justify-center w-screen h-screen">
    @volt('test')
        <div x-data="{ open: false, media: '👍', type: 'emoji' }"
            @media-selected.window="
                console.log(event);
                open = false;
                media = event.detail.value; 
                type = event.detail.type;
            "  class="relative" @click.outside="open=false">
            <p @click="open=!open" class="flex items-center justify-center w-10 h-10 rounded cursor-pointer bg-neutral-100">
                <template x-if="type=='emoji'"><span x-text="media"></span></template>
                <template x-if="type!='emoji'"><img :src="media" class="max-w-xs" ></template>
            </p>
            <div x-show="open" class="absolute bottom-0 left-0 z-20 pt-1 mt-12 ml-6 -translate-x-1/2 translate-y-full" x-cloak>
                <livewire:media-selector eventCallback="media-selected" />
            </div>
        </div>
    @endvolt
    </div>
</x-layouts.app>