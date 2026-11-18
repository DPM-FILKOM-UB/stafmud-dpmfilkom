@props(['selected' => '', 'otherValue' => ''])

<div 
    x-data="{
        open: false,
        selected: @js($selected),
        otherVal: @js($otherValue),
        options: [
            'Sarana dan Prasarana',
            'Akademik',
            'Kemahasiswaan',
            'Lembaga',
            'Other'
        ],
        activeIndex: 0,
        select(opt) {
            this.selected = opt;
            this.open = false;
            if (opt !== 'Other') {
                this.otherVal = '';
            }
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
                this.activeIndex = (this.activeIndex + 1) % this.options.length;
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                this.activeIndex = (this.activeIndex - 1 + this.options.length) % this.options.length;
            } else if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.select(this.options[this.activeIndex]);
            } else if (e.key === 'Escape') {
                this.open = false;
            }
        }
    }"
    @click.outside="open = false"
    @keydown="onKeydown($event)"
    class="space-y-4 relative"
>
    <div class="space-y-2">
        <label class="block text-xs font-bold uppercase tracking-[0.2em] text-dpm-gold">
            Jenis Aspirasi <span class="text-dpm-orange font-black">*</span>
        </label>

        <input type="hidden" name="jenis_aspirasi" :value="selected">

        <button 
            type="button" 
            id="jenis_button"
            @click="open = !open"
            aria-haspopup="listbox"
            :aria-expanded="open"
            :class="errors?.jenis ? 'border-red-500 shadow-glow-error' : (open ? 'border-dpm-gold shadow-glow-orange-input' : 'border-dpm-orange/60 hover:border-dpm-orange')"
            class="w-full px-4 py-3.5 rounded-[13px] bg-dpm-black/40 border text-left text-sm flex items-center justify-between focus:outline-none transition-all duration-200"
        >
            <span :class="selected ? 'text-white font-medium' : 'text-dpm-cream/30'" x-text="selected ? selected : 'Pilih Jenis Aspirasi Anda...'"></span>
            
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
            <template x-for="(opt, index) in options" :key="opt">
                <div 
                    @click="select(opt)"
                    @mouseenter="activeIndex = index"
                    role="option"
                    :aria-selected="selected === opt"
                    :class="{
                        'bg-dpm-orange/20 text-dpm-gold-bright': activeIndex === index,
                        'text-white': activeIndex !== index
                    }"
                    class="px-3.5 py-2.5 rounded-lg text-sm cursor-pointer flex items-center justify-between transition-colors"
                >
                    <span class="font-medium" x-text="opt"></span>
                    <template x-if="selected === opt">
                        <svg class="w-4 h-4 text-dpm-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </template>
                </div>
            </template>
        </div>

        <template x-if="errors?.jenis">
            <p class="text-xs text-red-400 font-medium tracking-wide" x-text="errors.jenis"></p>
        </template>
        @error('jenis_aspirasi')
            <p class="text-xs text-red-400 font-medium tracking-wide mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div 
        x-show="selected === 'Other'" 
        x-cloak
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 -translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-3"
        class="space-y-2 pt-1"
    >
        <label for="jenis_aspirasi_other" class="block text-xs font-bold uppercase tracking-[0.2em] text-dpm-gold">
            Sebutkan Jenis Aspirasi <span class="text-dpm-orange font-black">*</span>
        </label>
        <input 
            type="text" 
            name="jenis_aspirasi_other" 
            id="jenis_aspirasi_other" 
            x-model="otherVal"
            placeholder="Tuliskan jenis aspirasi yang Anda maksud..."
            :class="errors?.jenis_other ? 'border-red-500 shadow-glow-error' : 'border-dpm-orange/60 focus:border-dpm-gold focus:shadow-glow-orange-input'"
            class="w-full px-4 py-3.5 rounded-[13px] bg-dpm-black/40 border text-white placeholder-dpm-cream/30 text-sm focus:outline-none hover:border-dpm-orange transition-all duration-200"
        >
        <template x-if="errors?.jenis_other">
            <p class="text-xs text-red-400 font-medium tracking-wide" x-text="errors.jenis_other"></p>
        </template>
        @error('jenis_aspirasi_other')
            <p class="text-xs text-red-400 font-medium tracking-wide mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
