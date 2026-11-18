@props(['selected' => ''])

<div 
    x-data="{
        open: false,
        selected: @js($selected),
        prodis: [
            { id: 'Sistem Informasi', name: 'Sistem Informasi', logo: '{{ asset('images/prodi/si.png') }}' },
            { id: 'Teknik Informatika', name: 'Teknik Informatika', logo: '{{ asset('images/prodi/tif.png') }}' },
            { id: 'Pendidikan Teknologi Informasi', name: 'Pendidikan Teknologi Informasi', logo: '{{ asset('images/prodi/pti.png') }}' },
            { id: 'Teknik Komputer', name: 'Teknik Komputer', logo: '{{ asset('images/prodi/tekkom.png') }}' },
            { id: 'Teknologi Informasi', name: 'Teknologi Informasi', logo: '{{ asset('images/prodi/ti.png') }}' }
        ],
        activeIndex: 0,
        select(item) {
            this.selected = item.id;
            this.open = false;
        },
        getSelected() {
            return this.prodis.find(p => p.id === this.selected);
        },
        onKeydown(e) {
            if (!this.open) {
                if (['ArrowDown', 'ArrowUp', 'Enter', ' '].includes(e.key)) {
                    e.preventDefault();
                    this.open = true;
                }
                return;
            }
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                this.activeIndex = (this.activeIndex + 1) % this.prodis.length;
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                this.activeIndex = (this.activeIndex - 1 + this.prodis.length) % this.prodis.length;
            } else if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.select(this.prodis[this.activeIndex]);
            } else if (e.key === 'Escape') {
                this.open = false;
            }
        }
    }"
    @click.outside="open = false"
    @keydown="onKeydown($event)"
    class="space-y-2 relative"
>
    <label class="block text-xs font-bold uppercase tracking-[0.2em] text-dpm-gold">
        Program Studi <span class="text-dpm-orange font-black">*</span>
    </label>

    <input type="hidden" name="prodi" :value="selected">

    <button 
        type="button" 
        id="prodi_button"
        @click="open = !open"
        aria-haspopup="listbox"
        :aria-expanded="open"
        :class="errors?.prodi ? 'border-red-500 shadow-glow-error' : (open ? 'border-dpm-gold shadow-glow-orange-input' : 'border-dpm-orange/60 hover:border-dpm-orange')"
        class="w-full px-4 py-3.5 rounded-[13px] bg-dpm-black/40 border text-left text-sm flex items-center justify-between focus:outline-none transition-all duration-200"
    >
        <div class="flex items-center gap-3">
            <template x-if="getSelected()">
                <div class="flex items-center gap-3">
                    <img :src="getSelected().logo" :alt="getSelected().name" class="w-6 h-6 object-contain" onerror="this.style.display='none'">
                    <span class="text-white font-medium" x-text="getSelected().name"></span>
                </div>
            </template>
            <template x-if="!getSelected()">
                <span class="text-dpm-cream/30">Pilih Program Studi Anda...</span>
            </template>
        </div>

        <svg 
            class="w-4 h-4 text-dpm-gold transition-transform duration-200" 
            :class="open ? 'rotate-180' : ''" 
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div 
        x-show="open" 
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
        role="listbox"
        class="absolute left-0 right-0 z-30 mt-2 rounded-[14px] bg-dpm-card border border-dpm-orange/80 shadow-2xl p-2 space-y-1 backdrop-blur-md"
    >
        <template x-for="(item, index) in prodis" :key="item.id">
            <div 
                @click="select(item)"
                @mouseenter="activeIndex = index"
                role="option"
                :aria-selected="selected === item.id"
                :class="{
                    'bg-dpm-orange/20 text-dpm-gold-bright': activeIndex === index,
                    'text-white': activeIndex !== index
                }"
                class="px-3.5 py-2.5 rounded-lg text-sm cursor-pointer flex items-center justify-between transition-colors"
            >
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center">
                        <img :src="item.logo" :alt="item.name" class="w-full h-full object-contain">
                    </div>
                    <span class="font-medium" x-text="item.name"></span>
                </div>

                <template x-if="selected === item.id">
                    <svg class="w-4 h-4 text-dpm-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </template>
            </div>
        </template>
    </div>

    <template x-if="errors?.prodi">
        <p class="text-xs text-red-400 font-medium tracking-wide" x-text="errors.prodi"></p>
    </template>
    @error('prodi')
        <p class="text-xs text-red-400 font-medium tracking-wide mt-1">{{ $message }}</p>
    @enderror
</div>
