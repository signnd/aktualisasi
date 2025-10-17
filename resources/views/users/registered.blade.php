<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold">Daftar Pengguna Terdaftar</h1>
    </x-slot>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-400 text-green-700 dark:text-green-400 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 text-red-700 dark:text-red-400 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <div class="rounded-lg shadow p-6 mb-6">
        <h1 class="text-2xl font-bold mb-2">Daftar Pengguna Terdaftar</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Total: {{ $users->total() }} pengguna</p>
    </div>

    <!-- Card Tabel Users -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200 dark:bg-zinc-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider w-16">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Kabupaten</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Satuan Kerja</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($users as $user)
            <tr x-data="{ editing_{{ $user->id }}: false }" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    {{ $user->id }}
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    <div class="flex items-center">
                        <span class="flex h-8 w-8 shrink-0 overflow-hidden rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white items-center justify-center mr-2 text-xs font-semibold">
                            {{ $user->initials() }}
                        </span>
                        {{ $user->name }}
                    </div>
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    {{ $user->email }}
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span x-show="!editing_{{ $user->id }}">
                        @if($user->user_role === 'admin')
                            <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400 rounded-full text-xs font-medium">
                                Admin
                            </span>
                        @else
                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 rounded-full text-xs font-medium">
                                User
                            </span>
                        @endif
                    </span>
                    
                    <form x-show="editing_{{ $user->id }}" action="{{ route('registered-users.update', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="user_role" class="border rounded px-2 py-1 text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:text-white w-full">
                            <option value="user" {{ $user->user_role === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->user_role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    <span x-show="!editing_{{ $user->id }}">
                        @if($user->kabupaten_id && $user->kabupaten)
                            <span class="px-2 py-1 bg-gray-100 dark:bg-zinc-700 rounded text-xs">
                                {{ $user->kabupaten->kabupaten }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </span>
                    
                    <select x-show="editing_{{ $user->id }}" name="kabupaten_id" class="border rounded px-2 py-1 text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:text-white w-full">
                        <option value="">-- Pilih Kabupaten --</option>
                        @foreach($kabupatens as $kab)
                            <option value="{{ $kab->id }}" {{ $user->kabupaten_id == $kab->id ? 'selected' : '' }}>
                                {{ $kab->kabupaten }}
                            </option>
                        @endforeach
                    </select>
                </td>
                
                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                    <span x-show="!editing_{{ $user->id }}">{{ $user->satuan_kerja ?? '-' }}</span>
                    <input x-show="editing_{{ $user->id }}" type="text" name="satuan_kerja" value="{{ $user->satuan_kerja }}" 
                           class="border rounded px-2 py-1 w-full text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:text-white"
                           placeholder="Satuan Kerja">
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                    @if($user->id !== auth()->id())
                        <button type="button" @click="editing_{{ $user->id }} = true" x-show="!editing_{{ $user->id }}"
                                class="text-blue-600 hover:underline">Edit</button>
                        
                        <!-- Tombol simpan & batal -->
                        <div x-show="editing_{{ $user->id }}" class="flex space-x-2">
                            <button type="submit" class="px-2 py-1 bg-green-600 text-white rounded text-xs hover:bg-green-700">✔</button>
                            <button type="button" @click="editing_{{ $user->id }} = false"
                                    class="px-2 py-1 bg-gray-400 text-white rounded text-xs hover:bg-gray-500">✖</button>
                        </div>
                        </form>
                        
                        <!-- Tombol hapus -->
                        <form action="{{ route('registered-users.destroy', $user) }}" method="POST" class="inline">
                            @csrf 
                            @method('DELETE')
                            <button onclick="return confirm('Hapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')" 
                                    class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    @else
                        <span class="text-gray-400 italic text-xs">Akun Anda</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-6 text-gray-500 dark:text-gray-400 italic">
                    Belum ada pengguna terdaftar.
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>