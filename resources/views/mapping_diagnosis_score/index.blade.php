<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mapping Diagnosis Score') }}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto dark:bg">

                {{-- HIDDEN VALUES --}}
                <span id="update_id" style="display:hidden;"></span>

                {{-- UPPER CONTAINER --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                    <div class="relative rounded-xl overflow-auto">
                        <div class="shadow-sm overflow-hidden p-4">
                            <a href="{{ route('mapping-diagnosis-score.create') }}"
                                class="px-4 py-2 font-semibold text-sm hover:bg-blue-500 bg-blue-600 duration-100 text-white rounded-md shadow-sm opacity-100">Add</a>
                        </div>
                    </div>
                </div>


                {{-- TABLE CONTAINER TESTING STYLE --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-8">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        mapds_id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        min_score
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        max_score
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        result_desc
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        result_additional_desc
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        is_active
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        created_at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        create_operator
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        updated_at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        last_operator
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mappingDiagnosisScores as $mappingDiagnosisScore)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="px-6 py-4 mapds_id">
                                            {{ $mappingDiagnosisScore->mapds_id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->min_score }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->max_score }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->result_desc }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->result_additional_desc }}
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <input {{ $mappingDiagnosisScore->is_active == 'T' ? 'checked' : '' }}
                                                    disabled id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                                <input {{ $mappingDiagnosisScore->is_active == 'T' ? 'checked' : '' }}
                                                    type="checkbox" id="{{ $mappingDiagnosisScore->mapds_id }}"
                                                    class="sr-only peer switch-isactive">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->created_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->create_operator }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->updated_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->last_operator }}
                                        </td>
                                        <td class="flex items-center px-6 py-4 space-x-3">
                                            <a href="{{ route('mapping-diagnosis-score.edit', $mappingDiagnosisScore->mapds_id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <button data-modal-target="confirm-delete-modal"
                                                data-modal-toggle="confirm-delete-modal"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline del_button">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>

    {{-- DELETE HeaderQuestion Modal --}}
    <div id="confirm-delete-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full transition-opacity transition-transform duration-300">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-hide="confirm-delete-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Confirm delete?</h3>

                    <form method="POST" action="{{ route('mapping-diagnosis-score.destroy', 0) }}"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button data-modal-hide="confirm-delete-modal" type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <input type="hidden" id="hidMapDiagId" name="hidMapDiagId">
                    </form>
                    <button data-modal-hide="confirm-delete-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelectorAll('.del_button').forEach((item) => {
            item.addEventListener('click', (e) => {
                let mdsID = e.target.closest('tr').querySelector('.mapds_id').innerText;
                document.getElementById('hidMapDiagId').value = mdsID;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(() => {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                $(document).on('click', '.switch-isactive', (e) => {
                    let checked = $(e.target).is(':checked') ? "T" : "F";
                    let mapds_id = $(e.target).attr('id');

                    $.ajax({
                        url: "{{ url('/') }}/mapping-diagnosis-score/update_mapds_is_active",
                        method: "PUT",
                        data: {
                            is_active: checked,
                            mapds_id: mapds_id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (data) => {
                            Toast.fire({
                                icon: 'success',
                                title: `${mapds_id} ${checked === "T" ? "is activated" : "is deactivated"}`
                            });
                        },
                        error: function(data, status, error) {
                            Swal.fire({
                                icon: 'error',
                                html: '<ul><li>data:' + data +
                                    '</li>' +
                                    '<li>status: ' + status +
                                    '</li>' +
                                    '<li>error: ' + error +
                                    '</li>' +
                                    '</ul>'
                            });
                        }
                    })

                });

            });
        }, false);
    </script>
</x-app-layout>
