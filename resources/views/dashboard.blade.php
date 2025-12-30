<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-2xl font-bold">Selamat Datang</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a class="bg-blue-50 p-4 rounded-lg text-center hover:bg-blue-100" href="{{ route('riab.index') }}">
                <p class="text-2xl font-bold text-blue-600">{{ $counts['riab'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Rumah Ibadah Agama Buddha</p>
            </a>
            <a class="bg-red-50 p-4 rounded-lg text-center hover:bg-red-100" href={{ route('okb.index') }}>
                <p class="text-2xl font-bold text-red-600">{{ $counts['okb'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Organisasi Keagamaan Buddha</p>
            </a>
            <a class="bg-yellow-50 p-4 rounded-lg text-center hover:bg-yellow-100" href={{ route('majelis.index') }}>
                <p class="text-2xl font-bold text-yellow-600">{{ $counts['majelis'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Majelis</p>
            </a>
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a class="bg-cyan-50 p-4 rounded-lg text-center hover:bg-cyan-100" href={{ route('yayasan.index') }}>
                <p class="text-2xl font-bold text-cyan-600">{{ $counts['yayasan'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Yayasan</p>
            </a>
            <a class="bg-indigo-50 p-4 rounded-lg text-center hover:bg-indigo-100" href={{ route('smb.index') }}>
                <p class="text-2xl font-bold text-indigo-600">{{ $counts['smb'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Sekolah Minggu Buddha</p>
            </a>
            <a class="bg-pink-50 p-4 rounded-lg text-center hover:bg-pink-100" href={{ route('smb.index') }}>
                <p class="text-2xl font-bold text-pink-600">{{ $counts['siswasmb'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Siswa Sekolah Minggu</p>
            </a>
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a class="bg-lime-50 p-4 rounded-lg text-center hover:bg-lime-100" href={{ route('dhammasekha.index') }}>
                <p class="text-2xl font-bold text-lime-600">{{ $counts['dhammasekha'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Dhammasekha</p>
            </a>
            <a class="bg-fuchsia-50 p-4 rounded-lg text-center hover:bg-fuchsia-100" href={{ route('pusdiklat.index') }}>
                <p class="text-2xl font-bold text-fuchsia-600">{{ $counts['pusdiklat'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Pusdiklat</p>
            </a>
            <a class="bg-emerald-50 p-4 rounded-lg text-center hover:bg-emerald-100" href={{ route('guru-penda.index') }}>
                <p class="text-2xl font-bold text-emerald-600">{{ $counts['gurupenda'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Guru Pendidikan Agama Buddha</p>
            </a>
        </div>
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Internal</h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @forelse($informasiInternal as $info)
                    <a href="{{ route('informasi.show', $info) }}" class="block p-4 bg-gray-50 hover:bg-gray-100 dark:bg-zinc-800 rounded-lg">
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ \Illuminate\Support\Str::limit($info->judul, 60) }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $info->ringkasan ?? \Illuminate\Support\Str::limit($info->ringkasan, 120) }}</p>
                        <p class="text-xs text-gray-400 mt-3">{{ $info->created_at?->format('d M Y') }}</p>
                    </a>
                @empty
                    <p class="text-sm text-gray-500">Belum ada Informasi Internal.</p>
                @endforelse
            </div>
            <div class="py-5">
                <div class="flex justify-end">
                    <a href="{{ route('informasi.index', ['kategori' => 'Informasi Internal']) }}"
                   class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow-md">
                    Lihat informasi internal lainnya
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" fill="none" viewBox="0 0 28 28" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6l6 6-6 6" />
                </svg>
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
