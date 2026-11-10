@extends('layouts.app')

@section('content')
<!-- ==================================================
     BERANDA (HERO)
=================================================== -->
<section class="relative w-full min-h-[85vh] flex items-center overflow-hidden bg-surface-container-lowest px-margin-mobile md:px-margin-desktop pt-28 pb-20" id="beranda">
    <div class="max-w-max-width mx-auto w-full grid grid-cols-1 md:grid-cols-2 gap-xl items-center">
        <div class="z-10 order-2 md:order-1">
            <span class="inline-block px-4 py-1 bg-primary-container text-on-primary-container rounded-full text-label-bold mb-md uppercase tracking-wider text-xs">Pilihan Sobat Kos</span>
            <h1 class="font-headline-xl text-headline-xl text-on-surface mb-lg">Inspirasi Tempe untuk Sobat Kos</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-xl max-w-xl">Ubah menu harianmu menjadi gaya hidup sehat yang terjangkau. Temukan ratusan resep tempe kreatif yang ramah di kantong mahasiswa namun tetap kaya nutrisi dan rasa.</p>
            <div class="flex flex-wrap gap-md">
                <a href="{{ route('resep.index') }}" wire:navigate class="bg-primary text-on-primary px-8 py-4 rounded-xl font-label-bold text-label-bold hover:shadow-lg transition-all active:scale-95 flex items-center gap-2 no-underline">
                    Lihat Resep <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="#tentang-tempe" class="border-2 border-outline-variant text-primary px-8 py-4 rounded-xl font-label-bold text-label-bold hover:bg-surface-container-low transition-all active:scale-95 no-underline text-center">
                    Pelajari Nutrisi
                </a>
            </div>
        </div>
        <div class="relative h-[380px] md:h-[500px] rounded-[2.5rem] overflow-hidden shadow-2xl order-1 md:order-2 border-8 border-white/50">
            <img alt="Tempe Dish" class="w-full h-full object-cover" src="{{ asset('media/tempe goreng.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&auto=format&fit=crop'" />
            <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-white/20">
                <p class="font-label-bold text-primary flex items-center gap-1 text-sm">
                    <span class="material-symbols-outlined text-[18px]">verified</span> Terverifikasi Nutrisi & Hemat
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==================================================
     APA ITU TEMPE
=================================================== -->
<section class="py-24 px-margin-mobile md:px-margin-desktop bg-surface" id="tentang-tempe">
    <div class="max-w-max-width mx-auto">
        <div class="flex flex-col md:flex-row gap-xl items-center">
            <div class="flex-1">
                <span class="text-primary font-label-bold uppercase tracking-widest mb-sm block text-xs">Edukasi</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-lg">Apa Itu Tempe?</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-lg leading-relaxed">
                    Tempe adalah makanan fermentasi khas Indonesia berbahan dasar kedelai,
                    dikenal sebagai sumber protein nabati yang murah, bergizi, dan sangat mudah diolah.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
                    <div class="p-lg bg-surface-container-low rounded-2xl border border-outline-variant/30 shadow-sm">
                        <span class="material-symbols-outlined text-primary mb-sm">health_and_safety</span>
                        <h3 class="font-label-bold text-on-surface mb-xs">Sehat & Bergizi</h3>
                        <p class="text-body-sm text-on-surface-variant">Kaya protein, serat, dan vitamin yang mudah dicerna.</p>
                    </div>
                    <div class="p-lg bg-surface-container-low rounded-2xl border border-outline-variant/30 shadow-sm">
                        <span class="material-symbols-outlined text-primary mb-sm">history_edu</span>
                        <h3 class="font-label-bold text-on-surface mb-xs">Warisan Budaya</h3>
                        <p class="text-body-sm text-on-surface-variant">Berakar dari Jawa, kini menjadi superfood dunia.</p>
                    </div>
                    <div class="p-lg bg-surface-container-low rounded-2xl border border-outline-variant/30 shadow-sm">
                        <span class="material-symbols-outlined text-primary mb-sm">savings</span>
                        <h3 class="font-label-bold text-on-surface mb-xs">Ramah Kantong</h3>
                        <p class="text-body-sm text-on-surface-variant">Protein berkualitas dengan harga paling terjangkau.</p>
                    </div>
                    <div class="p-lg bg-surface-container-low rounded-2xl border border-outline-variant/30 shadow-sm">
                        <span class="material-symbols-outlined text-primary mb-sm">inventory_2</span>
                        <h3 class="font-label-bold text-on-surface mb-xs">Awet & Fleksibel</h3>
                        <p class="text-body-sm text-on-surface-variant">Mudah disimpan dan bisa diolah jadi ratusan menu.</p>
                    </div>
                </div>
            </div>
            <div class="flex-1 relative">
                <div class="aspect-[4/3] max-h-[480px] rounded-[2rem] overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ asset('media/tempe mentah.jpg') }}" alt="Tempe segar" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&auto=format&fit=crop'" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================================================
     PENGOLAHAN TEMPE
=================================================== -->
<section class="py-24 px-margin-mobile md:px-margin-desktop bg-surface-container-low" id="pengolahan-tempe">
    <div class="max-w-max-width mx-auto">
        <div class="text-center mb-xl">
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Teknik Pengolahan</h2>
            <p class="font-body-md text-on-surface-variant max-w-2xl mx-auto mt-sm">
                Tempe itu fleksibel: bisa jadi menu cepat harian, bisa juga jadi stok mingguan. 
                Pilih gaya masak yang paling sesuai dengan waktu kamu.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg mb-xl">
            <!-- Cepat -->
            <div class="p-lg bg-surface border border-outline-variant/30 rounded-3xl hover:shadow-lg transition-all hover:-translate-y-1">
                <div class="w-12 h-12 bg-primary-container rounded-2xl flex items-center justify-center mb-md shadow-sm">
                    <span class="material-symbols-outlined text-on-primary-container">timer</span>
                </div>
                <h3 class="font-headline-md text-headline-md mb-xs">Masak Cepat</h3>
                <p class="text-body-sm text-on-surface-variant mb-md">10-15 menit • Cocok saat mepet.</p>
                <ul class="space-y-2 text-body-sm">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Tempe Goreng Sambal</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Tumis Tempe Kecap</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Tempe Penyet</li>
                </ul>
            </div>
            <!-- Stok -->
            <div class="p-lg bg-surface border border-outline-variant/30 rounded-3xl hover:shadow-lg transition-all hover:-translate-y-1">
                <div class="w-12 h-12 bg-tertiary-container rounded-2xl flex items-center justify-center mb-md shadow-sm">
                    <span class="material-symbols-outlined text-on-tertiary-container">inventory</span>
                </div>
                <h3 class="font-headline-md text-headline-md mb-xs">Masak Stok</h3>
                <p class="text-body-sm text-on-surface-variant mb-md">30-45 menit • Hemat seminggu.</p>
                <ul class="space-y-2 text-body-sm">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-tertiary rounded-full"></span> Tempe Bacem</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-tertiary rounded-full"></span> Orek Tempe Kering</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-tertiary rounded-full"></span> Tempe Bumbu Ungkep</li>
                </ul>
            </div>
            <!-- Camilan -->
            <div class="p-lg bg-surface border border-outline-variant/30 rounded-3xl hover:shadow-lg transition-all hover:-translate-y-1">
                <div class="w-12 h-12 bg-secondary-container rounded-2xl flex items-center justify-center mb-md shadow-sm">
                    <span class="material-symbols-outlined text-on-secondary-container">fastfood</span>
                </div>
                <h3 class="font-headline-md text-headline-md mb-xs">Camilan Sore</h3>
                <p class="text-body-sm text-on-surface-variant mb-md">Kriuk gurih untuk teman nugas.</p>
                <ul class="space-y-2 text-body-sm">
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-secondary rounded-full"></span> Tempe Mendoan Hangat</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-secondary rounded-full"></span> Kripik Tempe Renyah</li>
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-secondary rounded-full"></span> Stik Tempe Krispi</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ==================================================
     DAFTAR RESEP TERBARU
=================================================== -->
<section class="py-24 px-margin-mobile md:px-margin-desktop bg-surface-container-lowest" id="resep">
    <div class="max-w-max-width mx-auto">
        <div class="text-center mb-xl">
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Eksplorasi Resep Pilihan</h2>
            <p class="font-body-md text-on-surface-variant max-w-2xl mx-auto mt-sm">
                Temukan kreasi tempe dari komunitas Sobat Kos. Semua resep sudah dikurasi agar hemat dan mudah dipraktekkan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg items-start">
            @forelse($recipes as $item)
                <article class="group bg-surface rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-64 overflow-hidden relative">
                        <img 
                            src="{{ $item->first_image }}" 
                            alt="{{ $item->judul }}" 
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        />
                        <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                            {{ $item->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>
                    <div class="p-lg flex flex-col flex-1">
                        <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">{{ $item->judul }}</h3>
                        <p class="text-body-sm text-on-surface-variant mb-md italic">Oleh: {{ $item->penulis }}</p>
                        
                        <div class="flex items-center gap-4 text-xs text-on-surface-variant font-label-bold mb-lg pb-md border-b border-outline-variant/10">
                            @if($item->durasi)
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> {{ $item->durasi }}</span>
                            @endif
                            @if($item->biaya)
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">payments</span> {{ $item->biaya }}</span>
                            @endif
                        </div>

                        <a 
                            href="{{ route('resep.show', $item->id) }}" 
                            wire:navigate
                            class="mt-auto inline-flex items-center justify-center gap-2 text-primary font-label-bold py-3 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors w-full"
                        >
                            Baca Selengkapnya
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-center text-on-surface-variant col-span-full py-8">Belum ada resep yang diunggah.</p>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('resep.index') }}" wire:navigate class="inline-block border border-primary text-primary px-8 py-3 rounded-full font-label-bold hover:bg-primary/5 transition-colors">
                Lihat Semua Resep
            </a>
        </div>
    </div>
</section>
@endsection
