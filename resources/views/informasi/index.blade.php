<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Informasi') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ kabupatenId: '{{ $selectedKabupatenId ?? '' }}' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            @if(session('success'))
                <div id="success-message" class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-lg animate-fade-in">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="font-semibold">Berhasil!</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button onclick="closeMessage()" class="text-green-700 hover:text-green-900 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Error Message (jika diperlukan) -->
            @if(session('error'))
                <div id="error-message" class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg shadow-lg animate-fade-in">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="font-semibold">Gagal!</p>
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button onclick="closeErrorMessage()" class="text-red-700 hover:text-red-900 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

        <!-- Header dengan Filter dan Tombol Tambah -->
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h3 class="text-2xl font-bold">Informasi</h3>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <!-- Filter Kabupaten -->
                </form>
                
                <!-- Tombol Tambah Informasi -->
                <a href="{{ route('informasi.create') }}" 
                   class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center shadow-lg whitespace-nowrap">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Tambah Informasi
                </a>
            </div>
        </div>
        <!-- Table Content pindah ke livewire/informasi-search.blade.php -->

    <!-- Livewire Component -->
    @livewire('informasi-search')
            </form>
            </div>
        </div>

    </div>

    <!-- JavaScript untuk Auto-hide Message -->
    <script>
        // Auto hide success message after 5 seconds
        setTimeout(function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.transition = 'opacity 0.5s ease-out';
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.remove(), 500);
            }
        }, 5000);

        setTimeout(function() {
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.transition = 'opacity 0.5s ease-out';
                errorMessage.style.opacity = '0';
                setTimeout(() => errorMessage.remove(), 500);
            }
        }, 5000);

        // Manual close button
        function closeMessage() {
            const message = document.getElementById('success-message');
            message.style.transition = 'opacity 0.5s ease-out';
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 500);
        }

        function closeErrorMessage() {
            const message = document.getElementById('error-message');
            message.style.transition = 'opacity 0.5s ease-out';
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 500);
        }
    </script>

    <!-- Tambahan CSS untuk animasi -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</x-app-layout>