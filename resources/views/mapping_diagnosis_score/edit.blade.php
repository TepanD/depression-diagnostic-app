<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Mapping Diagnosis Score') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-32">
            <a href="{{ url()->previous() }}"
                style="display: flex;align-items: center;width: fit-content;column-gap: 0.6rem;"
                class="inline-block rounded px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                Back
            </a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative rounded-xl overflow-auto dark:text-slate-200 p-10">

                    <form method="POST" action="{{ route('mapping-diagnosis-score.update', $mappingDiagnosisScore) }}">
                        @csrf
                        @method('PUT')
                        <x-input-label for="id" :value="__('mapds_id')" />
                        <input type="text" name="mapds_id" id="txt_mapdsid"
                            value="{{ $mappingDiagnosisScore->mapds_id }}"
                            class="disabled:opacity-75 dark:border-gray-700 dark:bg-gray-900 bg-gray-200 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            @disabled(true) />
                        <br />
                        <br />
                        <x-input-label for="result_desc" :value="__('Result Description')" />
                        <input type="text" name="result_desc" id="txt_resultdesc"
                            value="{{ old('result_desc', $mappingDiagnosisScore->result_desc) }}"
                            class="{{ $errors->has('result_desc') ? 'dark:border-red-500' : 'dark:border-gray-700' }} dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('result_desc')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </span>
                        @enderror
                        @if (!$errors->has('result_desc'))
                            <br />
                        @endif
                        <br />
                        <x-input-label for="result_additional_desc" :value="__('Result Additional Description')" />
                        <textarea id="txt_resultadddesc" name="result_additional_desc" rows="5" cols="60"
                            class="{{ $errors->has('result_additional_desc') ? 'dark:border-red-500' : 'dark:border-gray-700' }} dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('result_additional_desc', $mappingDiagnosisScore->result_additional_desc) }}</textarea>
                        @error('result_additional_desc')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </span>
                        @enderror
                        @if (!$errors->has('result_additional_desc'))
                            <br />
                        @endif
                        <br />
                        <x-input-label for="min_score" :value="__('Minimum Score')" />
                        <input type="number" min="0" name="min_score" id="txt_minscore"
                            value="{{ old('min_score', $mappingDiagnosisScore->min_score) }}"
                            class="{{ $errors->has('min_score') ? 'dark:border-red-500' : 'dark:border-gray-700' }} dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('min_score')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </span>
                        @enderror
                        @if (!$errors->has('min_score'))
                            <br />
                        @endif
                        <br />
                        <x-input-label for="max_score" :value="__('Maximum Score')" />
                        <input type="number" min="1" name="max_score" id="txt_maxscore"
                            value="{{ old('max_score', $mappingDiagnosisScore->max_score) }}"
                            class="{{ $errors->has('max_score') ? 'dark:border-red-500' : 'dark:border-gray-700' }} dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        @error('max_score')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                {{ $message }}
                            </span>
                        @enderror
                        @if (!$errors->has('max_score'))
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
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            type="submit">update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
