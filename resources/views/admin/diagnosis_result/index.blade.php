<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Diagnosis Result') }}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-32">
            <div class="container mx-auto dark:bg">

                {{-- TABLE CONTAINER TESTING STYLE --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-8">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        hdr_id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        user_id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        user_name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        result_score
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        mapds_id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        result_date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($headerDiagnosisResults as $key => $headerDiagnosisResult)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            {{ $headerDiagnosisResults->firstItem() + $key }}
                                        </td>
                                        <td scope="row" class="px-6 py-4 hdr_id">
                                            {{ $headerDiagnosisResult->hdr_id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerDiagnosisResult->user_id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerDiagnosisResult->user_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerDiagnosisResult->result_score }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerDiagnosisResult->mapds_id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerDiagnosisResult->result_date }}
                                        </td>
                                        <td class="flex items-center px-6 py-4 space-x-3">
                                            <button data-modal-target="detailModal" data-modal-toggle="detailModal"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline detail_button">Details</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $headerDiagnosisResults->links() }}

            </div>
        </div>
    </div>

    {{-- Detail Diagnosis Result Modal --}}
    <div id="detailModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Detail Diagnosis Result
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="detailModal">
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
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ddr_id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    hdr_id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    user_id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    hdq_id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    dtq_id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    score
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody_ddr">

                        </tbody>
                    </table>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="detailModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(() => {

                const fetch_data = (hdr_id) => {
                    $.ajax({
                        url: "{{ url('/') }}/header-diagnosis-result/fetch_detail_diagnosis_result_by_hdr_id",
                        data: {
                            hdr_id: hdr_id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            let html = '';

                            //loop through detail questions data
                            for (let count = 0; count < data.length; count++) {
                                html +=
                                    '<tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">';
                                html +=
                                    '<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' +
                                    data[count].ddr_id + '</th>';
                                html +=
                                    '<td class="px-6 py-4">' + data[count].hdr_id +
                                    '</td>';
                                html +=
                                    '<td class="px-6 py-4">' + data[count].user_id +
                                    '</td>';
                                html +=
                                    '<td class="px-6 py-4">' + data[count].hdq_id +
                                    '</td>';
                                html +=
                                    '<td class="px-6 py-4">' + data[count].dtq_id +
                                    '</td>';
                                html +=
                                    '<td class="px-6 py-4">' + data[count].score +
                                    '</td>';
                            }
                            $('#tbody_ddr').html(html);
                        },
                        error: function(data, status, error) {
                            Swal.fire({
                                icon: 'error',
                                html: '<ul><li>data:' + data + '</li>' +
                                    '<li>status: ' + status + '</li>' +
                                    '<li>error: ' + error + '</li>' +
                                    '</ul>'
                            });
                        }
                    });
                }

                document.querySelectorAll('.detail_button').forEach((item) => {
                    item.addEventListener('click', (e) => {
                        let hdrID = e.target.closest('tr').querySelector('.hdr_id')
                            .innerText;
                        $('#tbody_ddr').html('');
                        fetch_data(hdrID);
                    });
                });

            });
        }, false);
    </script>
</x-app-layout>
{{-- 
    
 --}}
