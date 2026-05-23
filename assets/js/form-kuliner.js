document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".kuliner-form");
  if (!form) return;

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
    const wajib = ["nama_restoran", "alamat", "deskripsi"];
    for (const key of wajib) {
      const v = (form.elements[key]?.value || "").trim();
      if (!v) {
        showMsg("Lengkapi dulu: Nama Tempat, Alamat Lengkap, dan Deskripsi.", "error");
        focusField(key);
        return;
      }
    }

    // Disable tombol
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
        showMsg(data.message || "Gagal merekomendasikan tempat.", "error");
        return;
      }

      showMsg(data.message || "Tempat Kuliner berhasil ditambahkan!", "success");

      // Tampilkan Preview
      const output = document.querySelector("#tempatList");
      if (output && data.html) {
          output.innerHTML = "<h3 class='text-center font-headline-sm text-primary mb-4'>✨ Preview Tempat Barumu ✨</h3>" + data.html;
          output.scrollIntoView({ behavior: "smooth", block: "start" });
      }

      // Reset form
      form.reset();

    } catch (err) {
      showMsg("Terjadi error saat mengirim data.", "error");
      console.error(err);
    } finally {
      if (btn) {
        btn.disabled = false;
        btn.textContent = oldText || "Kirim Rekomendasi";
      }
    }
  });
});
