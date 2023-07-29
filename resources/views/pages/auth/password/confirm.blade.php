<x-layouts.app>
    <div>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="/">
                <x-logo class="w-auto h-12 mx-auto text-indigo-600 fill-current" />
            </x-ui.link>

            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                Confirm your password
            </h2>
            <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                Please confirm your password before continuing
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form wire:submit="confirm">
                    <div>
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                            Password
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input wire:model.blur="password" id="password" name="password" type="password" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>

                        @error('password')
                            <p class="mt-2 text-sm text-red-600" id="password-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <div class="text-sm leading-5">
                            <x-ui.link href="/auth/reset-password" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                                Forgot your password?
                            </x-ui.link>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700">
                                Confirm password
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layouts.app>