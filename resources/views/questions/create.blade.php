<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Header Question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative rounded-xl overflow-auto dark:text-slate-200 p-10">

                    <form method="POST" action="{{ route('questions.store') }}">
                        @csrf
                        <x-input-label for="hdq_name" :value="__('Header Question Name')" />
                        <input type="text" name="hdq_name" id="txt_hdqname" value="{{ old('hdq_name') }}"
                            class="{{ $errors->has('hdq_name') ? 'dark:border-red-500' : 'dark:border-gray-700' }} dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('hdq_name')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </span>
                        @enderror
                        @if (!$errors->has('hdq_name'))
                            <br />
                        @endif
                        <br />
                        <x-input-label for="hdq_sequence" :value="__('Header Question Sequence')" />
                        <input type="number" min="1" name="hdq_sequence" id="txt_hdqsequence"
                            value="{{ old('hdq_sequence') }}"
                            class="{{ $errors->has('hdq_sequence') ? 'dark:border-red-500' : 'dark:border-gray-700' }} dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('hdq_sequence')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </span>
                        @enderror
                        @if (!$errors->has('hdq_sequence'))
                            <br />
                        @endif
                        <br />
                        <div class="flex items-center mb-4">
                            <input checked id="cb_isactive" type="checkbox" name="is_active"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="cb_isactive"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is Active</label>
                        </div>
                        <br />
                        <br />
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            type="submit">submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
