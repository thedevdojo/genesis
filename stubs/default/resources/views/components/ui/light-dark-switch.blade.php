<button 
    x-data="{
        darkMode: $persist(false).as('dark_mode'),
        toggleDarkMode(){
            document.documentElement.classList.toggle('dark');
            if(document.documentElement.classList.contains('dark')){
                this.darkMode = true;
                new Audio('/assets/audio/dark.mp3').play()
            } else {
                this.darkMode = false;
                new Audio('/assets/audio/light.mp3').play()
            }
        }
    }" 
    @click="toggleDarkMode()"
    x-init="
        if(document.documentElement.classList.contains('dark')){ darkMode=true; }
    "
    class="w-full h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 hover:text-gray-600 dark:hover:bg-gray-800 dark:text-gray-300 dark:hover:text-gray-100"
>
    <svg class="w-4 h-4 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" /></svg>

</button>