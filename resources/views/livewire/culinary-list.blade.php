<div>
    <!-- Search Bar -->
    <div class="mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="relative w-full md:w-96">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Cari tempat (Purwokerto, Jogja, warung)..." 
                class="w-full pl-12 pr-4 py-3.5 bg-surface-container-lowest rounded-2xl border border-outline-variant/40 focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm font-body-md"
            />
            <div wire:loading wire:target="search" class="absolute right-4 top-1/2 -translate-y-1/2">
                <span class="material-symbols-outlined animate-spin text-primary text-xl">progress_activity</span>
            </div>
        </div>
        <p class="text-sm text-on-surface-variant font-label-bold">
            Menampilkan {{ $restaurants->total() }} tempat kuliner
        </p>
    </div>

    <!-- Culinary Spots Grid -->
    @if($restaurants->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg items-start">
            @foreach($restaurants as $tempat)
                <article class="group bg-surface-container-lowest rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-64 overflow-hidden relative">
                        <img 
                            src="{{ $tempat->first_image }}" 
                            alt="{{ $tempat->nama_restoran }}" 
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        />
                        <span class="absolute top-4 right-4 bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">location_on</span> Rekomendasi
                        </span>
                    </div>
                    <div class="p-lg flex flex-col flex-1">
                        <h3 class="font-headline-md text-headline-md text-on-surface mb-2">{{ $tempat->nama_restoran }}</h3>
                        <p class="text-body-sm text-on-surface-variant mb-4 flex items-start gap-1">
                            <span class="material-symbols-outlined text-[16px] text-primary shrink-0 mt-0.5">place</span>
                            <span>{{ Str::limit($tempat->alamat, 65) }}</span>
                        </p>
                        <p class="text-xs text-on-surface-variant/80 mb-6 line-clamp-2">
                            {{ $tempat->deskripsi }}
                        </p>
                        
                        <a 
                            href="{{ route('tempat.show', $tempat->id) }}" 
                            wire:navigate
                            class="mt-auto inline-flex items-center justify-center gap-2 text-primary font-label-bold py-3 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors w-full"
                        >
                            Lihat Menu & Lokasi
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $restaurants->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-surface-container-lowest rounded-3xl border border-outline-variant/30 p-8">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant/50 mb-4">store_mall_directory</span>
            <h3 class="text-xl font-headline-md text-on-surface mb-2">Tempat Kuliner Tidak Ditemukan</h3>
            <p class="text-on-surface-variant text-sm max-w-md mx-auto mb-6">
                Tidak ada tempat makan yang sesuai dengan "{{ $search }}". Punya rekomendasi warung tempe favorit?
            </p>
            @auth
                <a href="{{ route('tempat.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl font-label-bold hover:shadow-lg transition-all text-sm">
                    <span class="material-symbols-outlined text-sm">add</span> Tambah Tempat Kuliner
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl font-label-bold hover:shadow-lg transition-all text-sm">
                    Masuk & Tambah Tempat
                </a>
            @endauth
        </div>
    @endif
</div>
