

<div class="p-6 bg-white rounded-lg shadow-sm border border-zinc-200 dark:bg-gray-800 dark:border-gray-700">
    <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-100">Recent Activity</h3>
    <div class="mt-6 flow-root">
        <ul role="list" class="-my-5 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($activities as $activity)
                <li class="py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full" src="{{ $activity['avatar'] }}" alt="{{ $activity['user'] }}">
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $activity['user'] }}
                            </p>
                            <p class="truncate text-sm text-gray-500 dark:text-gray-400">
                                {{ $activity['action'] }}
                            </p>
                        </div>
                        <div>
                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                {{ $activity['time'] }}
                            </span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-6">
        <a href="#" class="flex w-full items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:ring-gray-600 dark:hover:bg-gray-600">View all</a>
    </div>
</div>
