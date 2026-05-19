<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TEMPEKU - Inspirasi Resep Tempe Sobat Kos</title>
    
    <!-- Tailwind CSS CDN with Plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Smooth scroll and header offset */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 5rem; /* Offset for fixed header */
        }
        /* Custom Nav Link Active State */
        .nav-link.active {
            color: #006d36; /* primary color */
            position: relative;
        }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #006d36;
        }
    </style>

    <!-- Tailwind Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-secondary-container": "#616363",
                      "on-tertiary-fixed-variant": "#005226",
                      "secondary-fixed": "#e2e2e2",
                      "error-container": "#ffdad6",
                      "surface-variant": "#e0e3e5",
                      "on-surface-variant": "#3d4a3e",
                      "inverse-primary": "#4de082",
                      "on-tertiary-container": "#095e2d",
                      "inverse-on-surface": "#eff1f3",
                      "on-background": "#191c1e",
                      "surface-container-high": "#e6e8ea",
                      "outline-variant": "#bccabb",
                      "on-primary-container": "#005e2d",
                      "primary": "#006d36",
                      "secondary": "#5d5f5f",
                      "surface-container-highest": "#e0e3e5",
                      "secondary-fixed-dim": "#c6c6c7",
                      "outline": "#6d7b6d",
                      "primary-container": "#4ade80",
                      "error": "#ba1a1a",
                      "surface-dim": "#d8dadc",
                      "surface-container-low": "#f2f4f6",
                      "primary-fixed-dim": "#4de082",
                      "on-primary": "#ffffff",
                      "on-tertiary": "#ffffff",
                      "on-secondary": "#ffffff",
                      "surface-tint": "#006d36",
                      "tertiary-fixed-dim": "#8bd79b",
                      "surface-container-lowest": "#ffffff",
                      "inverse-surface": "#2d3133",
                      "background": "#f7f9fb",
                      "surface-bright": "#f7f9fb",
                      "on-tertiary-fixed": "#00210b",
                      "on-surface": "#191c1e",
                      "on-error": "#ffffff",
                      "tertiary-container": "#89d598",
                      "surface-container": "#eceef0",
                      "tertiary-fixed": "#a6f4b5",
                      "on-primary-fixed": "#00210c",
                      "surface": "#f7f9fb",
                      "on-secondary-fixed": "#1a1c1c",
                      "primary-fixed": "#6dfe9c",
                      "tertiary": "#1f6c3a",
                      "secondary-container": "#dfe0e0",
                      "on-primary-fixed-variant": "#005227",
                      "on-error-container": "#93000a",
                      "on-secondary-fixed-variant": "#454747"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "xs": "0.25rem",
                      "margin-desktop": "5rem",
                      "xl": "2.5rem",
                      "lg": "1.5rem",
                      "gutter": "1rem",
                      "max-width": "1280px",
                      "md": "1rem",
                      "sm": "0.5rem",
                      "margin-mobile": "1rem"
              },
              "fontFamily": {
                      "headline-xl": ["Plus Jakarta Sans"],
                      "headline-md": ["Plus Jakarta Sans"],
                      "body-md": ["Inter"],
                      "headline-lg": ["Plus Jakarta Sans"],
                      "label-bold": ["Inter"],
                      "headline-lg-mobile": ["Plus Jakarta Sans"],
                      "body-sm": ["Inter"],
                      "body-lg": ["Inter"]
              },
              "fontSize": {
                      "headline-xl": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                      "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                      "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                      "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                      "label-bold": ["14px", { "lineHeight": "20px", "fontWeight": "600" }],
                      "headline-lg-mobile": ["28px", { "lineHeight": "36px", "fontWeight": "700" }],
                      "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                      "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }]
              }
            },
          },
        }
    </script>
</head>

<body class="bg-surface font-body-md text-on-surface">
    <!-- ==================================================
         TOP APP BAR / NAV
    =================================================== -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-surface/90 backdrop-blur-md shadow-sm border-b border-outline-variant/10">
        <div class="flex items-center justify-between px-margin-mobile md:px-margin-desktop h-20 w-full max-w-max-width mx-auto">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-primary cursor-pointer md:hidden">menu</span>
                <a href="#beranda" class="font-headline-md text-headline-md font-bold text-primary tracking-tight">TEMPEKU</a>
            </div>
            
            <div class="hidden md:flex items-center gap-xl">
                <a href="#tentang-tempe" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold">Edukasi</a>
                <a href="#pengolahan-tempe" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold">Pengolahan</a>
                <a href="#rekomendasi" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold">Rekomendasi</a>
                <a href="#resep" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold">Resep</a>
                <a href="#form-resep" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold">Bagi Resep</a>
            </div>

            <div class="flex items-center gap-4">
                <button class="bg-primary text-on-primary px-8 py-2.5 rounded-full font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95">
                    Masuk
                </button>
            </div>
        </div>
    </nav>

    <!-- ScrollSpy Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= sectionTop - 150) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${current}`) {
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>

    <!-- Main content container - removed global pt-20 to fix hero initial load -->
    <div>
