<ul 
    x-data="{ 
        toasts: [],
        toastsHovered: false,
        deleteToastWithId (id){
            for(let i = 0; i < this.toasts.length; i++){
                if(this.toasts[i].id === id){
                    this.toasts.splice(i, 1);
                    break;
                }
            }
        },
        getBottomPositionOfElement(el){
            elementRectangle = el.getBoundingClientRect();
            return elementRectangle.top + elementRectangle.height;
        },
        stackToasts(){
            for(let i = (this.toasts.length-1); i >= 0; i--){
                if(document.getElementById( this.toasts[i].id )){
                    let toastElement = document.getElementById( this.toasts[i].id );
                    this.toasts[i].bottom = this.getBottomPositionOfElement(toastElement); 
                    toastElement.style.tranform = 'translateY(0px)';
                    if(i==(this.toasts.length-1)){
                        toastElement.style.top = '0px';
                    } else {
                        console.log('set to bottom pos: ' + this.toasts[i+1].bottom + 'px');
                        toastElement.style.top = this.toasts[i+1].bottom + 'px';
                    }
                }
            }
        },
        unstackToasts(){
            for(let i = 0; i < this.toasts.length; i++){
                if(document.getElementById( this.toasts[i].id )){
                    let toastElement = document.getElementById( this.toasts[i].id );
                    toastElement.style.top = '0px';
                }
            }
        }
    }"
    @toast-show.window="event.stopPropagation();
        toasts.push({
            id: 'toast-' + Math.random().toString(16).slice(2),
            show: false,
            message: event.detail.message,
            description: event.detail.description,
            type: event.detail.type,
            bottom: 0
        });"
    @mouseover="toastsHovered=true"
    @mouseout="toastsHovered=false"
    x-init="
        $watch('toastsHovered', function(value){
            if(value){
                console.log('hovered yo');
                // calculate the new positions
                stackToasts();
                
            } else {
                unstackToasts();
            }
        });
    "
    class="fixed top-0 right-0 block w-full mt-6 mr-6 duration-300 ease-out group sm:max-w-xs" x-cloak>

    <template x-for="(toast, index) in toasts" :key="toast.id">
        <li
            :id="toast.id"
            x-data="{
                renderToastStyles () {

                    // Top Toast
                    if((toasts.length - (index+1)) == 0){
                        this.$el.firstElementChild.classList.add('scale-100', 'translate-y-0');
                    }
                    // Middle Toast
                    else if((toasts.length - (index+1)) == 1){
                        this.$el.firstElementChild.classList.remove('scale-100', 'translate-y-0');
                        this.$el.firstElementChild.classList.add('scale-[94%]', 'translate-y-4');
                    }
                    // Bottom Toast
                    else if((toasts.length - (index+1)) == 2){
                        this.$el.firstElementChild.classList.remove('scale-[94%]', 'translate-y-4');
                        this.$el.firstElementChild.classList.add('scale-[88%]', 'translate-y-8');
                    }
                    // Toast To Burn 🔥 (remove)
                    else if((toasts.length - (index+1)) > 2){
                        this.$el.firstElementChild.classList.remove('scale-[88%]', 'translate-y-8');
                        this.$el.firstElementChild.classList.add('scale-[82%]', 'translate-y-12');
                        
                        let that = this;
                        setTimeout(function(){
                            that.$el.firstElementChild.classList.add('opacity-0');
                            setTimeout(() => deleteToastWithId(toast.id), 500);
                        }, 300);
                        
                    }
                },
                toastHovered: false,
                toastStyle(){
                    
                    return 'z-index: ' + index + ';';
                }
            }"
            x-show="toast.show"
            x-init="
            console.log('initialized index: ' + index);
                //setTimeout(() => toast.show = true, 1); 
                setTimeout(function(){
                    toast.show=true;
                    renderToastStyles();
                }, 10);
                setTimeout(function(){
                    toast.show=false;    
                }, 400000); 

                $watch('toast.show', function(value){
                    if(!value){
                        setTimeout(() => deleteToastWithId(toast.id), 300);
                    }
                })
            "
            @mouseover="toastHovered=true"
            @mouseout="toastHovered=false"
            x-transition:enter="transform ease-in-out duration-300 transition" 
            x-transition:enter-start="-translate-y-full opacity-0" 
            x-transition:enter-end="translate-y-0 opacity-100" 
            x-transition:leave="transition ease-in-out duration-300" 
            x-transition:leave-start="opacity-100 translate-y-0" 
            x-transition:leave-end="opacity-0 -translate-y-full"
            class="absolute w-full sm:max-w-xs"
            :class="{ 'absolute' : index != toasts.length, 'relative': index == toasts.length-1 }"
            :style="toastStyle()"
            >
            <span class="
                relative flex flex-col items-start shadow-[0_10px_15px_-3px_rgb(0_0_0_/_0.08)] w-full p-4 transition-all duration-300 ease-in-out bg-white border border-gray-100 rounded-md sm:max-w-xs group 
                
            "
            >
                <p class="text-sm font-medium leading-none" x-text="toast.message"></p>
                <p x-show="toast.description" class="mt-1.5 text-xs leading-none opacity-90" x-text="toast.description"></p>
                <span @click="toast.show=false;"
                    :class="{ 'top-1/2 -translate-y-1/2' : !toast.description, 'top-0 mt-2.5' : toast.description, 'opacity-100' : toastHovered, 'opacity-0' : !toastHovered }"
                    class="absolute right-0 p-1.5 mr-2.5 text-gray-400 duration-100 ease-in-out rounded-full opacity-0 cursor-pointer hover:bg-gray-50 hover:text-gray-500">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </span>
            </span>
        </li>
    </template>
    
</ul>

<script>
    window.toast = function(message, description = '', type = 'default'){
        window.dispatchEvent(new CustomEvent('toast-show', { detail : { type: type, message: message, description: description }}));
    }
</script>


