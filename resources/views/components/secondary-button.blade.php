<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-primary-dark dark:border-gray-500 rounded-md font-semibold text-xs text-primary dark:text-primary-dark uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-primary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
