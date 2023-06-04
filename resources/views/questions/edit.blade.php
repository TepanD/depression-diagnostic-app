<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Header Question') }}
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
            <div class="bg-white
                dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative rounded-xl overflow-auto dark:text-slate-200 p-10">

                    <form method="POST" action="{{ route('questions.update', $headerQuestion) }}">
                        @csrf
                        @method('PUT')
                        <x-input-label for="id" :value="__('Header Question ID')" />
                        <input type="text" name="hdq_id" id="txt_hdqid" value="{{ $headerQuestion->hdq_id }}"
                            class="disabled:opacity-75 dark:border-gray-700 dark:bg-gray-900 bg-gray-200 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            @disabled(true) />
                        <br />
                        <br />
                        <x-input-label for="hdq_name" :value="__('Header Question Name')" />
                        <input type="text" name="hdq_name" id="txt_hdqname"
                            value="{{ old('hdq_name', $headerQuestion->hdq_name) }}"
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
                            value="{{ old('hdq_sequence', $headerQuestion->hdq_sequence) }}"
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
                            {{-- <input type="hidden" name="is_active" value="F"> --}}
                            <input {{ old('is_active', $headerQuestion->is_active) == 'T' ? 'checked' : '' }}
                                id="cb_isactive" type="checkbox" name="is_active" value="T"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="cb_isactive"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Is
                                Active</label>
                        </div>

                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            type="submit">update</button>
                    </form>


                    <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-12 mb-4">
                        Detail Questions
                    </h3>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div id="dtq_message"></div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        dtq_id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        dtq_name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        dtq_sequence
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        score
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_dtq">

                            </tbody>
                        </table>
                        {{ csrf_field() }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(() => {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
            });

            const fetch_data = () => {
                $.ajax({
                    url: "{{ url('/') }}/questions/fetch_detail_question",
                    data: {
                        hdq_id: "{{ $headerQuestion->hdq_id }}"
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    // dataType: "json",
                    success: function(data) {
                        let html = '';
                        //top row to add new detial question
                        html += '<tr>';
                        html +=
                            '<td scope="row" id="txt_dtqid" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white border-b border-gray-200"></td>';
                        html +=
                            '<td contenteditable id="txt_dtqname" class="px-6 py-4 border-l border-r border-b border-gray-200"></td>';
                        html +=
                            '<td contenteditable id="txt_dtqsequence" class="px-6 py-4 border-l border-r border-gray-200 border-b border-gray-200"></td>';
                        html +=
                            '<td contenteditable id="txt_dtqscore" class="px-6 py-4 border-l border-r border-gray-200 border-b border-gray-200"></td>';
                        html +=
                            '<td class="px-6 py-2 border-b border-gray-200" ><button type="button" id="btn_addDtq" class="px-4 py-2 text-xs font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add</button></td></tr>';

                        //loop through detail questions data
                        for (let count = 0; count < data.length; count++) {
                            html +=
                                '<tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">';
                            html +=
                                '<th scope="row" class="column_name px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' +
                                data[count].dtq_id + '</th>';
                            html +=
                                '<td contenteditable class="column_name px-6 py-4" data-column_name="dtq_name" data-id="' +
                                data[count].dtq_id + '">' + data[
                                    count].dtq_name +
                                '</td>';
                            html +=
                                '<td contenteditable class="column_name px-6 py-4" data-column_name="dtq_sequence" data-id="' +
                                data[count].dtq_id + '">' + data[
                                    count]
                                .dtq_sequence + '</td>';
                            html +=
                                '<td contenteditable class="column_name px-6 py-4" data-column_name="score" data-id="' +
                                data[count].dtq_id + '">' + data[
                                    count].score +
                                '</td>';
                            html +=
                                '<td>' +
                                '<button href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline del_button" id=' +
                                data[count].dtq_id + '>Delete</button>' +
                                '</td> </tr>';
                        }
                        $('#tbody_dtq').html(html);
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

            fetch_data();

            $(document).on('click', '#btn_addDtq', () => {
                let dtq_name = $('#txt_dtqname').text();
                let dtq_sequence = $('#txt_dtqsequence').text();
                let dtq_score = $('#txt_dtqscore').text();
                let hdq_id = $('#txt_hdqid').val();

                if (dtq_name != '' && dtq_sequence != '' && dtq_score != '') {
                    $.ajax({
                        url: "{{ url('/') }}/questions/store_detail_question",
                        method: "POST",
                        data: {
                            dtq_name: dtq_name,
                            dtq_sequence: dtq_sequence,
                            score: dtq_score,
                            hdq_id: hdq_id,
                            create_operator: '3'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            fetch_data();
                            Toast.fire({
                                type: 'success',
                                icon: 'success',
                                title: data
                            });
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
                } else {
                    $('#dtq_message').html(
                        '<span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">all fields are required < /span> '
                    );
                }
            });

            $(document).on('blur', '.column_name', (e) => {
                let column_name = $(e.target).data("column_name");
                let column_value = $(e.target).text();
                let dtq_id = $(e.target).data("id");

                if (column_value != "") {
                    $.ajax({
                        url: "{{ url('/') }}/questions/update_detail_question",
                        method: "PUT",
                        data: {
                            column_name: column_name,
                            column_value: column_value,
                            dtq_id: dtq_id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (data) => {
                            Toast.fire({
                                icon: 'success',
                                title: data,
                            });
                        }
                    })
                } else {
                    $('#dtq_message').html(
                        '<span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">Enter Value to Update</span> '
                    );
                }
            });

            $(document).on('click', '.del_button', (e) => {
                let dtq_id = $(e.target).attr("id");
                Swal.fire({
                    title: 'Delete DetailQuestion ' + dtq_id + '?',
                    icon: 'warning',
                    text: "This action cannot be reverted",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/') }}/questions/destroy_detail_question",
                            method: "DELETE",
                            data: {
                                dtq_id: dtq_id,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            success: (data) => {
                                Toast.fire({
                                    icon: 'success',
                                    title: data,
                                });
                                fetch_data();
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
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });
            });

        });
    }, false);
</script>
