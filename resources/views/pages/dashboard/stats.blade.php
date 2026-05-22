


<div class="grid gap-6 mb-8 md:grid-cols-3">
    @foreach ($stats as $stat)
        <div class="flex items-center p-4 bg-white rounded-lg shadow-sm border border-zinc-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-3 mr-4 text-gray-800 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                <x-dynamic-component :component="$stat['icon']" class="w-6 h-6" />
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    {{ $stat['name'] }}
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $stat['value'] }}
                </p>
            </div>
            <div class="flex flex-col items-end ml-auto">
                 <span class="text-sm font-medium {{ str_starts_with($stat['change'], '+') ? 'text-green-500' : 'text-red-500' }}">
                    {{ $stat['change'] }}
                 </span>
            </div>
        </div>
    @endforeach
</div>
