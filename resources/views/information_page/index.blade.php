<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Halaman Informasi') }}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-32">
            <div class="container mx-auto dark:bg">
                <div id="accordion-color" data-accordion="collapse"
                    data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                    <h2 id="accordion-color-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 bg-white border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                            data-accordion-target="#accordion-color-body-1" aria-expanded="true"
                            aria-controls="accordion-color-body-1">
                            <span>Apa itu gangguan mental depresi?</span>
                            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                        <div
                            class="p-5 bg-gray-50 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Gangguan mental depresi dapat dilihat pada
                                perubahan perilaku seseorang dan biasanya dicirikan dari seseorang yang berperasaan
                                tidak layak, murung, penurunan dalam beraktivitas, tidak percaya diri, dan kesedihan.
                                Namun, tidak semua gejala tersebut dialami oleh setiap penderita.</p>
                        </div>
                    </div>
                    <h2 id="accordion-color-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 bg-white border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                            data-accordion-target="#accordion-color-body-2" aria-expanded="false"
                            aria-controls="accordion-color-body-2">
                            <span>Apa itu kuesioner BDI-ii?</span>
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
                        <div class="p-5 bg-gray-50 border border-b-0 border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">
                                Beck Depression Inventory-ii (BDI-ii) adalah salah satu sebuah alat tes yang digunakan
                                untuk melakukan pendeteksian tingkat keparahan dari gangguan mental depresi.
                                Kuesioner ini <b>TIDAK</b> dapat menentukan apabila seseorang mengalami gangguan mental
                                depresi.
                            </p>
                            <p class="mb-2 text-gray-500 dark:text-gray-400">
                                Alat tes tersebut hanya merupakan <b>salah satu</b> komponen dari beberapa komponen
                                dalam
                                proses
                                diagnosis gangguan mental. Namun, item pertanyaan di dalam kuesioner menjadi acuan
                                gejala awal gangguan mental depresi.
                            </p>

                        </div>
                    </div>
                    <h2 id="accordion-color-heading-3">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 bg-white border border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                            data-accordion-target="#accordion-color-body-3" aria-expanded="false"
                            aria-controls="accordion-color-body-3">
                            <span>Apa yang perlu saya lakukan apabila mendapatkan skor 17 atau lebih?</span>
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-color-body-3" class="hidden" aria-labelledby="accordion-color-heading-3">
                        <div class="p-5 bg-gray-50 border border-t-0 border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">
                                Skor 17 atau lebih mengindikasikan bahwa kemungkinan Anda membutuhkan bantuan secara
                                medis.
                                Segera hubungi tenaga profesional di bidangnya seperti psikolog, psikiater, atau
                                sejenisnya yang ada di sekitar tempat Anda tinggal.
                            </p>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(() => {


            });
        }, false);
    </script>
</x-app-layout>
