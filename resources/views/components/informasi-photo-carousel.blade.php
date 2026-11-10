@props(['photos', 'title'])

@php
    $photos = array_values($photos);
    $photoCount = count($photos);
@endphp

@if($photoCount > 1)
    <div x-data="{ active: 0, total: {{ $photoCount }} }"
         class="relative overflow-hidden rounded-lg border border-gray-200 bg-gray-100 dark:border-zinc-700 dark:bg-zinc-900">
        <div class="relative h-96">
            @foreach($photos as $photo)
                <a x-show="active === {{ $loop->index }}"
                   x-transition.opacity.duration.300ms
                   href="{{ $photo }}"
                   target="_blank"
                   style="{{ $loop->first ? '' : 'display: none;' }}"
                   class="absolute inset-0 flex items-center justify-center"
                   aria-label="Buka foto {{ $loop->iteration }} di tab baru">
                    <img src="{{ $photo }}" alt="Foto {{ $title }} {{ $loop->iteration }}"
                         class="h-full w-full object-contain">
                </a>
            @endforeach
        </div>

        <button type="button"
                @click="active = active === 0 ? total - 1 : active - 1"
                class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white transition hover:bg-black/70 focus:outline-none focus:ring-2 focus:ring-white"
                aria-label="Foto sebelumnya">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <button type="button"
                @click="active = active === total - 1 ? 0 : active + 1"
                class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white transition hover:bg-black/70 focus:outline-none focus:ring-2 focus:ring-white"
                aria-label="Foto berikutnya">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <div class="absolute bottom-3 left-0 right-0 flex justify-center gap-2">
            @foreach($photos as $photo)
                <button type="button"
                        @click="active = {{ $loop->index }}"
                        :class="active === {{ $loop->index }} ? 'bg-white scale-110' : 'bg-white/50'"
                        class="h-2.5 w-2.5 rounded-full transition"
                        aria-label="Tampilkan foto {{ $loop->iteration }}"></button>
            @endforeach
        </div>

        <div class="absolute right-3 top-3 rounded-full bg-black/50 px-2.5 py-1 text-xs font-medium text-white">
            <span x-text="active + 1">1</span> / {{ $photoCount }}
        </div>
    </div>
@elseif($photoCount === 1)
    <a href="{{ $photos[0] }}" target="_blank"
       class="block overflow-hidden rounded-lg border border-gray-200 dark:border-zinc-700">
        <img src="{{ $photos[0] }}" alt="Foto {{ $title }}"
             class="mx-auto max-h-96 w-auto object-contain">
    </a>
@endif
