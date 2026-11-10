<div class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-max-width mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-primary font-label-bold text-sm mb-1">
                <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span>
                <span>PANEL ADMINISTRATOR</span>
            </div>
            <h1 class="font-headline-xl text-headline-xl text-on-surface">Dashboard Manajemen Tempeku</h1>
            <p class="text-on-surface-variant text-body-md">Kelola seluruh data resep, tempat kuliner, dan kategori sistem.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('resep.create') }}" class="inline-flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-xl font-label-bold text-sm hover:shadow-lg transition-all">
                <span class="material-symbols-outlined text-sm">add</span> Tambah Resep
            </a>
            <a href="{{ route('tempat.create') }}" class="inline-flex items-center gap-2 bg-secondary text-on-secondary px-5 py-2.5 rounded-xl font-label-bold text-sm hover:shadow-lg transition-all">
                <span class="material-symbols-outlined text-sm">add_business</span> Tambah Tempat
            </a>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-2xl bg-primary-container text-on-primary-container font-label-bold flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('message') }}
        </div>
    @endif

    <!-- Stat Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-10">
        <div class="p-6 bg-surface-container-lowest rounded-3xl border border-outline-variant/30 shadow-sm">
            <div class="w-12 h-12 bg-primary-container/40 text-primary rounded-2xl flex items-center justify-center mb-3">
                <span class="material-symbols-outlined">restaurant_menu</span>
            </div>
            <p class="text-xs text-on-surface-variant font-label-bold uppercase">Total Resep</p>
            <h3 class="text-3xl font-headline-xl text-on-surface font-bold mt-1">{{ $totalRecipes }}</h3>
        </div>

        <div class="p-6 bg-surface-container-lowest rounded-3xl border border-outline-variant/30 shadow-sm">
            <div class="w-12 h-12 bg-tertiary-container/40 text-tertiary rounded-2xl flex items-center justify-center mb-3">
                <span class="material-symbols-outlined">storefront</span>
            </div>
            <p class="text-xs text-on-surface-variant font-label-bold uppercase">Tempat Kuliner</p>
            <h3 class="text-3xl font-headline-xl text-on-surface font-bold mt-1">{{ $totalPlaces }}</h3>
        </div>

        <div class="p-6 bg-surface-container-lowest rounded-3xl border border-outline-variant/30 shadow-sm">
            <div class="w-12 h-12 bg-secondary-container text-secondary rounded-2xl flex items-center justify-center mb-3">
                <span class="material-symbols-outlined">category</span>
            </div>
            <p class="text-xs text-on-surface-variant font-label-bold uppercase">Kategori</p>
            <h3 class="text-3xl font-headline-xl text-on-surface font-bold mt-1">{{ $totalCategories }}</h3>
        </div>

        <div class="p-6 bg-surface-container-lowest rounded-3xl border border-outline-variant/30 shadow-sm">
            <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-3">
                <span class="material-symbols-outlined">group</span>
            </div>
            <p class="text-xs text-on-surface-variant font-label-bold uppercase">Pengguna</p>
            <h3 class="text-3xl font-headline-xl text-on-surface font-bold mt-1">{{ $totalUsers }}</h3>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="flex border-b border-outline-variant/30 mb-6 gap-2">
        <button 
            wire:click="setTab('recipes')" 
            class="px-6 py-3 font-label-bold text-sm transition-all border-b-2 {{ $tab === 'recipes' ? 'border-primary text-primary' : 'border-transparent text-on-surface-variant hover:text-on-surface' }}"
        >
            Kelola Resep ({{ $recipes->count() }})
        </button>
        <button 
            wire:click="setTab('places')" 
            class="px-6 py-3 font-label-bold text-sm transition-all border-b-2 {{ $tab === 'places' ? 'border-primary text-primary' : 'border-transparent text-on-surface-variant hover:text-on-surface' }}"
        >
            Kelola Tempat Kuliner ({{ $places->count() }})
        </button>
        <button 
            wire:click="setTab('categories')" 
            class="px-6 py-3 font-label-bold text-sm transition-all border-b-2 {{ $tab === 'categories' ? 'border-primary text-primary' : 'border-transparent text-on-surface-variant hover:text-on-surface' }}"
        >
            Kelola Kategori ({{ $categories->count() }})
        </button>
    </div>

    <!-- Tab 1: Resep -->
    @if ($tab === 'recipes')
        <div class="bg-surface-container-lowest rounded-3xl border border-outline-variant/30 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant text-xs font-label-bold uppercase border-b border-outline-variant/30">
                            <th class="p-4">Foto</th>
                            <th class="p-4">Judul Resep</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Durasi & Biaya</th>
                            <th class="p-4">Penulis</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($recipes as $item)
                            <tr class="hover:bg-surface-container-low/50 transition-colors">
                                <td class="p-4">
                                    <img src="{{ $item->first_image }}" alt="" class="w-12 h-12 rounded-xl object-cover" />
                                </td>
                                <td class="p-4 font-label-bold text-on-surface">
                                    <a href="{{ route('resep.show', $item->id) }}" target="_blank" class="hover:text-primary transition-colors">
                                        {{ $item->judul }}
                                    </a>
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 bg-surface-container rounded-full text-xs font-label-bold">
                                        {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="p-4 text-on-surface-variant text-xs">
                                    <div>{{ $item->durasi ?: '-' }}</div>
                                    <div class="text-primary font-label-bold">{{ $item->biaya ?: '-' }}</div>
                                </td>
                                <td class="p-4 text-on-surface-variant text-xs">{{ $item->penulis }}</td>
                                <td class="p-4 text-right">
                                    <button 
                                        wire:click="deleteRecipe({{ $item->id }})" 
                                        wire:confirm="Yakin ingin menghapus resep '{{ $item->judul }}'?"
                                        class="p-2 text-error hover:bg-error-container/30 rounded-xl transition-colors"
                                        title="Hapus"
                                    >
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-on-surface-variant">Belum ada resep.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Tab 2: Tempat Kuliner -->
    @if ($tab === 'places')
        <div class="bg-surface-container-lowest rounded-3xl border border-outline-variant/30 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant text-xs font-label-bold uppercase border-b border-outline-variant/30">
                            <th class="p-4">Foto</th>
                            <th class="p-4">Nama Restoran / Warung</th>
                            <th class="p-4">Alamat</th>
                            <th class="p-4">Koordinat</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @forelse($places as $item)
                            <tr class="hover:bg-surface-container-low/50 transition-colors">
                                <td class="p-4">
                                    <img src="{{ $item->first_image }}" alt="" class="w-12 h-12 rounded-xl object-cover" />
                                </td>
                                <td class="p-4 font-label-bold text-on-surface">
                                    <a href="{{ route('tempat.show', $item->id) }}" target="_blank" class="hover:text-primary transition-colors">
                                        {{ $item->nama_restoran }}
                                    </a>
                                </td>
                                <td class="p-4 text-on-surface-variant text-xs max-w-xs truncate">{{ $item->alamat }}</td>
                                <td class="p-4 text-on-surface-variant text-xs">
                                    {{ $item->latitude ? $item->latitude . ', ' . $item->longitude : '-' }}
                                </td>
                                <td class="p-4 text-right">
                                    <button 
                                        wire:click="deletePlace({{ $item->id }})" 
                                        wire:confirm="Yakin ingin menghapus tempat '{{ $item->nama_restoran }}'?"
                                        class="p-2 text-error hover:bg-error-container/30 rounded-xl transition-colors"
                                        title="Hapus"
                                    >
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-on-surface-variant">Belum ada tempat kuliner.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Tab 3: Kategori -->
    @if ($tab === 'categories')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Add category form -->
            <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 h-fit">
                <h3 class="font-headline-md text-on-surface text-lg mb-4">Tambah Kategori Baru</h3>
                <form wire:submit="addCategory" class="space-y-4">
                    <div>
                        <label class="block text-xs font-label-bold text-on-surface-variant mb-1">Nama Kategori</label>
                        <input 
                            type="text" 
                            wire:model="newCategory" 
                            placeholder="Contoh: Fermentasi, Camilan" 
                            class="w-full px-4 py-3 bg-surface rounded-xl border border-outline-variant text-sm outline-none focus:border-primary"
                        />
                        @error('newCategory') <span class="text-xs text-error mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-xl font-label-bold text-sm hover:shadow-lg transition-all">
                        Simpan Kategori
                    </button>
                </form>
            </div>

            <!-- List categories -->
            <div class="md:col-span-2 bg-surface-container-lowest rounded-3xl border border-outline-variant/30 overflow-hidden">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant text-xs font-label-bold uppercase border-b border-outline-variant/30">
                            <th class="p-4">ID</th>
                            <th class="p-4">Nama Kategori</th>
                            <th class="p-4">Jumlah Resep Terkait</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @foreach($categories as $cat)
                            <tr class="hover:bg-surface-container-low/50 transition-colors">
                                <td class="p-4 text-on-surface-variant text-xs">#{{ $cat->id }}</td>
                                <td class="p-4 font-label-bold text-on-surface">{{ $cat->nama_kategori }}</td>
                                <td class="p-4 text-on-surface-variant text-xs">{{ $cat->resep_count }} resep</td>
                                <td class="p-4 text-right">
                                    <button 
                                        wire:click="deleteCategory({{ $cat->id }})" 
                                        wire:confirm="Hapus kategori '{{ $cat->nama_kategori }}'?"
                                        class="p-2 text-error hover:bg-error-container/30 rounded-xl transition-colors"
                                        title="Hapus"
                                    >
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
