@extends('layouts.app')

@section('content')
<div class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop bg-surface-container-low min-h-screen">
    <div class="max-w-3xl mx-auto bg-surface-container-lowest p-8 sm:p-14 rounded-[2.5rem] shadow-xl border border-white">
        <div class="text-center mb-10">
            <span class="material-symbols-outlined text-primary text-5xl mb-2">restaurant_menu</span>
            <h1 class="font-headline-lg text-headline-lg text-on-surface">Bagikan Resep Andalanmu</h1>
            <p class="text-on-surface-variant text-sm mt-1">Punya kreasi tempe yang unik dan murah? Bagikan ke sesama Sobat Kos!</p>
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

        <form action="{{ route('resep.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Resep & Kategori -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-label-bold text-on-surface text-sm mb-2">Nama Resep <span class="text-error">*</span></label>
                    <input 
                        type="text" 
                        name="judul" 
                        value="{{ old('judul') }}"
                        required 
                        placeholder="Contoh: Tempe Orek Pedas Manis" 
                        class="w-full px-4 py-3.5 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                    />
                </div>
                <div>
                    <label class="block font-label-bold text-on-surface text-sm mb-2">Kategori <span class="text-error">*</span></label>
                    <select 
                        name="kategori_id" 
                        required 
                        class="w-full px-4 py-3.5 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Estimasi Biaya & Durasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-label-bold text-on-surface text-sm mb-2">Estimasi Biaya</label>
                    <input 
                        type="text" 
                        name="biaya" 
                        value="{{ old('biaya') }}"
                        placeholder="Contoh: Rp 12.000 / porsi" 
                        class="w-full px-4 py-3.5 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                    />
                </div>
                <div>
                    <label class="block font-label-bold text-on-surface text-sm mb-2">Durasi Masak</label>
                    <div class="flex gap-2">
                        <input 
                            type="number" 
                            name="durasi_val" 
                            value="{{ old('durasi_val') }}"
                            placeholder="Misal: 15" 
                            class="w-2/3 px-4 py-3.5 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                        />
                        <select 
                            name="durasi_unit" 
                            class="w-1/3 px-3 py-3.5 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                        >
                            <option value="Menit" {{ old('durasi_unit') == 'Menit' ? 'selected' : '' }}>Menit</option>
                            <option value="Jam" {{ old('durasi_unit') == 'Jam' ? 'selected' : '' }}>Jam</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Bahan-bahan -->
            <div>
                <label class="block font-label-bold text-on-surface text-sm mb-2">
                    Bahan-bahan <span class="text-error">*</span> <span class="text-xs font-normal text-on-surface-variant">(1 baris per bahan)</span>
                </label>
                <textarea 
                    name="bahan" 
                    rows="4" 
                    required 
                    placeholder="1 papan tempe&#10;2 siung bawang putih&#10;1 sdm kecap manis"
                    class="w-full p-4 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                >{{ old('bahan') }}</textarea>
            </div>

            <!-- Langkah-langkah -->
            <div>
                <label class="block font-label-bold text-on-surface text-sm mb-2">
                    Langkah Memasak <span class="text-error">*</span> <span class="text-xs font-normal text-on-surface-variant">(1 baris per langkah)</span>
                </label>
                <textarea 
                    name="langkah" 
                    rows="5" 
                    required 
                    placeholder="1. Potong tempe tipis-tipis.&#10;2. Goreng hingga kecokelatan.&#10;3. Sajikan hangat."
                    class="w-full p-4 rounded-xl border border-outline-variant bg-surface-bright focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none text-sm"
                >{{ old('langkah') }}</textarea>
            </div>

            <!-- Upload Media -->
            <div>
                <label class="block font-label-bold text-on-surface text-sm mb-2">Upload Foto Masakan</label>
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
                        Format gambar otomatis dikonversi ke <strong>WebP</strong> untuk performa optimal.
                    </p>
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <a href="{{ route('resep.index') }}" wire:navigate class="w-1/3 py-4 rounded-xl border border-outline-variant font-label-bold text-sm text-center text-on-surface hover:bg-surface-container-low transition-all">
                    Batal
                </a>
                <button type="submit" class="w-2/3 bg-primary text-on-primary py-4 rounded-xl font-label-bold text-sm hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">publish</span>
                    Publikasikan Resep
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
