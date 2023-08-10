<x-layouts.app>
    <div class="relative flex w-screen h-screen pl-64">
        <div class="fixed left-0 w-64 h-screen bg-gray-200/50">
            <div class="p-2">
            <ul role="list" class="space-y-1.5 ">
                <li>
                    <a href="#" class="flex items-center p-2 text-sm font-semibold leading-6 text-gray-900 rounded-md bg-gray-50 group gap-x-2" x-state:on="Current" x-state:off="Default" x-state-description="Current: &quot;bg-gray-50 text-indigo-600&quot;, Default: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                      <span class="pl-1 text-xl">👋</span>
                      <span>Welcome</span>
                    </a>
                  </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-sm font-semibold leading-6 text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 group gap-x-3" x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                        <span class="pl-1 text-xl">📦</span>
                        <span>Additional Packages</span>
                    </a>
                  </li>
                <li>
                    <a href="#" class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3" x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                      <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"></path>
</svg>
                      Projects
                    </a>
                  </li>
                <li>
                    <a href="#" class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3" x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                      <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"></path>
</svg>
                      Calendar
                    </a>
                  </li>
                <li>
                    <a href="#" class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3" x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                      <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"></path>
</svg>
                      Documents
                    </a>
                  </li>
                <li>
                    <a href="#" class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3" x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                      <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"></path>
  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"></path>
</svg>
                      Reports
                    </a>
                  </li>
                
              </ul>
            </div>
            <a href="/" class="absolute bottom-0 flex items-center w-full px-4 py-3 font-medium text-gray-100 bg-gray-900 hover:bg-gray-800 pl-7 group lg:items-center lg:justify-center">
                <span class="w-4 h-4 overflow-hidden transform translate-x-0.5 group-hover:translate-x-0 absolute left-0 ml-3 group-hover:w-4 ease-out duration-150 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                </span>
                <span class="mx-auto ml-1.5 text-sm font-bold leading-none select-none">Exit Setup</span>
            </a>
        </div>

        <div class="w-full h-full">
            <div class="w-full max-w-2xl mx-auto mt-20 prose-sm prose">
                @php $md = file_get_contents(base_path('vendor/devdojo/genesis/src/setup/index.md')); @endphp

                {!! Str::markdown($md)  !!}
            </div>
        </div>
    </div>
</x-layouts.app>