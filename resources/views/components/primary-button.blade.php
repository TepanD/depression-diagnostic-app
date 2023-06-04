<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-blue-700 shadow-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs uppercase font-semibold px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
{{-- inline-flex items-center px-4 py-2  bg-blue-700 shadow-lg transform transition-transform hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest dark:hover:bg-white dark:focus:bg-white active:bg-blue-900 dark:active:bg-gray-300 dark:focus:ring-offset-gray-800  --}}
