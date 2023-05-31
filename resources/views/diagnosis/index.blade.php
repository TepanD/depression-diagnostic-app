<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sistem Pakar Pendiagnosis Gangguan Mental Depresi') }}
        </h2>
    </x-slot>

    <style>
        input[type="checkbox"] {
            display: none;
        }

        @keyframes strike {
            0% {
                width: 0;
            }

            100% {
                width: 100%;
            }
        }

        .strike {
            position: relative;
        }

        .strike::after {
            content: ' ';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background: black;
            animation-name: strike;
            animation-duration: 0.2s;
            animation-timing-function: linear;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
    </style>

    {{-- CONTAINER --}}
    <div class="py-12" id="main-container" {{ Session::has('result') ? 'data-result-success' : '' }}
        data-result='{{ \Session::get('result') }}'>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto dark:bg">


                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-8">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
                        <form method="POST" action="{{ route('hdr.store_diagnostic_result') }}">
                            @csrf
                            @foreach ($headerQuestions as $headerQuestion)
                                <div class="single-hdq-container mb-8 flex flex-col">
                                    <label class='block font-medium text-sm text-gray-700 dark:text-gray-300'>
                                        {{ $headerQuestion->hdq_name }}
                                    </label>
                                    @foreach ($detailQuestions->where('hdq_id', $headerQuestion->hdq_id)->sortBy('dtq_sequence') as $detailQuestion)
                                        <div class="dtq-div hover:bg-gray-100 p-2 mb-1 rounded-lg"
                                            style="transition-property: all;
                                        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                                        transition-duration: 150ms;">
                                            <label id="lbl_{{ $detailQuestion->dtq_id }}" {{-- onclick="handleLabelClick(event)" --}}><input
                                                    type="checkbox" name="{{ $headerQuestion->hdq_id }}"
                                                    id="cb_{{ $detailQuestion->dtq_id }}"
                                                    value="{{ $detailQuestion->dtq_id }}">
                                                {{ $detailQuestion->dtq_name }} - {{ $detailQuestion->score }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            <button id="btn_getResult"
                                class="disabled:cursor-not-allowed disabled:bg-gray-500 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-900 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                type="submit" disabled>get result</button>
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
        //handle click on label
        // const handleLabelClick = (e) => {
        //     e.stopPropagation(); // Prevent the click event from bubbling up to the div
        //     $(e.target).closest('.dtq-div').click();
        // }
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(() => {
                //disable button submit
                $("#btn_getResult").attr('disabled', true);

                //scrolling to first hdq
                $('.single-hdq-container').get(0).scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });

                //check at least one checkbox is checked for every hdq
                const hasAtLeastOneCheckedCheckboxInContainer = (container) => {
                    const checkboxes = container.find('input[type="checkbox"]');
                    console.log(checkboxes);
                    return checkboxes.filter(':checked').length > 0;
                }

                function allContainersHaveCheckedCheckboxes() {
                    let allChecked = true;
                    $('.single-hdq-container').each(function() {
                        if (!hasAtLeastOneCheckedCheckboxInContainer($(this))) {
                            allChecked = false;
                            console.log("ada yang masih kosong");
                            return false;
                        }
                    });
                    return allChecked;
                }

                //Checkbox event handler
                const handleCheckboxChange = (checkbox) => {
                    $('input[name="' + checkbox.name + '"]').not(checkbox).prop('checked', false);
                    $('input[name="' + checkbox.name + '"]').not(checkbox).parent().addClass('strike');

                    if (checkbox.checked) {
                        $(checkbox).parent().removeClass('strike');
                        $(checkbox).closest('.single-hdq-container').next().get(0).scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } else {
                        $('input[name="' + checkbox.name + '"]').parent().removeClass('strike');
                    }
                    if (allContainersHaveCheckedCheckboxes()) {
                        $("#btn_getResult").removeAttr('disabled');
                        console.log("disabled: false");
                    } else {
                        $("#btn_getResult").attr('disabled', true);
                        console.log("disabled: true");
                    }
                }
                $('input[type="checkbox"]').on('change', function() {
                    handleCheckboxChange(this);
                });

                // Button-like divs click event
                $('.dtq-div').on('click', (e) => {
                    const $checkBox = $(e.target).closest('.dtq-div').find(
                        'input[type="checkbox"]');
                    if (!$(e.target).is('input[type="checkbox"]')) {
                        $checkBox.prop('checked', !$checkBox.prop('checked'));
                        handleCheckboxChange($checkBox.get(0));
                    }
                });

                //define test-result-modal
                const trModalElement = document.getElementById('test-result-modal');
                const modalOptions = {
                    backdrop: 'dynamic',
                    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
                    closable: true,
                    onHide: () => {
                        $('div[modal-backdrop]').remove();
                    }
                }
                const resultModal = new Modal(trModalElement, modalOptions);

                //IIFE
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
