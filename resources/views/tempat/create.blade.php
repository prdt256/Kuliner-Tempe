@extends('layouts.app')

@section('content')
<div class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop bg-surface-container-low min-h-screen">
    <div class="max-w-3xl mx-auto bg-surface-container-lowest p-8 sm:p-14 rounded-[2.5rem] shadow-xl border border-white">
        <div class="text-center mb-10">
            <span class="material-symbols-outlined text-primary text-5xl mb-2">storefront</span>
            <h1 class="font-headline-lg text-headline-lg text-on-surface">Rekomendasi Tempat Kuliner</h1>
            <p class="text-on-surface-variant text-sm mt-1">Punya warung tempe mendoan atau orek favorit? Bagikan lokasinya di sini!</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-error-container text-on-error-container text-sm font-label-bold">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tempat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{ menus: [{ nama: '', harga: '', deskripsi: '' }] }">
            @csrf

            <!-- Nama Restoran -->
            <div>
                <label class="block font-label-bold text-on-surface text-sm mb-2">Nama Tempat / Warung <span class="text-error">*</span></label>
                <input 
                    type="text" 
                    name="nama_restoran" 
                    value="{{ old('nama_restoran') }}"
                    required 
                    placeholder="Contoh: Warung Mendoan Kang Jono" 
                    class="w-full px-4 py-3.5 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                />
            </div>

            <!-- Alamat Lengkap -->
            <div>
                <label class="block font-label-bold text-on-surface text-sm mb-2">Alamat Lengkap <span class="text-error">*</span></label>
                <textarea 
                    name="alamat" 
                    rows="3" 
                    required 
                    placeholder="Contoh: Jl. Sudirman No. 10, Purwokerto"
                    class="w-full p-4 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                >{{ old('alamat') }}</textarea>
            </div>

            <!-- Koordinat Maps -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-label-bold text-on-surface text-sm mb-2">Latitude (Opsional)</label>
                    <input 
                        type="text" 
                        name="latitude" 
                        value="{{ old('latitude') }}"
                        placeholder="Contoh: -7.424424" 
                        class="w-full px-4 py-3.5 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                    />
                </div>
                <div>
                    <label class="block font-label-bold text-on-surface text-sm mb-2">Longitude (Opsional)</label>
                    <input 
                        type="text" 
                        name="longitude" 
                        value="{{ old('longitude') }}"
                        placeholder="Contoh: 109.230230" 
                        class="w-full px-4 py-3.5 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                    />
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block font-label-bold text-on-surface text-sm mb-2">Deskripsi & Keistimewaan <span class="text-error">*</span></label>
                <textarea 
                    name="deskripsi" 
                    rows="4" 
                    required 
                    placeholder="Ceritakan rasa makanannya, suasana tempatnya, atau kenapa harus ke sini..."
                    class="w-full p-4 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                >{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Upload Media -->
            <div>
                <label class="block font-label-bold text-on-surface text-sm mb-2">Upload Foto Lokasi</label>
                <div class="border-2 border-dashed border-outline-variant/60 rounded-2xl p-6 text-center bg-surface-container-low/50 hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined text-4xl text-primary mb-2">add_photo_alternate</span>
                    <input 
                        type="file" 
                        name="media[]" 
                        multiple 
                        accept="image/*,video/*" 
                        class="block w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-label-bold file:bg-primary file:text-on-primary hover:file:bg-primary/90"
                    />
                    <p class="text-[11px] text-on-surface-variant mt-2">
                        Format foto dikompresi otomatis ke format modern <strong>WebP</strong>.
                    </p>
                </div>
            </div>

            <!-- Dynamic Menu Items -->
            <div class="pt-4 border-t border-outline-variant/30">
                <div class="flex items-center justify-between mb-4">
                    <label class="font-label-bold text-on-surface text-sm">Daftar Menu Makanan (Opsional)</label>
                    <button 
                        type="button" 
                        @click="menus.push({ nama: '', harga: '', deskripsi: '' })" 
                        class="text-xs bg-primary/10 text-primary px-3 py-1.5 rounded-lg font-label-bold hover:bg-primary/20 transition-all flex items-center gap-1"
                    >
                        <span class="material-symbols-outlined text-sm">add</span> Tambah Baris Menu
                    </button>
                </div>

                <div class="space-y-3">
                    <template x-for="(menu, index) in menus" :key="index">
                        <div class="p-4 rounded-2xl bg-surface-container-low border border-outline-variant/30 grid grid-cols-1 md:grid-cols-3 gap-3 relative">
                            <div>
                                <input 
                                    type="text" 
                                    :name="'menu_nama[' + index + ']'" 
                                    x-model="menu.nama" 
                                    placeholder="Nama menu (Mendoan Jumbo)" 
                                    class="w-full px-3 py-2 rounded-lg border border-outline-variant text-xs outline-none focus:border-primary"
                                />
                            </div>
                            <div>
                                <input 
                                    type="number" 
                                    :name="'menu_harga[' + index + ']'" 
                                    x-model="menu.harga" 
                                    placeholder="Harga (Rp misal 15000)" 
                                    class="w-full px-3 py-2 rounded-lg border border-outline-variant text-xs outline-none focus:border-primary"
                                />
                            </div>
                            <div class="flex gap-2">
                                <input 
                                    type="text" 
                                    :name="'menu_deskripsi[' + index + ']'" 
                                    x-model="menu.deskripsi" 
                                    placeholder="Keterangan singkat" 
                                    class="w-full px-3 py-2 rounded-lg border border-outline-variant text-xs outline-none focus:border-primary"
                                />
                                <button 
                                    type="button" 
                                    x-show="menus.length > 1" 
                                    @click="menus.splice(index, 1)" 
                                    class="p-2 text-error hover:bg-error-container/30 rounded-lg shrink-0"
                                >
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <a href="{{ route('tempat.index') }}" wire:navigate class="w-1/3 py-4 rounded-xl border border-outline-variant font-label-bold text-sm text-center text-on-surface hover:bg-surface-container-low transition-all">
                    Batal
                </a>
                <button type="submit" class="w-2/3 bg-primary text-on-primary py-4 rounded-xl font-label-bold text-sm hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">publish</span>
                    Simpan Tempat Kuliner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
