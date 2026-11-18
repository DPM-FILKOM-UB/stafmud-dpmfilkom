<section id="hero" class="relative min-h-[90vh] flex items-center justify-center bg-dpm-black bg-contour-pattern overflow-hidden py-16 sm:py-24">
    <div class="absolute top-1/4 -left-32 w-96 h-96 bg-dpm-orange/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-0 w-[30rem] h-[30rem] bg-dpm-gold/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="hidden lg:flex flex-col items-center gap-4 absolute left-8 top-1/2 -translate-y-1/2 text-dpm-muted/60">
        <span class="text-[10px] uppercase font-bold tracking-[0.3em] [writing-mode:vertical-lr] rotate-180">SCROLL</span>
        <div class="w-[1px] h-12 bg-gradient-to-b from-dpm-muted/50 to-transparent"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-8 space-y-6 text-center lg:text-left reveal-on-scroll">
            <div class="inline-flex items-center px-4 py-1.5 rounded-full border border-dpm-gold/40 bg-dpm-black/50 text-dpm-gold text-[11px] sm:text-xs font-bold tracking-[0.2em] uppercase">
                <span>PERIODE 2026</span>
            </div>

            <div class="space-y-2 select-none">
                <h1 class="text-4xl sm:text-6xl xl:text-7xl font-black uppercase tracking-tight leading-tight">
                    <span class="block bg-gradient-to-r from-dpm-orange-light via-dpm-orange to-dpm-orange-dark bg-clip-text text-transparent">
                        PORTAL
                    </span>
                    <span class="block text-white">
                        ASPIRASI KBM FILKOM 2026
                    </span>
                </h1>
            </div>

            <div class="flex items-center justify-center lg:justify-start gap-3 pt-2">
                <div class="w-1 h-8 bg-dpm-gold rounded-full"></div>
                <p class="text-xs sm:text-sm md:text-base font-bold uppercase tracking-[0.25em] text-dpm-gold-warm">
                    PARLEMEN CAKRAWALA MAHARDIKA
                </p>
            </div>

            <p class="text-dpm-muted text-sm sm:text-base max-w-xl mx-auto lg:mx-0 font-normal leading-relaxed">
                Wadah resmi advokasi dan penyaluran aspirasi seluruh mahasiswa Fakultas Ilmu Komputer, Universitas Brawijaya.
            </p>

            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                <a href="#form-aspirasi" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-dpm-gold text-dpm-black font-extrabold text-sm uppercase tracking-wider shadow-glow-gold hover:bg-dpm-gold-bright group transition-all">
                    <span>Sampaikan Aspirasi</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <a href="#alur" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-full bg-dpm-card border border-dpm-gray text-white font-bold text-sm uppercase tracking-wider hover:border-dpm-gold hover:text-dpm-gold-bright transition-all">
                    <span>Pelajari Alur</span>
                </a>
            </div>
        </div>

        <div class="hidden lg:flex lg:col-span-4 relative items-center justify-center reveal-on-scroll">
            <div class="relative flex items-center justify-center p-4">
                <div class="absolute w-64 h-64 sm:w-72 sm:h-72 bg-dpm-gold/15 rounded-full blur-3xl pointer-events-none"></div>
                <img src="{{ asset('images/logo-dpm.png') }}" alt="Lambang DPM FILKOM UB" class="relative z-10 w-64 h-64 sm:w-72 sm:h-72 xl:w-80 xl:h-80 object-contain filter drop-shadow-[0_10px_25px_rgba(223,169,78,0.3)] hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </div>
</section>
