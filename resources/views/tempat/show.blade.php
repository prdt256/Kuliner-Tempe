@extends('layouts.app')

@section('content')
<div class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('tempat.index') }}" wire:navigate class="inline-flex items-center gap-2 text-primary hover:underline font-label-bold text-sm">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Daftar Tempat
        </a>
    </div>

    <article class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-lg border border-outline-variant/30">
        <!-- Media Carousel -->
        @php
            $mediaList = $tempat->media_list;
            if (empty($mediaList)) {
                $mediaList = [$tempat->first_image];
            }
        @endphp
        <div class="relative w-full h-80 sm:h-96 overflow-hidden bg-black/5" x-data="{ current: 0, total: {{ count($mediaList) }} }">
            @foreach($mediaList as $index => $item)
                @php
                    $imgUrl = (str_starts_with($item, 'http://') || str_starts_with($item, 'https://')) ? $item : asset($item);
                @endphp
                <div x-show="current === {{ $index }}" class="w-full h-full transition-opacity duration-300">
                    <img src="{{ $imgUrl }}" alt="{{ $tempat->nama_restoran }}" class="w-full h-full object-cover" />
                </div>
            @endforeach

            @if(count($mediaList) > 1)
                <button 
                    @click="current = (current - 1 + total) % total" 
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-on-surface p-2 rounded-full shadow-md backdrop-blur-sm"
                >
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button 
                    @click="current = (current + 1) % total" 
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-on-surface p-2 rounded-full shadow-md backdrop-blur-sm"
                >
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5">
                    @foreach($mediaList as $index => $item)
                        <span class="w-2.5 h-2.5 rounded-full transition-all" :class="current === {{ $index }} ? 'bg-white shadow' : 'bg-white/50'"></span>
                    @endforeach
                </div>
            @endif

            <span class="absolute top-4 right-4 bg-tertiary-container text-on-tertiary-container px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">storefront</span> Tempat Kuliner
            </span>
        </div>

        <div class="p-8 sm:p-12">
            <!-- Header -->
            <div class="border-b border-outline-variant/30 pb-8 mb-8">
                <h1 class="font-headline-xl text-3xl sm:text-4xl text-on-surface mb-3 font-bold">{{ $tempat->nama_restoran }}</h1>
                <p class="text-body-md text-on-surface-variant flex items-start gap-2 mb-6">
                    <span class="material-symbols-outlined text-primary text-xl shrink-0 mt-0.5">location_on</span>
                    <span>{{ $tempat->alamat }}</span>
                </p>

                @if($tempat->latitude && $tempat->longitude)
                    <div class="flex items-center gap-3">
                        <a 
                            href="https://www.google.com/maps/search/?api=1&query={{ $tempat->latitude }},{{ $tempat->longitude }}" 
                            target="_blank" 
                            class="inline-flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-xl font-label-bold text-xs hover:shadow-lg transition-all"
                        >
                            <span class="material-symbols-outlined text-sm">map</span> Buka di Google Maps
                        </a>
                        <span class="text-xs text-on-surface-variant font-mono">
                            {{ $tempat->latitude }}, {{ $tempat->longitude }}
                        </span>
                    </div>
                @endif
            </div>

            <!-- Deskripsi -->
            <div class="mb-10">
                <h2 class="font-headline-md text-xl text-on-surface font-bold mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">description</span> Tentang Tempat Ini
                </h2>
                <div class="text-on-surface-variant text-body-md leading-relaxed whitespace-pre-line">
                    {{ $tempat->deskripsi }}
                </div>
            </div>

            <!-- Daftar Menu -->
            <div>
                <h2 class="font-headline-md text-xl text-on-surface font-bold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">restaurant</span> Menu Unggulan
                </h2>

                @if($tempat->menu->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($tempat->menu as $menu)
                            <div class="p-5 rounded-2xl bg-surface-container-low border border-outline-variant/30 flex justify-between items-start">
                                <div>
                                    <h3 class="font-label-bold text-on-surface text-base mb-1">{{ $menu->nama_menu }}</h3>
                                    @if($menu->deskripsi)
                                        <p class="text-xs text-on-surface-variant">{{ $menu->deskripsi }}</p>
                                    @endif
                                </div>
                                <span class="text-primary font-bold text-sm shrink-0 ml-4">
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 rounded-2xl bg-surface-container-low text-center text-on-surface-variant text-sm">
                        Belum ada daftar menu spesifik yang dicatat untuk tempat ini.
                    </div>
                @endif
            </div>
        </div>
    </article>
</div>
@endsection
