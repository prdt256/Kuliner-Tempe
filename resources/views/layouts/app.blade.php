<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'TEMPEKU - Inspirasi Resep Tempe Sobat Kos' }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-surface font-body-md text-on-surface flex flex-col min-h-screen" x-data="{ mobileOpen: false }">
    <!-- ==================================================
         TOP APP BAR / NAVIGATION
    =================================================== -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-surface/90 backdrop-blur-md shadow-sm border-b border-outline-variant/20">
        <div class="flex items-center justify-between px-margin-mobile md:px-margin-desktop h-20 w-full max-w-max-width mx-auto">
            <div class="flex items-center gap-4">
                <button type="button" @click="mobileOpen = !mobileOpen" class="material-symbols-outlined text-primary md:hidden text-2xl focus:outline-none">
                    menu
                </button>
                <a href="{{ url('/') }}" wire:navigate class="font-headline-md text-headline-md font-bold text-primary tracking-tight flex items-center gap-2">
                    <span class="material-symbols-outlined text-2xl">eco</span>
                    TEMPEKU
                </a>
            </div>
            
            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center gap-xl">
                <a href="{{ url('/') }}#tentang-tempe" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold text-sm">Edukasi</a>
                <a href="{{ url('/') }}#pengolahan-tempe" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold text-sm">Pengolahan</a>
                <a href="{{ route('resep.index') }}" wire:navigate class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold text-sm {{ request()->routeIs('resep.*') ? 'active' : '' }}">Katalog Resep</a>
                <a href="{{ route('tempat.index') }}" wire:navigate class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold text-sm {{ request()->routeIs('tempat.*') ? 'active' : '' }}">Tempat Kuliner</a>
                
                @auth
                    <a href="{{ route('resep.create') }}" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold text-sm">Bagi Resep</a>
                    <a href="{{ route('tempat.create') }}" class="nav-link text-on-surface-variant hover:text-primary transition-all font-label-bold text-sm">Bagi Tempat</a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" wire:navigate class="nav-link text-primary hover:text-primary transition-all font-label-bold text-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">shield_person</span> Admin
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-3">
                @auth
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-label-bold text-on-surface hidden sm:inline">
                            Halo, <span class="text-primary">{{ Auth::user()->name }}</span>
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-error text-on-error px-5 py-2 rounded-full font-label-bold hover:shadow-lg hover:bg-error/90 transition-all active:scale-95 text-xs flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">logout</span>
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-primary text-on-primary px-7 py-2.5 rounded-full font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95 text-xs sm:text-sm text-center inline-block">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileOpen" x-transition class="md:hidden bg-surface-container-lowest border-b border-outline-variant/30 px-6 py-4 flex flex-col gap-3">
            <a href="{{ url('/') }}#tentang-tempe" @click="mobileOpen = false" class="text-on-surface-variant py-2 font-label-bold text-sm">Edukasi</a>
            <a href="{{ url('/') }}#pengolahan-tempe" @click="mobileOpen = false" class="text-on-surface-variant py-2 font-label-bold text-sm">Pengolahan</a>
            <a href="{{ route('resep.index') }}" wire:navigate @click="mobileOpen = false" class="text-on-surface-variant py-2 font-label-bold text-sm">Katalog Resep</a>
            <a href="{{ route('tempat.index') }}" wire:navigate @click="mobileOpen = false" class="text-on-surface-variant py-2 font-label-bold text-sm">Tempat Kuliner</a>
            @auth
                <a href="{{ route('resep.create') }}" class="text-on-surface-variant py-2 font-label-bold text-sm">Bagi Resep</a>
                <a href="{{ route('tempat.create') }}" class="text-on-surface-variant py-2 font-label-bold text-sm">Bagi Tempat</a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="text-primary py-2 font-label-bold text-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">shield_person</span> Admin Dashboard
                    </a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Global Alert Messages -->
    <div class="fixed top-24 right-4 z-50 max-w-sm w-full space-y-2 pointer-events-none">
        @if (session('success'))
            <div class="pointer-events-auto bg-primary-container text-on-primary-container p-4 rounded-2xl shadow-lg border border-primary/20 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">check_circle</span>
                <p class="text-xs font-label-bold">{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="pointer-events-auto bg-error-container text-on-error-container p-4 rounded-2xl shadow-lg border border-error/20 flex items-center gap-3">
                <span class="material-symbols-outlined text-error">error</span>
                <p class="text-xs font-label-bold">{{ session('error') }}</p>
            </div>
        @endif
        @if (session('info'))
            <div class="pointer-events-auto bg-surface-container-high text-on-surface p-4 rounded-2xl shadow-lg border border-outline-variant/30 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">info</span>
                <p class="text-xs font-label-bold">{{ session('info') }}</p>
            </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main class="flex-1">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- ==================================================
         FOOTER
    =================================================== -->
    <footer class="w-full py-12 px-margin-mobile md:px-margin-desktop bg-surface-container-low border-t border-outline-variant/30 mt-auto">
        <div class="max-w-max-width mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col gap-1 text-center md:text-left">
                <span class="font-headline-sm text-headline-sm text-primary font-bold flex items-center justify-center md:justify-start gap-1">
                    <span class="material-symbols-outlined text-xl">eco</span> TEMPEKU
                </span>
                <p class="font-body-sm text-body-sm text-on-surface-variant">© 2026 TempeDelight. Diberdayakan Laravel 12 + Livewire 3 + Tailwind CSS.</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ url('/') }}#tentang-tempe" class="text-on-surface-variant hover:text-primary transition-all font-body-sm">Tentang Kami</a>
                <a href="{{ route('resep.index') }}" wire:navigate class="text-on-surface-variant hover:text-primary transition-all font-body-sm">Panduan Resep</a>
                <a href="{{ route('tempat.index') }}" wire:navigate class="text-on-surface-variant hover:text-primary transition-all font-body-sm">Tempat Kuliner</a>
                <a href="{{ route('admin.login') }}" class="text-on-surface-variant/70 hover:text-primary transition-all font-body-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">lock</span> Admin
                </a>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
