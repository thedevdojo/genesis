<div x-data="{ show: false, message: '', description: '', type: '' }"
    @notification-show.window="console.log(event); show=true; message=event.detail.message; description=event.detail.description; type=event.detail.type"
    x-init="$watch('show', function(value){ if(value){ setTimeout(function(){ show=false; }, 99000); }})"
    class="fixed top-0 right-0 w-full sm:max-w-xs" x-cloak>
    <div 
        
        x-show="show"
        x-transition:enter="transform ease-out duration-300 transition" 
        x-transition:enter-start="-translate-y-full opacity-0" 
        x-transition:enter-end="translate-y-0 opacity-100" 
        x-transition:leave="transition ease-in duration-100" 
        x-transition:leave-start="opacity-100 translate-y-0" 
        x-transition:leave-end="opacity-0 -translate-y-full"
        class="relative z-50 flex flex-col items-start p-4 mt-5 mr-6 bg-white border border-gray-200/70 rounded-md shadow-[0_4px_12px_rgb(0_0_0_/_0.06)] group">

        <h4 class="text-sm font-medium leading-none" x-text="message"></h4>
        <p x-show="description" class="mt-1.5 text-xs leading-none opacity-90" x-text="description"></p>
        <div @click="show=false;"
            :class="{ 'top-1/2 -translate-y-1/2' : !description, 'top-0 mt-2.5' : description }"
            class="absolute right-0 p-1.5 mr-2.5 text-gray-400 duration-100 ease-out rounded-full opacity-0 cursor-pointer group-hover:opacity-100 hover:bg-gray-50 hover:text-gray-500">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </div>
    </div>
</div>

<script>
    /*window.notification = {
        show: function(type, message){
            window.dispatchEvent(new CustomEvent('notification-show', { detail : { type: type, message: message }}));
        }
    }*/

    window.toast = function(message, description = '', type = 'success'){
        window.dispatchEvent(new CustomEvent('notification-show', { detail : { type: type, message: message, description: description }}));
    }
</script>


