<?php
$url = [
    'dashboard' => 'admin.dashboard',
    'aspirasi' => 'admin.aspirasi',
];
?>

<header x-data="{ scrolled: false, mobileOpen: false, logout: false }" @scroll.window="scrolled = (window.pageYOffset > 25)"
    :class="scrolled ? 'bg-dpm-black/85 backdrop-blur-md border-b border-dpm-gray/60 py-3 shadow-lg' : 'bg-transparent py-5'"
    class="sticky top-0 z-50 transition-all duration-300 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <a href="#hero" class="flex items-center gap-3.5 group">
            <img src="{{ asset('images/logo-dpm.png') }}" alt="Logo DPM FILKOM UB"
                class="w-10 h-10 object-contain drop-shadow-md group-hover:scale-105 transition-transform">
            <div>
                <span
                    class="block text-sm sm:text-base font-extrabold tracking-wide text-white group-hover:text-dpm-gold-bright transition-colors">DPM
                    FILKOM UB</span>
                <span
                    class="block text-[9px] sm:text-[10px] font-semibold tracking-widest text-dpm-muted uppercase">PARLEMEN
                    CAKRAWALA MAHARDIKA</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href={{ route($url['dashboard']) }}
                class="text-white/80 hover:text-dpm-gold-bright transition-colors">Dashboard</a>
            <a href={{ route($url['aspirasi']) }}
                class="text-white/80 hover:text-dpm-gold-bright transition-colors">Aspirasi</a>
        </nav>

        <button type="button" @click="mobileOpen = !mobileOpen"
            class="md:hidden p-2 rounded-lg bg-dpm-card border border-dpm-gray text-white hover:text-dpm-gold focus:outline-none"
            aria-label="Buka menu navigasi">
            <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden bg-dpm-card/95 border-b border-dpm-gray/80 px-6 py-6 mt-3 space-y-4 shadow-xl backdrop-blur-lg">
        <a @click="mobileOpen = false" href={{ route($url['dashboard']) }}
            class="block py-2 text-white/90 font-medium hover:text-dpm-gold">Dashboard</a>
        <a @click="mobileOpen = false" href={{ route($url['aspirasi']) }}
            class="block py-2 text-white/90 font-medium hover:text-dpm-gold">Aspirasi</a>

    </div>
</header>
