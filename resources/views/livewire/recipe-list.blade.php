<div>
    <!-- Search and Filter Bar -->
    <div class="mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
        <!-- Live Search Input -->
        <div class="relative w-full md:w-96">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Cari resep (mendoan, orek, sambal)..." 
                class="w-full pl-12 pr-4 py-3.5 bg-surface-container-lowest rounded-2xl border border-outline-variant/40 focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm font-body-md"
            />
            <div wire:loading wire:target="search" class="absolute right-4 top-1/2 -translate-y-1/2">
                <span class="material-symbols-outlined animate-spin text-primary text-xl">progress_activity</span>
            </div>
        </div>

        <!-- Category Pills Filter -->
        <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
            <button 
                type="button" 
                wire:click="setCategory('')"
                class="px-4 py-2 rounded-full text-xs font-label-bold transition-all {{ $category === '' ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container' }}"
            >
                Semua
            </button>
            @foreach($categories as $cat)
                <button 
                    type="button" 
                    wire:click="setCategory({{ $cat->id }})"
                    class="px-4 py-2 rounded-full text-xs font-label-bold transition-all {{ (string)$category === (string)$cat->id ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container' }}"
                >
                    {{ $cat->nama_kategori }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Recipe Grid -->
    @if($recipes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg items-start">
            @foreach($recipes as $resep)
                <article class="group bg-surface rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-64 overflow-hidden relative">
                        <img 
                            src="{{ $resep->first_image }}" 
                            alt="{{ $resep->judul }}" 
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        />
                        <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                            {{ $resep->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>
                    <div class="p-lg flex flex-col flex-1">
                        <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">{{ $resep->judul }}</h3>
                        <p class="text-body-sm text-on-surface-variant mb-md italic">Oleh: {{ $resep->penulis ?? 'Sobat Kos' }}</p>
                        
                        <div class="flex items-center gap-4 text-xs text-on-surface-variant font-label-bold mb-lg pb-md border-b border-outline-variant/10">
                            @if($resep->durasi)
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">schedule</span> {{ $resep->durasi }}
                                </span>
                            @endif
                            @if($resep->biaya)
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">payments</span> {{ $resep->biaya }}
                                </span>
                            @endif
                        </div>

                        <a 
                            href="{{ route('resep.show', $resep->id) }}" 
                            wire:navigate
                            class="mt-auto inline-flex items-center justify-center gap-2 text-primary font-label-bold py-3 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors w-full"
                        >
                            Baca Selengkapnya
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $recipes->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-surface-container-lowest rounded-3xl border border-outline-variant/30 p-8">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant/50 mb-4">search_off</span>
            <h3 class="text-xl font-headline-md text-on-surface mb-2">Resep Tidak Ditemukan</h3>
            <p class="text-on-surface-variant text-sm max-w-md mx-auto mb-6">
                Belum ada resep yang sesuai dengan kata kunci "{{ $search }}". Mau jadi yang pertama membagikannya?
            </p>
            @auth
                <a href="{{ route('resep.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl font-label-bold hover:shadow-lg transition-all text-sm">
                    <span class="material-symbols-outlined text-sm">add</span> Tambah Resep Sekarang
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl font-label-bold hover:shadow-lg transition-all text-sm">
                    Masuk & Tambah Resep
                </a>
            @endauth
        </div>
    @endif
</div>
