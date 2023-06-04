<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Testing diagnosis') }}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-12" id="main-container" {{ Session::has('result') ? 'data-result-success' : '' }}
        data-result='{{ \Session::get('result') }}'>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-32">
            <div class="container mx-auto dark:bg">


                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-8">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
                        <form method="POST" action="{{ route('hdr.store_diagnostic_result') }}">
                            @csrf
                            @foreach ($headerQuestions as $headerQuestion)
                                <div class="mb-8">
                                    <label class='block font-medium text-sm text-gray-700 dark:text-gray-300'>
                                        {{ $headerQuestion->hdq_name }}
                                    </label>
                                    @foreach ($detailQuestions->where('hdq_id', $headerQuestion->hdq_id)->sortBy('dtq_sequence') as $detailQuestion)
                                        <label>
                                            <input type="checkbox" name="{{ $headerQuestion->hdq_id }}"
                                                id="cb_{{ $detailQuestion->dtq_id }}"
                                                value="{{ $detailQuestion->dtq_id }}">
                                            {{ $detailQuestion->dtq_name }} - {{ $detailQuestion->score }}
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

    @if (\Session::has('result'))
        <div id="test-result-modal" data-modal-target="test-result-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex">
            <div class="relative w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            test result
                        </h3>
                        <button type="button"
                            class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">

                        <p><b>total_score</b></p>
                        <p id="result-totalscore" style="margin-top:0"></p>

                        <p><b>mapds_id</b></p>
                        <p id="result-mapdsid" style="margin-top:0"></p>

                        <p><b>min_score</b></p>
                        <p id="result-minscore" style="margin-top:0"></p>

                        <p><b>max_score</b></p>
                        <p id="result-maxscore" style="margin-top:0"></p>

                        <p><b>result_desc</b></p>
                        <p id="result-desc" style="margin-top:0"></p>

                        <p><b>result_additional_desc</b></p>
                        <p id="result-additional-desc" style="margin-top:0"></p>

                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button"
                            class="close-modal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(() => {

                $('input[type="checkbox"]').on('change', function() {
                    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
                });

                //define test-result-modal
                const $targetElement = document.getElementById('test-result-modal');
                const modalOptions = {
                    backdrop: 'dynamic',
                    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
                    closable: true,
                    onHide: () => {
                        $('div[modal-backdrop]').remove();
                    }
                }
                const resultModal = new Modal($targetElement, modalOptions);

                //result fetched
                (() => {
                    const hideModal = () => {
                        resultModal.hide();
                    }

                    $('.close-modal').each(function() {
                        $(this).on('click', hideModal);
                    })

                    if (typeof $('#main-container').data('result-success') !== 'undefined') {

                    } else {
                        return false;
                    }

                    let result = $('#main-container').data("result");
                    if (!result) return false;
                    else {
                        $('#result-mapdsid').text(result.mapds_id);
                        $('#result-minscore').text(result.min_score);
                        $('#result-maxscore').text(result.max_score);
                        $('#result-desc').text(result.result_desc);
                        $('#result-additional-desc').text(result.result_additional_desc);
                        $('#result-totalscore').text(result.total_score);

                        resultModal.show();
                    }
                })();

            });
        }, false);
    </script>
</x-app-layout>
