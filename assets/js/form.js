
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".resep-form");
  if (!form) return;

  // Tempat output resep 
  // Pilihan 1: elemen dengan id="resepList"
  // Pilihan 2: kalau tidak ada, kita fallback ke ".resep-container" pertama di section resep
  const output =
    document.querySelector("#resepList") ||
    document.querySelector("#resep .resep-container");

  // Kotak pesan (dibuat otomatis)
  const msg = document.createElement("div");
  msg.className = "form-msg";
  msg.style.marginTop = "12px";
  msg.style.fontWeight = "600";
  form.appendChild(msg);

  function showMsg(text, type = "info") {
    msg.textContent = text;
    msg.style.padding = "10px 12px";
    msg.style.borderRadius = "10px";
    msg.style.border = "1px solid transparent";

    if (type === "error") {
      msg.style.background = "#fff1f1";
      msg.style.borderColor = "#ffc7c7";
      msg.style.color = "#8a1f1f";
    } else if (type === "success") {
      msg.style.background = "#f1f8e9";
      msg.style.borderColor = "#cde7b0";
      msg.style.color = "#215a27";
    } else {
      msg.style.background = "#f6f3ee";
      msg.style.borderColor = "#e0d8cf";
      msg.style.color = "#3a2e25";
    }
  }

  function focusField(name) {
    const el = form.querySelector(`[name="${name}"]`);
    if (el) el.focus();
  }

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Validasi 
    const wajib = ["judul", "kategori", "bahan", "langkah", "penulis"];
    for (const key of wajib) {
      const v = (form.elements[key]?.value || "").trim();
      if (!v) {
        showMsg("Lengkapi dulu: Judul, Kategori, Bahan, Langkah, dan Nama Pengirim.", "error");
        focusField(key);
        return;
      }
    }

    if (!output) {
      showMsg("Wadah output resep belum ada. Tambahkan elemen #resepList di HTML.", "error");
      return;
    }

    // Disable tombol (anti spam klik)
    const btn = form.querySelector('button[type="submit"]');
    const oldText = btn ? btn.textContent : "";
    if (btn) {
      btn.disabled = true;
      btn.textContent = "Mengirim...";
    }

    try {
      const fd = new FormData(form);
      fd.set("ajax", "1"); 

      const res = await fetch(form.getAttribute("action") || "index.php", {
        method: "POST",
        body: fd,
      });

      const data = await res.json();

      if (!data.ok) {
        showMsg(data.message || "Gagal menambahkan resep.", "error");
        return;
      }

      // Tempel HTML card resep baru ke paling atas list
      output.insertAdjacentHTML("afterbegin", data.html);

      showMsg(data.message || "Resep berhasil ditambahkan!", "success");

      // Reset form
      form.reset();

      // scroll ke daftar resep
      const resepSection = document.querySelector("#resep");
      if (resepSection) {
        resepSection.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    } catch (err) {
      showMsg("Terjadi error. Pastikan kamu jalanin lewat server (XAMPP/Laragon), bukan file langsung.", "error");
      console.error(err);
    } finally {
      if (btn) {
        btn.disabled = false;
        btn.textContent = oldText || "Kirim Resep";
      }
    }
  });
});
