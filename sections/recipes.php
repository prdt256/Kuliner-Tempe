<!-- ==================================================
     RESEP
=================================================== -->
<section class="resep-section" id="resep">
    <div class="section-head">
        <h2>Resep Tempe</h2>
        <p class="sub">
            Mulai dari yang paling populer dulu, lalu lanjut ke daftar resep lengkap.
            Kalau kamu punya resep sendiri, langsung isi form di bawah.
        </p>

        <div class="section-actions">
            <a href="#form-resep" class="btn-ghost">Tambah Resep</a>
            <a href="#rekomendasi" class="btn-outline">Lihat Rekomendasi</a>
        </div>
    </div>

    <!-- MENU POPULER -->
    <div class="resep-populer-wrap">
        <h3 class="mini-title">🔥 Menu Populer</h3>

        <div class="populer-grid">
            <article class="populer-card2">
                <div class="populer-media">
                    <img src="media/tempe pedas.jpg" alt="Tempe Goreng Sambal" />
                    <span class="badge-populer">Favorit</span>
                </div>
                <div class="populer-body">
                    <h3>Tempe Goreng Sambal</h3>
                    <p>Menu paling simpel dan cepat untuk sehari-hari.</p>
                    <div class="populer-meta">
                        <span>⏱ 10 menit</span>
                        <span>💸 Rp 8-12k</span>
                    </div>
                </div>
            </article>

            <article class="populer-card2">
                <div class="populer-media">
                    <img src="media/resep 2.jpg" alt="Orek Tempe Kering" />
                    <span class="badge-populer">Hemat</span>
                </div>
                <div class="populer-body">
                    <h3>Orek Tempe Kering</h3>
                    <p>Bisa disimpan beberapa hari, cocok akhir bulan.</p>
                    <div class="populer-meta">
                        <span>⏱ 20 menit</span>
                        <span>💸 Rp 10-15k</span>
                    </div>
                </div>
            </article>

            <article class="populer-card2">
                <div class="populer-media">
                    <img src="media/tempe bacem.jpg" alt="Tempe Bacem" />
                    <span class="badge-populer">Meal Prep</span>
                </div>
                <div class="populer-body">
                    <h3>Tempe Bacem</h3>
                    <p>Masak sekali, goreng saat dibutuhkan.</p>
                    <div class="populer-meta">
                        <span>⏱ 25 menit</span>
                        <span>💸 Rp 10-15k</span>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <!-- DAFTAR RESEP -->
    <div class="resep-list-wrap">
        <h3 class="mini-title">📌 Daftar Resep</h3>

        <!-- target JS nempel resep baru -->
        <div id="resepList"></div>

        <!-- fallback PHP (kalau submit biasa tanpa AJAX) -->
        <?php if (isset($resepBaru) && $resepBaru): ?>
            <?php echo recipe_card_html($resepBaru); ?>
        <?php endif; ?>

        <div class="resep-container">
            <div class="resep-blok">
                <div class="resep-gambar">
                    <img src="media/resep 4.jpg" alt="Foto tempe bacem" />
                </div>
                <div class="resep-info">
                    <h3>Tempe Bacem Legit</h3>
                    <p>Resep klasik tempe bacem yang legit, bumbunya meresap sempurna. Cocok untuk lauk pendamping.</p>

                    <div class="resep-meta">
                        <span>⏱ 20 menit</span>
                        <span>💸 Rp 10-15k</span>
                        <span>🏷 Harian</span>
                    </div>

                    <details class="accordion">
                        <summary>Lihat detail resep</summary>
                        <div class="acc-body">
                            <div class="acc-grid">
                                <div>
                                    <h4>Bahan</h4>
                                    <ul>
                                        <li>Tempe 1 papan</li>
                                        <li>Bumbu bacem (bawang, gula merah, kecap)</li>
                                        <li>Daun salam (opsional)</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>Langkah</h4>
                                    <ol>
                                        <li>Ungkep tempe dengan bumbu sampai meresap.</li>
                                        <li>Dinginkan sebentar.</li>
                                        <li>Goreng/panggang saat mau makan.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>

            <div class="resep-blok">
                <div class="resep-gambar">
                    <img src="media/resep 5.jpg" alt="Foto tempe katsu" />
                </div>
                <div class="resep-info">
                    <h3>Tempe Katsu Saus Barbeque</h3>
                    <p>Solusi “mewah” tapi murah. Tempe dibalut tepung roti renyah disiram saus barbeque.</p>

                    <div class="resep-meta">
                        <span>⏱ 25 menit</span>
                        <span>💸 Rp 15-20k</span>
                        <span>🏷 Mingguan</span>
                    </div>

                    <details class="accordion">
                        <summary>Lihat detail resep</summary>
                        <div class="acc-body">
                            <div class="acc-grid">
                                <div>
                                    <h4>Bahan</h4>
                                    <ul>
                                        <li>Tempe 1 papan</li>
                                        <li>Tepung + telur + tepung roti</li>
                                        <li>Saus barbeque</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>Langkah</h4>
                                    <ol>
                                        <li>Iris tempe, balur tepung-telur-tepung roti.</li>
                                        <li>Goreng sampai renyah.</li>
                                        <li>Siram saus / sajikan terpisah.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>

            <div class="resep-blok">
                <div class="resep-gambar">
                    <img src="media/resep 7.jpg" alt="Foto sambal tempe" />
                </div>
                <div class="resep-info">
                    <h3>Sambal Tempe Kemangi</h3>
                    <p>Tempe penyet dicampur sambal bawang pedas dan daun kemangi yang wangi. Mantap buat nasi hangat.</p>

                    <div class="resep-meta">
                        <span>⏱ 15 menit</span>
                        <span>💸 Rp 10-15k</span>
                        <span>🏷 Harian</span>
                    </div>

                    <details class="accordion">
                        <summary>Lihat detail resep</summary>
                        <div class="acc-body">
                            <div class="acc-grid">
                                <div>
                                    <h4>Bahan</h4>
                                    <ul>
                                        <li>Tempe goreng</li>
                                        <li>Cabai + bawang + garam</li>
                                        <li>Daun kemangi</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>Langkah</h4>
                                    <ol>
                                        <li>Ulek sambal bawang.</li>
                                        <li>Penyet tempe, campur sambal.</li>
                                        <li>Tambahkan kemangi, aduk ringan.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </div>
</section>
