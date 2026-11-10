@extends('layouts.app')

@section('content')
<div class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('resep.index') }}" wire:navigate class="inline-flex items-center gap-2 text-primary hover:underline font-label-bold text-sm">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Katalog Resep
        </a>
    </div>

    <article class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-lg border border-outline-variant/30">
        <!-- Media Image / Carousel -->
        @php
            $mediaList = $resep->media_list;
            if (empty($mediaList)) {
                $mediaList = [$resep->first_image];
            }
        @endphp
        <div class="relative w-full h-80 sm:h-96 overflow-hidden bg-black/5" x-data="{ current: 0, total: {{ count($mediaList) }} }">
            @foreach($mediaList as $index => $item)
                @php
                    $imgUrl = (str_starts_with($item, 'http://') || str_starts_with($item, 'https://')) ? $item : asset($item);
                @endphp
                <div x-show="current === {{ $index }}" class="w-full h-full transition-opacity duration-300">
                    <img src="{{ $imgUrl }}" alt="{{ $resep->judul }}" class="w-full h-full object-cover" />
                </div>
            @endforeach

            @if(count($mediaList) > 1)
                <!-- Carousel Controls -->
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
                        <span 
                            class="w-2.5 h-2.5 rounded-full transition-all"
                            :class="current === {{ $index }} ? 'bg-white shadow' : 'bg-white/50'"
                        ></span>
                    @endforeach
                </div>
            @endif

            <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow">
                {{ $resep->kategori->nama_kategori ?? 'Umum' }}
            </span>
        </div>

        <div class="p-8 sm:p-12">
            <!-- Header -->
            <div class="border-b border-outline-variant/30 pb-8 mb-8">
                <h1 class="font-headline-xl text-3xl sm:text-4xl text-on-surface mb-3 font-bold">{{ $resep->judul }}</h1>
                <p class="text-on-surface-variant text-sm mb-6">
                    Dibagikan oleh <span class="font-label-bold text-on-surface">{{ $resep->penulis ?: 'Sobat Kos' }}</span> • {{ $resep->created_at ? $resep->created_at->diffForHumans() : 'Baru saja' }}
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="bg-surface-container-low p-4 rounded-2xl flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-2xl">schedule</span>
                        <div>
                            <span class="text-xs text-on-surface-variant block font-label-bold">DURASI</span>
                            <span class="font-bold text-sm text-on-surface">{{ $resep->durasi ?: '-' }}</span>
                        </div>
                    </div>
                    <div class="bg-surface-container-low p-4 rounded-2xl flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-2xl">payments</span>
                        <div>
                            <span class="text-xs text-on-surface-variant block font-label-bold">BIAYA</span>
                            <span class="font-bold text-sm text-on-surface">{{ $resep->biaya ?: '-' }}</span>
                        </div>
                    </div>
                    <div class="bg-surface-container-low p-4 rounded-2xl flex items-center gap-3 col-span-2 sm:col-span-1">
                        <span class="material-symbols-outlined text-primary text-2xl">category</span>
                        <div>
                            <span class="text-xs text-on-surface-variant block font-label-bold">KATEGORI</span>
                            <span class="font-bold text-sm text-on-surface">{{ $resep->kategori->nama_kategori ?? 'Umum' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content: Bahan & Langkah -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Bahan -->
                <div>
                    <h2 class="font-headline-md text-xl text-primary font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined">shopping_basket</span> Bahan-bahan
                    </h2>
                    <ul class="space-y-2.5 text-body-md text-on-surface-variant">
                        @foreach(preg_split("/\r\n|\n|\r/", $resep->bahan) as $line)
                            @if(trim($line) !== '')
                                <li class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-primary text-sm mt-1">check_circle</span>
                                    <span>{{ $line }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <!-- Langkah -->
                <div>
                    <h2 class="font-headline-md text-xl text-primary font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined">menu_book</span> Langkah Memasak
                    </h2>
                    <ol class="space-y-3 text-body-md text-on-surface-variant">
                        @php $step = 1; @endphp
                        @foreach(preg_split("/\r\n|\n|\r/", $resep->langkah) as $line)
                            @if(trim($line) !== '')
                                <li class="flex items-start gap-3">
                                    <span class="w-6 h-6 rounded-full bg-primary-container text-on-primary-container text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
                                        {{ $step++ }}
                                    </span>
                                    <span>{{ preg_replace('/^\d+[\.\)]\s*/', '', $line) }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </article>
</div>
@endsection
