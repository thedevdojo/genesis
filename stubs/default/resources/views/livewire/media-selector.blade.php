<?php

use function Livewire\Volt\{state, rules, on, usesFileUploads, mount};

usesFileUploads();

state([
    'emoji' => '',
    'image_string' => '',
    'image_url' => '',
    'imageUpload' => '',
    'type' => '',
    'height' => '300px',
    'sections' => ['emoji', 'upload', 'link'],
    'section' => 'upload',
    'submit_processing' => false,
    'eventCallback' => '',
    'recommended' => ''
]);

rules(['imageUpload' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:30000']);

on(['mediaSelectorImageUpload' => function () {
    $this->validate();

    $url = $this->image_upload->store('assets', 'public');
}]);

mount(function ($media = '') {
    if (! is_array($this->sections)) {
        $this->sections = explode(',', $this->sections);
    }
    if (isset($this->type) && $this->type != '') {
        $this->section = $this->type;
    } else {
        $this->type = 'emoji';
    }

    if (isset($this->type) && $this->type == 'emoji') {
        $this->emoji = $media;
    } else {
        $this->image_string = $media;
    }
});

$isStringHasEmojis = function($string)
{
    $emojis_regex =
        '/[\x{0080}-\x{02AF}'
        .'\x{0300}-\x{03FF}'
        .'\x{0600}-\x{06FF}'
        .'\x{0C00}-\x{0C7F}'
        .'\x{1DC0}-\x{1DFF}'
        .'\x{1E00}-\x{1EFF}'
        .'\x{2000}-\x{209F}'
        .'\x{20D0}-\x{214F}'
        .'\x{2190}-\x{23FF}'
        .'\x{2460}-\x{25FF}'
        .'\x{2600}-\x{27EF}'
        .'\x{2900}-\x{29FF}'
        .'\x{2B00}-\x{2BFF}'
        .'\x{2C60}-\x{2C7F}'
        .'\x{2E00}-\x{2E7F}'
        .'\x{3000}-\x{303F}'
        .'\x{A490}-\x{A4CF}'
        .'\x{E000}-\x{F8FF}'
        .'\x{FE00}-\x{FE0F}'
        .'\x{FE30}-\x{FE4F}'
        .'\x{1F000}-\x{1F02F}'
        .'\x{1F0A0}-\x{1F0FF}'
        .'\x{1F100}-\x{1F64F}'
        .'\x{1F680}-\x{1F6FF}'
        .'\x{1F910}-\x{1F96B}'
        .'\x{1F980}-\x{1F9E0}]/u';
    preg_match($emojis_regex, $string, $matches);

    return ! empty($matches);
};

$updatedImageUpload = function()
{
    $this->validate();

    $url = $this->imageUpload->store('assets', 'public');

    $this->dispatch('image-upload-complete', url: $url);
};

$uploadImage = function()
{
    $this->validate();

    $url = $this->image_upload->store('assets', 'public');


    $this->dispatchBrowserEvent('notificationSuccess', [
        'message' => 'Successfully uploaded image',
    ]);
};

?>

<div class="w-full h-full">
    <style>
        .picmo-picker .header{
            background: none;
            border-bottom: 1px solid #dededf;
        }

        .picmo-picker .emojiCategory .categoryName{
            background: none !important;
        }
    </style>
    <div x-data="{
            section : @entangle('section'),
            emoji: @entangle('emoji'),
            image_string: @entangle('image_string'),
            image_upload_url: '',
            submit_processing: @entangle('submit_processing'),
            isThisStringAValidImageURL: function(string, successCallback, errorCallback){
                var img = new Image();
                img.onload = successCallback; 
                img.onerror = errorCallback;
                img. src = string;
            },
            submitImageUpload: function(){

            },
            submitImageLink: function(){
                let that = this;
                this.isThisStringAValidImageURL(this.image_string, 
                    function(){
                        that.submit_processing = false;
                        window.dispatchEvent(new CustomEvent('{{ $eventCallback }}', { detail: { 'value': that.image_string, 'type': 'link' }} ));
                    },
                    function(){
                        window.dispatchEvent(new CustomEvent('notificationError', {
                            detail: {
                                message: 'The image link you entered is an invalid image.'
                            }
                        }));
                        that.submit_processing = false;
                    }
                );
            }
        }" 
        @image-upload-complete.window="
            image_upload_url = '{{ Storage::disk("public")->url("/") }}' + event.detail.url;
            window.dispatchEvent(new CustomEvent('{{ $eventCallback }}', { detail: { 'value': image_upload_url, 'type' : 'upload' }} ));
        "
        class="w-full h-full text-gray-800 bg-white border border-gray-200 rounded-lg shadow-xl media-selector" style="width:427px; height:{{ $height }};">
        {{-- Top Menu --}}
        <div class="h-auto flex border-b border-gray-200 items-center justify-between p-1.5 tab-top">
            
            {{-- Menu Items --}}
            <div class="flex space-x-2 font-medium text-gray-600 tabs">
                @if(in_array('emoji', $sections))
                    <div @click="section='emoji'" class="relative hover:bg-gray-200 px-2.5 py-2 rounded-md cursor-pointer flex items-center justify-center leading-none text-xs">
                        <span>Emoji</span>
                        <div x-show="section=='emoji'" class="absolute bottom-0 translate-y-1.5 w-full h-0.5 bg-blue-500"></div>
                    </div>
                @endif

                @if(in_array('upload', $sections))
                    <div @click="section='upload'" class="relative hover:bg-gray-200 px-2.5 py-2 rounded-md cursor-pointer flex items-center justify-center leading-none text-xs">
                        <span>Upload Image</span>
                        <div x-show="section=='upload'" class="absolute bottom-0 translate-y-1.5 w-full h-0.5 bg-blue-500"></div>
                    </div>
                @endif

                @if(in_array('link', $sections))
                    <div @click="section='link'" class="relative hover:bg-gray-200 px-2.5 py-2 rounded-md cursor-pointer flex items-center justify-center leading-none text-xs">
                        <span>Link</span>
                        <div x-show="section=='link'" class="absolute bottom-0 translate-y-1.5 w-full h-0.5 bg-blue-500"></div>
                    </div>
                @endif
            </div>

            @if(in_array('emoji', $sections))
                {{-- Right Menu Items --}}
                <div class="flex text-gray-400">
                    <div onclick="selectRandomEmoji()" class="relative hover:bg-gray-750 px-2.5 py-2 rounded-md cursor-pointer flex items-center justify-center leading-none text-xs">
                        <span>Random</span>
                    </div>
                </div>
            @endif

        </div>

        @if(in_array('emoji', $sections))
            {{-- Main Content Area --}}
            <div x-show="section=='emoji'" wire:ignore class="relative flex items-center justify-center w-full h-auto p-0">
                <div class="relative emojiPicker" style="top:5px;"></div>
            </div>
        @endif
        @if(in_array('upload', $sections))
            <div x-show="section=='upload'" class="relative flex items-center justify-center w-full h-auto p-1">
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="
                        isUploading = false;
                    "
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                 class="flex flex-col items-center justify-center w-full px-2 py-3 space-y-2">

                    <div x-show="!isUploading" class="relative w-full h-full text-center">
                        <label class="block w-full max-w-full px-3 py-2 mb-2 text-sm font-medium text-center text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-400">
                            <span class="text-white">Choose an image</span>
                            <input 
                                type="file" 
                                wire:model="imageUpload" 
                                class="hidden w-full h-full" 
                                {{-- onchange="window.livewire.emit('mediaSelectorImageUpload')" --}}
                                />
                        </label>
                        <p class="text-xs text-gray-400">Select an image to upload. Max upload 1MB</p>
                        @if(auth()->user())
                            <p class="mt-2 text-xs font-medium text-blue-400 underline cursor-pointer">Upgrade to Pro to upload more than 1MB</p>
                        @endif
                        @if($recommended)
                            <p class="mt-2 text-xs text-gray-400">Recommended size is {{ $recommended }} pixels</p>
                        @endif
                    </div>

                    <!-- Progress Bar -->
                    <div x-show="isUploading && progress != 100" class="w-full text-center">
                        <div class="relative w-full h-2 overflow-hidden bg-gray-600 rounded-full">
                            <div class="absolute h-full bg-blue-600" :style="`width: ${progress}%`"></div>
                        </div>
                        <p class="mt-2 text-xs text-gray-400">Uploading Image (<span x-text="progress"></span>%)</p>
                    </div>
                    <div x-show="isUploading && progress == 100" class="p-4 text-center">
                        <svg class="w-6 h-6 mx-auto text-gray-400 animate-pulse" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g fill="none" stroke="none"><path d="M4.25 15.25C2.96461 14.2882 2.75 13.1762 2.75 12C2.75 9.94957 4.20204 8.23828 6.13392 7.83831C7.01365 5.45184 9.30808 3.75 12 3.75C15.3711 3.75 18.1189 6.41898 18.2454 9.75913C19.9257 9.8846 21.25 11.2876 21.25 13C21.25 14.0407 20.5 15 19.75 15.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.5005 11.1779C13.7529 10.0496 12.4886 9.27991 11.7569 10.1164L8.0388 14.3672C7.40728 15.0892 7.87136 16.2934 8.78113 16.2934L11.0889 16.2934L10.5182 18.8494C10.266 19.9792 11.5334 20.7479 12.2639 19.9082L15.9602 15.6591C16.589 14.9363 16.1243 13.7352 15.2159 13.7352L12.9285 13.7352L13.5005 11.1779Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                        <p class="mt-1 text-xs font-medium text-gray-400">Finishing Upload</p>
                    </div>
                </div>
            </div>
        @endif
        @if(in_array('link', $sections))
            <div x-show="section=='link'" class="relative flex items-center justify-center w-full h-auto p-1">
                <div class="flex flex-col items-center justify-center w-full px-2 py-3 space-y-2">
                    <input x-model="image_string" type="text" class="w-full h-auto bg-white border rounded-md outline-none border-gray-200/60 focus:bg-gray-100 focus:outline-none focus:border-blue-600" placeholder="Paste an image link..." />
                    
                    <div @click="submit_processing=true; submitImageLink()"  class="flex items-center justify-center w-full h-8 max-w-md px-3 mt-2 mb-3 text-sm font-medium text-center text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-400">
                        <span x-show="submit_processing">
                            <svg class="w-4 h-4 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        </span>
                        <span x-show="!submit_processing">Submit</span>
                    </div>

                    <p class="text-xs text-gray-400">Works with any image from the web.</p>
                </div>
            </div>
        @endif
    </div>
    <script>

        window.addEventListener('imageFinishedUploading', event => {
            console.log(event.detail.url);
        });

    </script>


    @if(in_array('emoji', $sections))
        <style>
            .picmo__header{
                background: none !important;
                border-bottom: 1px solid #eaeaf1 !important;
            }

            .picmo__picker, .picmo__categoryName, .emojiCategory{
                background: none !important;
                border:0px !important;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/picmo@latest/dist/umd/index.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@picmo/popup-picker@latest/dist/umd/index.js"></script>
        <script type="module">
            import { createPicker, darkTheme } from 'https://unpkg.com/picmo@latest/dist/index.js';
            window.createPicker = createPicker;
            window.mediaSelectorDarkTheme = darkTheme;
        </script>
        <script>
            let createPickerInterval = setInterval(function(){
                
            if(typeof createPicker == 'function' && typeof mediaSelectorDarkTheme != 'undefined'){
                    
                    console.log('accessed');
                    const rootElement = document.querySelector('.emojiPicker');
                    // Create the picker
                    const picker = createPicker(
                        { 
                            rootElement: rootElement,
                            showCategoryTabs: false,
                            //theme: darkTheme,
                            showPreview:false,
                            className: 'tailsEmojiPicker',
                            emojiSize: '1.5rem',
                            emojisPerRow: 12,
                            visibleRows: 5,
                            initialEmoji: '{{ $emoji }}'
                        });

                    window.emojiPicker = picker;

                    window.selectRandomEmoji = function(){
                        const emojisRequest = emojiPicker.emojiData.db.transaction('emoji').objectStore('emoji').getAll();
                        emojisRequest.onsuccess = ()=> {
                            let randomEmojiIndex = Math.floor(Math.random() * emojisRequest.result.length);
                            
                            window.dispatchEvent(new CustomEvent('{{ $eventCallback }}', { detail: { 'value': emojisRequest.result[randomEmojiIndex].emoji, 'type' : 'emoji' }} ));
                        }
                    }

                    // The picker emits an event when an emoji is selected. Do with it as you will!
                    picker.addEventListener('emoji:select', event => {
                    
                        window.dispatchEvent(new CustomEvent('{{ $eventCallback }}', { detail: { 'value': event.emoji, 'type' : 'emoji' }} ));
                    
                    });

                    clearInterval(createPickerInterval);
                }
            })

        </script>

    @endif

</div>
