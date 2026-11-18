<section id="form-aspirasi" class="py-20 sm:py-28 bg-dpm-surface relative border-t border-dpm-gray/40">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center space-y-4 mb-12 reveal-on-scroll">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full border border-dpm-gold/40 text-dpm-gold text-[11px] font-bold tracking-[0.2em] uppercase">
                FORM ASPIRASI
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black uppercase tracking-tight">
                <span class="text-white">SAMPAIKAN</span>
                <span class="text-dpm-gold-bright">ASPIRASIMU</span>
            </h2>
            <p class="text-dpm-muted text-sm sm:text-base max-w-xl mx-auto">
                Isi formulir berikut dengan jelas. Suaramu akan dijamin kerahasiaannya dan diproses secara bertanggung jawab.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-8 p-6 rounded-2xl bg-dpm-card border border-dpm-gold/70 shadow-glow-gold flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-dpm-gold/20 border border-dpm-gold flex-shrink-0 flex items-center justify-center text-dpm-gold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-dpm-gold-bright uppercase tracking-wide">Pengiriman Berhasil!</h3>
                    <p class="mt-1 text-sm text-dpm-cream/90 leading-relaxed">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div 
            x-data="{
                charCount: {{ strlen(old('aspirasi', '')) }},
                errors: {},
                validateForm(e) {
                    this.errors = {};
                    let isValid = true;
                    let firstInvalidField = null;

                    const prodi = document.querySelector('input[name=prodi]').value;
                    if (!prodi) {
                        this.errors.prodi = 'Silakan pilih Program Studi.';
                        if (!firstInvalidField) firstInvalidField = document.getElementById('prodi_button');
                        isValid = false;
                    }

                    const kontak = document.getElementById('kontak').value.trim();
                    if (!kontak) {
                        this.errors.kontak = 'Kontak wajib diisi.';
                        if (!firstInvalidField) firstInvalidField = document.getElementById('kontak');
                        isValid = false;
                    }

                    const jenis = document.querySelector('input[name=jenis_aspirasi]').value;
                    if (!jenis) {
                        this.errors.jenis = 'Silakan tentukan jenis aspirasi.';
                        if (!firstInvalidField) firstInvalidField = document.getElementById('jenis_button');
                        isValid = false;
                    } else if (jenis === 'Other') {
                        const jenisOther = document.getElementById('jenis_aspirasi_other')?.value.trim();
                        if (!jenisOther) {
                            this.errors.jenis_other = 'Mohon sebutkan jenis aspirasi Anda.';
                            if (!firstInvalidField) firstInvalidField = document.getElementById('jenis_aspirasi_other');
                            isValid = false;
                        }
                    }

                    const aspirasi = document.getElementById('aspirasi').value.trim();
                    if (!aspirasi) {
                        this.errors.aspirasi = 'Uraian aspirasi tidak boleh kosong.';
                        if (!firstInvalidField) firstInvalidField = document.getElementById('aspirasi');
                        isValid = false;
                    } else if (aspirasi.length < 10) {
                        this.errors.aspirasi = 'Aspirasi minimal 10 karakter.';
                        if (!firstInvalidField) firstInvalidField = document.getElementById('aspirasi');
                        isValid = false;
                    }

                    const waktu = document.getElementById('waktu_kejadian').value;
                    if (!waktu) {
                        this.errors.waktu = 'Waktu kejadian wajib diisi.';
                        if (!firstInvalidField) firstInvalidField = document.getElementById('waktu_kejadian');
                        isValid = false;
                    }

                    if (!isValid) {
                        e.preventDefault();
                        if (firstInvalidField) {
                            firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            firstInvalidField.focus();
                        }
                    }
                }
            }"
            class="bg-dpm-surface border border-dpm-orange/70 rounded-[20px] p-6 sm:p-10 shadow-glow-orange relative"
        >
            <form 
                action="{{ route('aspirasi.store') }}" 
                method="POST" 
                enctype="multipart/form-data" 
                @submit="validateForm($event)"
                class="space-y-7"
                novalidate
            >
                @csrf

                <div class="space-y-2 group">
                    <div class="flex items-center justify-between">
                        <label for="nama" class="block text-xs font-bold uppercase tracking-[0.2em] text-dpm-gold group-focus-within:text-dpm-gold-bright transition-colors">
                            Nama Lengkap
                        </label>
                        <span class="text-[11px] text-dpm-muted uppercase tracking-wider font-medium">(Boleh Dikosongkan / Anonim)</span>
                    </div>
                    <input 
                        type="text" 
                        name="nama" 
                        id="nama" 
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama Anda (atau biarkan kosong jika anonim)"
                        class="w-full px-4 py-3.5 rounded-[13px] bg-dpm-black/40 border border-dpm-orange/60 text-white placeholder-dpm-cream/30 text-sm focus:outline-none focus:border-dpm-gold focus:shadow-glow-orange-input hover:border-dpm-orange transition-all duration-200"
                    >
                    @error('nama')
                        <p class="text-xs text-red-400 font-medium tracking-wide mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-prodi-dropdown :selected="old('prodi', '')" />

                <div class="space-y-2 group">
                    <label for="kontak" class="block text-xs font-bold uppercase tracking-[0.2em] text-dpm-gold group-focus-within:text-dpm-gold-bright transition-colors">
                        Kontak yang Dapat Dihubungi <span class="text-dpm-orange font-black">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="kontak" 
                        id="kontak" 
                        value="{{ old('kontak') }}"
                        placeholder="Nomor WhatsApp, ID Line, akun Instagram, atau email UB"
                        :class="errors.kontak ? 'border-red-500 shadow-glow-error' : 'border-dpm-orange/60 focus:border-dpm-gold focus:shadow-glow-orange-input'"
                        class="w-full px-4 py-3.5 rounded-[13px] bg-dpm-black/40 border text-white placeholder-dpm-cream/30 text-sm focus:outline-none hover:border-dpm-orange transition-all duration-200"
                    >
                    <template x-if="errors.kontak">
                        <p class="text-xs text-red-400 font-medium tracking-wide" x-text="errors.kontak"></p>
                    </template>
                    @error('kontak')
                        <p class="text-xs text-red-400 font-medium tracking-wide mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-jenis-dropdown :selected="old('jenis_aspirasi', '')" :otherValue="old('jenis_aspirasi_other', '')" />

                <div class="space-y-2 group">
                    <div class="flex items-center justify-between">
                        <label for="aspirasi" class="block text-xs font-bold uppercase tracking-[0.2em] text-dpm-gold group-focus-within:text-dpm-gold-bright transition-colors">
                            Uraian Aspirasi <span class="text-dpm-orange font-black">*</span>
                        </label>
                        <span class="text-[11px] text-dpm-muted font-mono">
                            <span x-text="charCount"></span> / 2500 karakter
                        </span>
                    </div>
                    <textarea 
                        name="aspirasi" 
                        id="aspirasi" 
                        rows="5"
                        maxlength="2500"
                        @input="charCount = $event.target.value.length"
                        placeholder="Jelaskan aspirasi, keluhan, masukan, atau kendala yang Anda alami secara detail..."
                        :class="errors.aspirasi ? 'border-red-500 shadow-glow-error' : 'border-dpm-orange/60 focus:border-dpm-gold focus:shadow-glow-orange-input'"
                        class="w-full px-4 py-3.5 rounded-[13px] bg-dpm-black/40 border text-white placeholder-dpm-cream/30 text-sm focus:outline-none hover:border-dpm-orange transition-all duration-200"
                    >{{ old('aspirasi') }}</textarea>
                    <template x-if="errors.aspirasi">
                        <p class="text-xs text-red-400 font-medium tracking-wide" x-text="errors.aspirasi"></p>
                    </template>
                    @error('aspirasi')
                        <p class="text-xs text-red-400 font-medium tracking-wide mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 group">
                    <label for="waktu_kejadian" class="block text-xs font-bold uppercase tracking-[0.2em] text-dpm-gold group-focus-within:text-dpm-gold-bright transition-colors">
                        Waktu Kejadian <span class="text-dpm-orange font-black">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        name="waktu_kejadian" 
                        id="waktu_kejadian" 
                        max="{{ now()->format('Y-m-d\TH:i') }}"
                        value="{{ old('waktu_kejadian') }}"
                        :class="errors.waktu ? 'border-red-500 shadow-glow-error' : 'border-dpm-orange/60 focus:border-dpm-gold focus:shadow-glow-orange-input'"
                        class="w-full px-4 py-3.5 rounded-[13px] bg-dpm-black/40 border text-white placeholder-dpm-cream/30 text-sm focus:outline-none hover:border-dpm-orange transition-all duration-200"
                    >
                    <template x-if="errors.waktu">
                        <p class="text-xs text-red-400 font-medium tracking-wide" x-text="errors.waktu"></p>
                    </template>
                    @error('waktu_kejadian')
                        <p class="text-xs text-red-400 font-medium tracking-wide mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-file-upload />

                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-dpm-gold text-dpm-black font-extrabold text-sm uppercase tracking-wider shadow-glow-gold hover:bg-dpm-gold-bright active:scale-[0.99] group transition-all duration-200"
                    >
                        <span>Kirim Aspirasi Sekarang</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                    <p class="text-center text-[11px] text-dpm-muted mt-3">
                        Dengan mengirim formulir ini, Anda menyatakan data yang diberikan adalah benar dan dapat dipertanggungjawabkan.
                    </p>
                </div>

            </form>
        </div>

    </div>
</section>
