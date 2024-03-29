<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Question') }}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-32">
            <div class="container mx-auto dark:bg">

                {{-- UPPER CONTAINER --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-5">
                    <div class="relative rounded-xl">
                        <div class="flex items-center shadow-sm overflow-hidden p-4">
                            <a href="{{ route('questions.create') }}"
                                class="mr-6 px-4 py-2 font-semibold text-sm hover:bg-blue-500 bg-blue-600 duration-100 text-white rounded-md shadow-sm opacity-100">Add</a>


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
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        hdq_id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        hdq_name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        seq
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
                                @foreach ($headerQuestions as $key => $headerQuestion)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="px-6 py-4 hdq_id">
                                            {{ $headerQuestions->firstItem() + $key }}
                                        </td>
                                        <td scope="row" class="px-6 py-4 hdq_id">
                                            {{ $headerQuestion->hdq_id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerQuestion->hdq_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerQuestion->hdq_sequence }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                                <input {{ $headerQuestion->is_active == 'T' ? 'checked' : '' }}
                                                    type="checkbox" id="{{ $headerQuestion->hdq_id }}"
                                                    class="sr-only peer switch-isactive">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerQuestion->created_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerQuestion->create_operator }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerQuestion->updated_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $headerQuestion->last_operator }}
                                        </td>
                                        <td class="flex items-center px-6 py-4 space-x-3">
                                            <a href="{{ route('questions.edit', $headerQuestion->hdq_id) }}"
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

                {{ $headerQuestions->links() }}

            </div>
        </div>
    </div>

    {{-- DELETE HeaderQuestion Modal --}}
    <div id="confirm-delete-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300">
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
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Confirm delete Header
                        Question?</h3>

                    <form method="POST" action="{{ route('questions.destroy', 0) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button data-modal-hide="confirm-delete-modal" type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <input type="hidden" id="hidHdqID" name="hidHdqID">
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
                let hdqID = e.target.closest('tr').querySelector('.hdq_id').innerText;
                console.log(hdqID);
                document.getElementById('hidHdqID').value = hdqID;
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
                    let hdq_id = $(e.target).attr('id');

                    $.ajax({
                        url: "{{ url('/') }}/questions/update_hdq_is_active",
                        method: "PUT",
                        data: {
                            is_active: checked,
                            hdq_id: hdq_id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (data) => {
                            Toast.fire({
                                icon: 'success',
                                title: `${hdq_id} ${checked === "T" ? "is activated" : "is deactivated"}`
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
                    });
                });

            });
        }, false);
    </script>
</x-app-layout>
