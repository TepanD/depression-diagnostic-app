<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mapping Diagnosis Score') }}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-32">
            <div class="container mx-auto dark:bg">

                {{-- HIDDEN VALUES --}}
                {{-- <span id="update_id" style="display:hidden;"></span> --}}

                {{-- TABLE CONTAINER TESTING STYLE --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-8">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        user_id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        user_name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        is_admin
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row" class="px-6 py-4 mapds_id">
                                            {{ $user->id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->email }}
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            {{ $mappingDiagnosisScore->result_desc }}
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            <label class="relative inline-flex items-center mb-4 cursor-pointer">
                                                <input {{ $user->role == 'admin' ? 'checked' : '' }} type="checkbox"
                                                    id="{{ $user->id }}" class="sr-only peer switch-isadmin">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{ $users->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(() => {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                $(document).on('click', '.switch-isadmin', (e) => {
                    let role = $(e.target).is(':checked') ? "admin" : "user";
                    let user_id = $(e.target).attr('id');

                    $.ajax({
                        url: "{{ url('/') }}/users/update_user_role",
                        method: "PUT",
                        data: {
                            role: role,
                            user_id: user_id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (data) => {
                            Toast.fire({
                                icon: 'success',
                                title: `role changed to ${role}`
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
