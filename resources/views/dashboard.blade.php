<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a class="bg-blue-50 p-4 rounded-lg text-center" href="{{ route('riab.index') }}">
                <p class="text-2xl font-bold text-blue-600">{{ $counts['riab'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Rumah Ibadah Agama Buddha</p>
            </a>
            <a class="bg-red-50 p-4 rounded-lg text-center" href={{ route('okb.index') }}>
                <p class="text-2xl font-bold text-red-600">{{ $counts['okb'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Organisasi Keagamaan Buddha</p>
            </a>
            <a class="bg-yellow-50 p-4 rounded-lg text-center" href={{ route('majelis.index') }}>
                <p class="text-2xl font-bold text-yellow-600">{{ $counts['majelis'] }}</p>
                <p class="text-sm text-gray-800">Jumlah Majelis</p>
            </a>
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <a class="bg-cyan-50 p-4 rounded-lg text-center" href={{ route('yayasan.index') }}>
                    <p class="text-2xl font-bold text-cyan-600">{{ $counts['yayasan'] }}</p>
                    <p class="text-sm text-gray-800">Jumlah Yayasan</p>
                </a>
                <a class="bg-indigo-50 p-4 rounded-lg text-center" href={{ route('smb.index') }}>
                    <p class="text-2xl font-bold text-indigo-600">{{ $counts['smb'] }}</p>
                    <p class="text-sm text-gray-800">Jumlah Sekolah Minggu Buddha</p>
                </a>
                <a class="bg-emerald-50 p-4 rounded-lg text-center" href={{ route('guru-penda.index') }}>
                    <p class="text-2xl font-bold text-emerald-600">{{ $counts['gurupenda'] }}</p>
                    <p class="text-sm text-gray-800">Jumlah Guru Pendidikan Agama Buddha</p>
                </a>
        </div>
        <!--<div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>-->
    </div>
</x-layouts.app>
