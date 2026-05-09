
// scroll
const header = document.querySelector("header");

function smoothScrollTo(el) {
  if (!el) return;

  // offset tinggi header 
  const offset = (header?.offsetHeight || 0) + 12;

  const y = el.getBoundingClientRect().top + window.pageYOffset - offset;

  window.scrollTo({
    top: y,
    behavior: "smooth",
  });
}

//navigasi
document.addEventListener("click", (e) => {
  const a = e.target.closest('a[href^="#"]');
  if (!a) return;

  const href = a.getAttribute("href");
  if (!href || href === "#") return;

  const target = document.querySelector(href);
  if (!target) return;

  e.preventDefault();
  smoothScrollTo(target);

  history.pushState(null, "", href);
});

const headerEl = document.querySelector("header");
const navLinks = document.querySelectorAll('nav a[href^="#"]');

function smoothScrollToId(id) {
  const el = document.getElementById(id);
  if (!el) return;

  const headerH = headerEl ? headerEl.offsetHeight : 0;
  const extraGap = 12; 
  const y = el.getBoundingClientRect().top + window.pageYOffset - headerH - extraGap;

  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  window.scrollTo({
    top: y,
    behavior: reduceMotion ? "auto" : "smooth",
  });
}

navLinks.forEach((a) => {
  a.addEventListener("click", (e) => {
    const href = a.getAttribute("href");
    if (!href || href === "#" || href.length < 2) return;

    e.preventDefault();
    const id = href.slice(1);

    smoothScrollToId(id);

    // update URL hash 
    history.pushState(null, "", `#${id}`);
  });
});

console.log("search.js LOAD ✅");

function scrollToEl(el) {
  if (!el) return;
  el.scrollIntoView({ behavior: "smooth", block: "start" });
}

function highlightHit(el) {
  document.querySelectorAll(".search-hit").forEach(x => x.classList.remove("search-hit"));
  el.classList.add("search-hit");
  setTimeout(() => el.classList.remove("search-hit"), 1400);
}

document.addEventListener("DOMContentLoaded", () => {
  const input = document.getElementById("searchInput");
  const btn = document.getElementById("searchBtn");

  console.log("DOM siap ✅", { input, btn });

  if (!input || !btn) {
    console.warn("Search input/button tidak ketemu. Pastikan id=searchInput & id=searchBtn ada di HTML.");
    return;
  }

  // Kamus section 
  const map = [
    { keys: ["beranda", "home", "top"], target: "#beranda" },
    { keys: ["apa itu", "tempe", "sejarah", "tentang"], target: "#tentang-tempe" },
    { keys: ["pengolahan", "olah", "tips"], target: "#pengolahan-tempe" },
    { keys: ["rekomendasi", "menu", "kuliner"], target: "#rekomendasi" },
    { keys: ["resep", "populer", "daftar"], target: "#resep" },
    { keys: ["form", "tambah"], target: "#form-resep" },
  ];

  function findByContent(query) {
    // cari menu
    const cards = Array.from(document.querySelectorAll(
      ".menu-card2, .place-card2, .resep-blok, .populer-card2"
    ));

    const q = query.toLowerCase();

    // 1) cari di judul kartu 
    let hit = cards.find(el => {
      const title = el.querySelector("h3, h4");
      return title && title.textContent.toLowerCase().includes(q);
    });
    if (hit) return hit;

    // 2) kalau belum ketemu, cari di seluruh teks kartu
    hit = cards.find(el => el.textContent.toLowerCase().includes(q));
    if (hit) return hit;

    // 3) fallback terakhir: cari di seluruh halaman 
    const any = Array.from(document.querySelectorAll("main *"))
      .find(el => el.children.length === 0 && el.textContent.toLowerCase().includes(q));
    return any ? any.closest("section, article, .resep-blok") : null;
  }

  function run() {
    const q = (input.value || "").trim().toLowerCase();
    console.log("Cari:", q);

    if (!q) {
      alert("Isi dulu kata kunci ya. Contoh: beranda / pengolahan / bacem / pedas");
      input.focus();
      return;
    }

    // A) cek kamus 
    let targetSelector = null;
    for (const item of map) {
      if (item.keys.some(k => q.includes(k))) {
        targetSelector = item.target;
        break;
      }
    }

    if (targetSelector) {
      const el = document.querySelector(targetSelector);
      if (el) {
        scrollToEl(el);
        highlightHit(el);
        return;
      }
    }

    // B) cari isi konten (judul resep/menu/tempat)
    const hit = findByContent(q);

    if (hit) {
      scrollToEl(hit);
      highlightHit(hit);
    } else {
      alert('Kata kunci tidak ditemukan. Coba: beranda / tempe / pengolahan / rekomendasi / resep / form, atau nama menu seperti "bacem".');
    }
  }

  // klik tombol
  btn.addEventListener("click", run);

  // input
  input.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      run();
    }
  });
});
