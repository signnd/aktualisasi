<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar RIAB') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-amber-90 shadow rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Data RIAB</h3>
                    <a href="{{ route('riab.create') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        + Tambah RIAB
                    </a>
                </div>
                <table class="min-w-full text-sm text-left rounded-lg">
                    <thead class="bg-gray-600 text-white-500">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Kabupaten</th>
                            <th class="px-4 py-2">Kecamatan</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riabs as $riab)
                        <tr class="hover:bg-gray-800">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $riab->nama }}</td>
                            <td class="px-4 py-2">{{ $riab->kabupaten->kabupaten ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $riab->kecamatan->kecamatan ?? '-' }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('riab.show', $riab) }}" class="px-4 py-2 sm:my-5 md:my-1 bg-blue-800 text-white rounded hover:bg-blue-700 shadow">Lihat</a>
                                <a href="{{ route('riab.edit', $riab) }}" class="px-4 py-2 sm:my-5 md:my-1 bg-green-800 text-white rounded hover:bg-green-700">Edit</a>
                                <form action="{{ route('riab.destroy', $riab) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="rounded hover:underline px-3 py-2 bg-red-800" 
                                            onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $riabs->links() }}
                </div>
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
