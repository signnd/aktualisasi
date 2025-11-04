<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        </div>
    </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-yellow-950 rounded-lg bg-opacity-75 p-15">

            <p>Anda tidak memiliki akses untuk melakukan tindakan ini.</p>
            </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <a href="{{ url()->previous() }}" 
                   class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition duration-200">
                    Kembali
                </a>
                <a href="{{ route('dashboard') }}" 
                   class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-zinc-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition duration-200">
                    Dashboard
                </a>
            </div>

        </div>
</x-app-layout>