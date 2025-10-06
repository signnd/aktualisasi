<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail RIAB') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-grey-500 border border-gray-600 shadow rounded-lg p-6 space-y-4">
                <h3 class="text-lg font-bold">{{ $riab->nama }}</h3>
                <p><strong>No Registrasi:</strong> {{ $riab->no_registrasi }}</p>
                <p><strong>Kabupaten:</strong> {{ $riab->kabupaten->kabupaten ?? '-' }}</p>
                <p><strong>Kecamatan:</strong> {{ $riab->kecamatan->kecamatan ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $riab->alamat ?? '-' }}</p>
                <p><strong>Kondisi:</strong> {{ $riab->kondisi ?? '-' }}</p>

                <div class="pt-4">
                    <a href="{{ route('riab.index') }}" 
                       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
