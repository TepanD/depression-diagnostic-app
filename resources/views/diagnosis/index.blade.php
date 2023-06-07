<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sistem Pakar Pendeteksi Gangguan Mental Depresi') }}
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
            opacity: 0.3;
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

        li {
            list-style: disc !important;
            padding-bottom: 0.625rem;
        }

        ul {
            padding-left: 40px !important;
        }
    </style>

    {{-- CONTAINER --}}
    <div class="py-12" id="main-container" {{ Session::has('result') ? 'data-result-success' : '' }}
        data-result='{{ \Session::get('result') }}'>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-32">
            <div class="container mx-auto dark:bg">

                <button id="tombol_panduan" class="mx-4 sm:mx-6 text-blue-600 underline">Panduan pengerjaan</button>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-4">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-8 px-4 sm:px-6">
                        <form method="POST" action="{{ route('hdr.store_diagnostic_result') }}">
                            @csrf
                            @foreach ($headerQuestions as $headerQuestion)
                                <div class="single-hdq-container mb-8 flex flex-col">
                                    <label class='block m-0.5 text-4xl font-medium text-gray-700 dark:text-gray-300'>
                                        {{ $headerQuestion->hdq_sequence }}
                                    </label>
                                    @foreach ($detailQuestions->where('hdq_id', $headerQuestion->hdq_id)->sortBy('dtq_sequence') as $detailQuestion)
                                        <div class="dtq-div bg-gray-100 active:bg-gray-100 sm:hover:bg-gray-100 sm:bg-white p-2 m-0.5 rounded-lg"
                                            style="transition-property: all;
                                        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                                        transition-duration: 150ms;">
                                            <label id="lbl_{{ $detailQuestion->dtq_id }}" onclick="return false">
                                                <input type="checkbox" name="{{ $headerQuestion->hdq_id }}"
                                                    id="cb_{{ $detailQuestion->dtq_id }}"
                                                    value="{{ $detailQuestion->dtq_id }}">
                                                {{ $detailQuestion->score }} - {{ $detailQuestion->dtq_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            <button id="btn_getResult"
                                class="w-full justify-center sm:w-max inline-flex sm:items-center disabled:cursor-not-allowed disabled:bg-gray-400  px-4 py-2 bg-blue-700 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-800 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                type="submit" disabled>lihat hasil</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- RESULT MODAL --}}
    @if (\Session::has('result'))
        <div id="test-result-modal" data-modal-target="test-result-modal" tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex transform opacity-0 -translate-y-full transition-all duration-700 ease-in-out">
            <div class="relative w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                    <!-- Modal body -->
                    <div class="py-8 px-5 sm:p-8 space-y-6">

                        <div class="flex flex-row justify-center">
                            <img id="result-image" src="{{ url('/images/result-image-1.png') }}" alt="result-image"
                                class="w-3/5 sm:w-2/5" />
                            {{-- Illustration by <a href="https://icons8.com/illustrations/author/zD2oqC8lLBBA">Icons 8</a> from
                        <a href="https://icons8.com/illustrations">Ouch!</a> --}}
                        </div>
                        <h3 class="text-2xl sm:text-3xl leading-relaxed text-center text-gray-700 font-bold dark:text-gray-400"
                            style="margin-top: 1rem !important;">
                            Berdasarkan jawabanmu...
                        </h3>
                        <h4 id="result-desc-interpretation"
                            class="text-xl leading-relaxed font-semibold text-gray-600 dark:text-gray-400"
                            style="margin-top: 2.5rem !important;">
                        </h4>
                        {{-- <small>Total Score: <b id="result-totalscore"></b></small> --}}


                        <p id="result-additional-desc"
                            class="text-base leading-relaxed text-gray-600 dark:text-gray-400"
                            style="margin-top: 1.5rem !important;">

                        </p>

                        <p class="text-base leading-relaxed text-gray-600 dark:text-gray-400"
                            style="margin-top: 1.5rem !important;">
                            Perlu diingat bahwa hasil dari tes <b>BUKAN</b> keputusan akhir yang menentukan apabila Anda
                            memiliki gangguan
                            mental depresi.
                        </p>
                        <p class="text-base leading-relaxed text-gray-600 dark:text-gray-400"
                            style="margin-top: 1.5rem !important;">
                            Kami sarankan agar menghubungi tenaga profesional yang berkaitan dengan bidang ini, seperti
                            psikolog atau psikiater.
                        </p>


                        <p class="text-base leading-relaxed text-gray-600 dark:text-gray-400"
                            style="margin-top: 1.5rem !important;">
                            Apabila dibutuhkan, silakan klik tombol Download di bawah untuk mengunduh file PDF hasil
                            tes.
                        </p>
                        <a href="{{ route('hdr.download_pdf') }}" style="margin-top:1rem !important;"
                            class="px-4 py-2 bg-red-700 hover:bg-red-800 rounded-md text-sm text-white outline-none focus:ring-4 flex items-center max-w-max">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span class="ml-2">Download PDF</span>
                        </a>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex flex-col p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <a href="{{ route('hdr.show_diagnostic_page') }}"
                            class="text-white bg-blue-700 w-full shadow-lg transform transition-transform hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ulangi pengerjaan kuesioner</a>

                        <span class="text-sm mt-4">
                            <a href="{{ route('info.show_information_page') }}"
                                class="text-blue-600 underline visited:text-purple-600">Klik di sini</a> untuk
                            informasi mengenai kuesioner
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- INSTRUCTION MODAL -->
    <div id="instruction-modal" tabindex="-1" data-modal-target="instruction-modal"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-2.5 sm:p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full transform opacity-0 -translate-y-full transition-all duration-700 ease-in-out">
        <div class="relative w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal body -->
                <div class="py-8 px-5 sm:p-8 space-y-6">
                    <div class="flex flex-row justify-center">
                        <img src="{{ url('/images/hello-image.png') }}" alt="hello-image" class="sm:w-3/5" />
                        {{-- Illustration by <a href="https://icons8.com/illustrations/author/zD2oqC8lLBBA">Icons 8</a> from
                        <a href="https://icons8.com/illustrations">Ouch!</a> --}}
                    </div>

                    <h3 class="text-3xl sm:text-3xl leading-relaxed text-center text-gray-700 font-bold dark:text-gray-400"
                        style="margin-top: 1rem !important;">
                        Halo! Selamat Datang!
                    </h3>
                    <p class="text-base leading-relaxed text-gray-600 dark:text-gray-400"
                        style="margin-top: 1.5rem !important;">
                        Terima kasih sudah meluangkan waktu untuk mencoba <b>Sistem Pakar Pendeteksi Tingkatan
                            Depresi</b>.
                    </p>

                    <div class="text-base leading-relaxed text-gray-600 dark:text-gray-400">
                        Pada website ini Anda akan mengerjakan sebuah kuesioner untuk mendeteksi tingkatan depresi yang
                        memiliki 21 item
                        pertanyaan
                        di dalamnya.
                        Sebelum mulai mengerjakan, ada beberapa hal yang perlu diperhatikan:
                        <ul class="text-gray-600 pt-2.5">
                            <li>Setiap item memiliki beberapa pilihan jawaban, Anda dipersilahkan untuk memilih
                                salah
                                satu jawaban yang <b>paling sesuai</b> dengan kondisi Anda.</li>
                            <li>Apabila Anda ragu untuk memilih di antara dua jawaban, pilih jawaban dengan nomor
                                tertinggi.</li>
                            <li>Perlu diingat bahwa kuesioner yang akan Anda kerjakan adalah sebuah <b>alat
                                    tes</b>
                                dan <b>TIDAK memberikan keputusan akhir</b> apabila Anda mengalami gangguan mental
                                depresi.
                                Silakan hubungi tenaga profesional seperti psikolog untuk penjelasan lebih lanjut.
                            </li>
                            <li>
                                Apabila semua pertanyaan telah terjawab, silakan klik tombol "lihat hasil".
                            </li>
                        </ul>
                    </div>

                    <p class="text-base leading-relaxed text-gray-600 dark:text-gray-400">
                        Apabila sudah membaca, silakan klik tombol "Saya mengerti" di bawah. <b>Selamat mengerjakan!</b>
                    </p>

                </div>
                <!-- Modal footer -->
                <div class="flex flex-col p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button"
                        class="close-instruct-modal w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Saya
                        mengerti</button>

                    <span class="text-sm mt-4">
                        <a href="{{ route('info.show_information_page') }}"
                            class="text-blue-600 underline visited:text-purple-600">Klik di sini</a> untuk
                        informasi lebih lanjut
                    </span>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(() => {
                //On start
                $("input[type=checkbox]").prop("checked", false);
                $('.single-hdq-container').get(0).scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
                $("#btn_getResult").attr('disabled', true);

                //check at least one checkbox is checked for every hdq
                const hasAtLeastOneCheckedCheckboxInContainer = (container) => {
                    const checkboxes = container.find('input[type="checkbox"]');
                    return checkboxes.filter(':checked').length > 0;
                }

                function allContainersHaveCheckedCheckboxes() {
                    let allChecked = true;
                    $('.single-hdq-container').each(function() {
                        if (!hasAtLeastOneCheckedCheckboxInContainer($(this))) {
                            allChecked = false;
                            return false;
                        }
                    });
                    return allChecked;
                }

                //Checkbox event handler
                const handleCheckboxChange = (checkbox) => {
                    $('input[name="' + checkbox.name + '"]').not(checkbox).prop('checked', false);
                    $('input[name="' + checkbox.name + '"]').not(checkbox).parent().addClass('strike');
                    $(checkbox).prop('checked', !$(checkbox).prop('checked'));

                    if (checkbox.checked) {
                        $(checkbox).parent().removeClass('strike');
                        $(checkbox).closest('.single-hdq-container').addClass('answered');
                        const nextQuestion = $(checkbox).closest('.single-hdq-container').nextAll()
                            .filter(
                                ':not(.answered)')
                            .first()
                            .get(0);

                        if (nextQuestion) {
                            nextQuestion.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }

                    } else {
                        $('input[name="' + checkbox.name + '"]').parent().removeClass('strike');
                        $(checkbox).closest('.single-hdq-container').removeClass('answered');
                    }
                    if (allContainersHaveCheckedCheckboxes()) {
                        $("#btn_getResult").removeAttr('disabled');
                    } else {
                        $("#btn_getResult").attr('disabled', true);
                    }
                }

                // Button-like divs click event
                $('.dtq-div').on('click', (e) => {
                    if ($(e.target).is('label') || $(e.target).is('div')) {
                        const $checkBox = $(e.target).closest('.dtq-div').find(
                            'input[type="checkbox"]');
                        handleCheckboxChange($checkBox.get(0));
                    }
                });

                //define object instruction modal
                const instructionModalElement = document.getElementById('instruction-modal');
                const instructionModalOptions = {
                    backdrop: 'static',
                    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
                    closable: false,
                    onHide: (e) => {
                        setTimeout(() => {
                            e._targetEl.classList.add('-translate-y-full');
                            e._targetEl.classList.add('opacity-0');
                        }, 100);
                        $('div[modal-backdrop]').remove();
                    },
                    onShow: function(e) {
                        setTimeout(() => {
                            e._targetEl.classList.remove('-translate-y-full');
                            e._targetEl.classList.remove('opacity-0');
                        }, 100);
                    },
                }
                const instructionModal = new Modal(instructionModalElement, instructionModalOptions);

                //define object test result modal
                const trModalElement = document.getElementById('test-result-modal');
                const trModalOptions = {
                    backdrop: 'dynamic',
                    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
                    closable: true,
                    onHide: (e) => {
                        setTimeout(() => {
                            e._targetEl.classList.add('-translate-y-full');
                            e._targetEl.classList.add('opacity-0');
                        }, 100);
                        $('div[modal-backdrop]').remove();
                    },
                    onShow: function(e) {
                        setTimeout(() => {
                            e._targetEl.classList.remove('-translate-y-full');
                            e._targetEl.classList.remove('opacity-0');
                        }, 100);
                    },
                }
                const resultModal = new Modal(trModalElement, trModalOptions);

                //modal close event handler
                const hideModal = (modalName) => {
                    switch (modalName) {
                        case "resultModal":
                            resultModal.hide();
                            break;
                        case "instructionModal":
                            instructionModal.hide();
                            break;
                        default:
                            break;
                    }
                }

                $('.close-result-modal').each(function() {
                    $(this).on('click', () => {
                        hideModal("resultModal")
                    });
                });

                $('.close-instruct-modal').each(function() {
                    $(this).on('click', () => {
                        hideModal("instructionModal")
                    });
                });

                $('#tombol_panduan').on('click', function() {
                    instructionModal.show();
                });


                //IIFE
                (() => {
                    if (typeof $('#main-container').data('result-success') !== 'undefined') {

                    } else {
                        instructionModal.show();
                        return false;
                    }

                    let result = $('#main-container').data("result");
                    if (!result) {

                        return false;
                    } else {
                        $('#result-totalscore').text(result.total_score);
                        console.log(result);
                        $('#result-additional-desc').text(result.result_additional_desc);
                        if (result.total_score == 0) {
                            $("#result-desc-interpretation").text(
                                "Kamu tidak memiliki gejala gangguan mental depresi");
                        } else if (result.total_score >= 1 && result.total_score <= 10) {
                            $("#result-desc-interpretation").text(
                                "Kenaikan dan penurunan mood dianggap normal");
                        } else if (result.total_score >= 11 && result.total_score <= 16) {
                            $("#result-desc-interpretation").text("Gangguan mood ringan");
                        } else if (result.total_score >= 17 && result.total_score <= 20) {
                            $("#result-desc-interpretation").text("Di ambang depresi klinis");
                        } else if (result.total_score >= 21 && result.total_score <= 30) {
                            $("#result-desc-interpretation").text("Depresi sedang");
                        } else if (result.total_score >= 31 && result.total_score <= 40) {
                            $("#result-desc-interpretation").text("Depresi berat");
                        } else if (result.total_score > 40) {
                            $("#result-desc-interpretation").text("Depresi ekstrim");
                        }
                        resultModal.show();
                    }
                })();

            });
        }, false);
    </script>
</x-app-layout>
