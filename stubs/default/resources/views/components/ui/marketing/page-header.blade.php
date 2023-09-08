@props([
    'title' => 'Page Header Title', 
    'description' => 'Description goes here'
])


<div class="w-full h-auto bg-gradient-to-b from-slate-100/70 to-transparent dark:bg-gradient-to-b dark:from-slate-950 dark:to-transparent">
    <div class="max-w-6xl px-8 py-8 mx-auto text-left dark:text-white">
        <h1 class="text-2xl font-medium tracking-tighter leading-tighter font-heading md:text-3xl">{{ $title }}</h1>
        <p class="mx-auto mt-1.5 text-base font-medium text-neutral-400 dark:text-slate-400 md:mt-2">{{ $description }}</p>
    </div>
</div>