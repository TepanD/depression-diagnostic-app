<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Testing diagnosis') }}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto dark:bg">


                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-8">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
                        <form method="POST" action="{{ route('hdr.store_diagnostic_result') }}">
                            @csrf
                            @foreach ($headerQuestions as $headerQuestion)
                                <div class="mb-8">
                                    <label class='block font-medium text-sm text-gray-700 dark:text-gray-300'>
                                        {{ $headerQuestion->hdq_id }} -{{ $headerQuestion->hdq_name }}
                                    </label>
                                    @foreach ($detailQuestions->where('hdq_id', $headerQuestion->hdq_id)->sortBy('dtq_sequence') as $detailQuestion)
                                        <label>
                                            <input type="checkbox" name="{{ $headerQuestion->hdq_id }}"
                                                id="cb_{{ $detailQuestion->dtq_id }}"
                                                value="{{ $detailQuestion->dtq_id }}">
                                            {{ $detailQuestion->dtq_id }} - {{ $detailQuestion->dtq_name }}
                                        </label><br />
                                    @endforeach
                                </div>
                            @endforeach
                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                type="submit">get result</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(() => {

                $('input[type="checkbox"]').on('change', function() {
                    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
                });

            });
        }, false);
    </script>
</x-app-layout>
