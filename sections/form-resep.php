<!-- ==================================================
     FORM RESEP
=================================================== -->
<section class="form-resep" id="form-resep">
    <div class="section-head">
        <h2>Bagikan Resep Tempe Kamu</h2>
        <p class="sub">Isi form ini untuk menambah resep ke TEMPEKU (versi demo untuk presentasi).</p>
    </div>

    <form class="resep-form" action="index.php#resep" method="post" id="recipeForm">
        <input type="hidden" name="form_type" value="resep" />

        <div class="grid-2">
            <div class="field">
                <label>Nama Resep <span class="req">*</span></label>
                <input type="text" name="judul" placeholder="Contoh: Orek Tempe" required />
            </div>

            <div class="field">
                <label>Kategori <span class="req">*</span></label>
                <select name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option>Harian</option>
                    <option>Mingguan</option>
                    <option>Akhir Bulan</option>
                    <option>Camilan</option>
                </select>
            </div>
        </div>

        <div class="grid-2">
            <div class="field">
                <label>Estimasi Biaya</label>
                <input type="text" name="biaya" placeholder="Contoh: Rp 12.000 / porsi" />
            </div>

            <div class="field">
                <label>Durasi Masak</label>
                <input type="text" name="durasi" placeholder="Contoh: 15 menit" />
            </div>
        </div>

        <div class="field">
            <label>Bahan-bahan <span class="req">*</span></label>
            <textarea name="bahan" rows="4" required placeholder="1 papan tempe&#10;2 siung bawang putih&#10;garam secukupnya"></textarea>
        </div>

        <div class="field">
            <label>Langkah Memasak <span class="req">*</span></label>
            <textarea name="langkah" rows="5" required placeholder="Potong tempe&#10;Bumbui&#10;Goreng sampai matang"></textarea>
        </div>

        <div class="field">
            <label>Link Gambar (opsional)</label>
            <input type="url" name="gambar" placeholder="https://...jpg" />
        </div>

        <div class="field">
            <label>Nama Pengirim <span class="req">*</span></label>
            <input type="text" name="penulis" required placeholder="Nama kamu" />
        </div>

        <button type="submit" class="btn-primary full">Kirim Resep</button>
        <p class="note">Catatan: berisi field yang wajib diisi (<span class="req">*</span>).</p>
    </form>
</section>
