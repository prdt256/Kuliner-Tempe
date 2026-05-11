<!-- ==================================================
     DAFTAR RESEP - PREMIUM DESIGN
=================================================== -->
<section class="py-24 px-margin-mobile md:px-margin-desktop bg-surface-container-lowest" id="resep">
    <div class="max-w-max-width mx-auto">
        <div class="text-center mb-xl">
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Eksplorasi Resep Lengkap</h2>
            <p class="font-body-md text-on-surface-variant max-w-2xl mx-auto mt-sm">
                Temukan kreasi tempe dari komunitas Sobat Kos. Semua resep sudah dikurasi agar hemat dan mudah dipraktekkan.
            </p>
        </div>

        <!-- Target JS untuk nempel resep baru (AJAX) -->
        <div id="resepList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg mb-lg items-start"></div>

        <!-- Fallback PHP (kalau submit biasa tanpa AJAX) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg items-start">
            <?php if (isset($resepBaru) && $resepBaru): ?>
                <div class="col-span-full">
                    <?php echo recipe_card_html($resepBaru); ?>
                </div>
            <?php endif; ?>

            <!-- Resep Statis 1 -->
            <article class="bg-surface rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="h-64 overflow-hidden relative">
                    <img src="media/resep 4.jpg" alt="Tempe Bacem" class="w-full h-full object-cover" />
                    <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">Harian</span>
                </div>
                <div class="p-lg flex flex-col flex-1">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Tempe Bacem Legit</h3>
                    <p class="text-body-sm text-on-surface-variant mb-md italic">Oleh: Tim Tempeku</p>
                    
                    <div class="flex items-center gap-4 text-xs text-on-surface-variant font-label-bold mb-lg pb-md border-b border-outline-variant/10">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 20m</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">payments</span> Rp 10-15k</span>
                    </div>
                    
                    <details class="group cursor-pointer">
                        <summary class="list-none flex items-center justify-between text-primary font-label-bold py-2 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors">
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                                Detail Resep
                            </span>
                            <span class="text-[10px] opacity-60 uppercase group-open:hidden">Klik untuk melihat</span>
                        </summary>
                        <div class="mt-lg p-lg bg-surface-container-low rounded-2xl border border-outline-variant/10 space-y-lg">
                            <div>
                                <h4 class="font-label-bold text-on-surface mb-sm text-xs uppercase tracking-widest flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">shopping_basket</span> Bahan
                                </h4>
                                <ul class="list-disc list-inside text-body-sm text-on-surface-variant space-y-1 ml-2">
                                    <li>1 papan tempe</li>
                                    <li>Bawang putih, gula merah, kecap</li>
                                    <li>Daun salam & lengkuas</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-label-bold text-on-surface mb-sm text-xs uppercase tracking-widest flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">instacart</span> Langkah
                                </h4>
                                <ol class="list-decimal list-inside text-body-sm text-on-surface-variant space-y-1 ml-2">
                                    <li>Ungkep tempe dengan bumbu sampai meresap.</li>
                                    <li>Goreng atau panggang sebentar sebelum disajikan.</li>
                                </ol>
                            </div>
                        </div>
                    </details>
                </div>
            </article>

            <!-- Resep Statis 2 -->
            <article class="bg-surface rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="h-64 overflow-hidden relative">
                    <img src="media/resep 5.jpg" alt="Tempe Katsu" class="w-full h-full object-cover" />
                    <span class="absolute top-4 right-4 bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">Mingguan</span>
                </div>
                <div class="p-lg flex flex-col flex-1">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Tempe Katsu BBQ</h3>
                    <p class="text-body-sm text-on-surface-variant mb-md italic">Oleh: Chef Kos</p>
                    
                    <div class="flex items-center gap-4 text-xs text-on-surface-variant font-label-bold mb-lg pb-md border-b border-outline-variant/10">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 25m</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">payments</span> Rp 15-20k</span>
                    </div>
                    
                    <details class="group cursor-pointer">
                        <summary class="list-none flex items-center justify-between text-primary font-label-bold py-2 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors">
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                                Detail Resep
                            </span>
                            <span class="text-[10px] opacity-60 uppercase group-open:hidden">Klik untuk melihat</span>
                        </summary>
                        <div class="mt-lg p-lg bg-surface-container-low rounded-2xl border border-outline-variant/10 space-y-lg">
                            <div>
                                <h4 class="font-label-bold text-on-surface mb-sm text-xs uppercase tracking-widest flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">shopping_basket</span> Bahan
                                </h4>
                                <ul class="list-disc list-inside text-body-sm text-on-surface-variant space-y-1 ml-2">
                                    <li>Tempe (iris tipis)</li>
                                    <li>Tepung bumbu & tepung roti</li>
                                    <li>Saus barbeque instan</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-label-bold text-on-surface mb-sm text-xs uppercase tracking-widest flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">instacart</span> Langkah
                                </h4>
                                <ol class="list-decimal list-inside text-body-sm text-on-surface-variant space-y-1 ml-2">
                                    <li>Balur tempe dengan tepung, goreng hingga krispi.</li>
                                    <li>Sajikan dengan siraman saus BBQ hangat.</li>
                                </ol>
                            </div>
                        </div>
                    </details>
                </div>
            </article>

            <!-- Resep Statis 3 -->
            <article class="bg-surface rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="h-64 overflow-hidden relative">
                    <img src="media/resep 7.jpg" alt="Sambal Tempe" class="w-full h-full object-cover" />
                    <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">Favorit</span>
                </div>
                <div class="p-lg flex flex-col flex-1">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Sambal Tempe</h3>
                    <p class="text-body-sm text-on-surface-variant mb-md italic">Oleh: Mbak Tempe</p>
                    
                    <div class="flex items-center gap-4 text-xs text-on-surface-variant font-label-bold mb-lg pb-md border-b border-outline-variant/10">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 15m</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">payments</span> Rp 10-15k</span>
                    </div>
                    
                    <details class="group cursor-pointer">
                        <summary class="list-none flex items-center justify-between text-primary font-label-bold py-2 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors">
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                                Detail Resep
                            </span>
                            <span class="text-[10px] opacity-60 uppercase group-open:hidden">Klik untuk melihat</span>
                        </summary>
                        <div class="mt-lg p-lg bg-surface-container-low rounded-2xl border border-outline-variant/10 space-y-lg">
                            <div>
                                <h4 class="font-label-bold text-on-surface mb-sm text-xs uppercase tracking-widest flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">shopping_basket</span> Bahan
                                </h4>
                                <ul class="list-disc list-inside text-body-sm text-on-surface-variant space-y-1 ml-2">
                                    <li>Tempe goreng</li>
                                    <li>Cabai, bawang, kemangi</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-label-bold text-on-surface mb-sm text-xs uppercase tracking-widest flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">instacart</span> Langkah
                                </h4>
                                <ol class="list-decimal list-inside text-body-sm text-on-surface-variant space-y-1 ml-2">
                                    <li>Ulek sambal, penyet tempe, tambahkan kemangi.</li>
                                </ol>
                            </div>
                        </div>
                    </details>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Section Divider -->
<div class="w-full h-12 bg-gradient-to-b from-surface-container-lowest to-surface-container-low"></div>
