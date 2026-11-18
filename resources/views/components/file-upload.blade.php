<div 
    x-data="{
        files: [],
        dragover: false,
        fileError: '',
        handleFiles(fileList) {
            this.fileError = '';
            for (let i = 0; i < fileList.length; i++) {
                const f = fileList[i];
                if (f.size > 5 * 1024 * 1024) {
                    this.fileError = `File ${f.name} melebihi batas 5 MB.`;
                    continue;
                }
                const allowed = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
                if (!allowed.includes(f.type)) {
                    this.fileError = `Format ${f.name} tidak didukung (gunakan JPG, PNG, atau PDF).`;
                    continue;
                }
                if (this.files.length >= 5) {
                    this.fileError = 'Maksimal 5 file pendukung.';
                    break;
                }
                this.files.push(f);
            }
            this.updateInput();
        },
        removeFile(index) {
            this.files.splice(index, 1);
            this.updateInput();
        },
        updateInput() {
            const dataTransfer = new DataTransfer();
            this.files.forEach(f => dataTransfer.items.add(f));
            this.$refs.fileInput.files = dataTransfer.files;
        }
    }"
    class="space-y-3"
>
    <div class="flex items-center justify-between">
        <label class="block text-xs font-bold uppercase tracking-[0.2em] text-dpm-gold">
            Bukti / Dokumen Pendukung
        </label>
        <span class="text-[11px] text-dpm-muted uppercase tracking-wider">(Opsional, Maks. 5 MB/file)</span>
    </div>

    <div 
        @dragover.prevent="dragover = true"
        @dragleave.prevent="dragover = false"
        @drop.prevent="dragover = false; handleFiles($event.dataTransfer.files)"
        :class="dragover ? 'border-dpm-gold bg-dpm-orange/10 shadow-glow-orange' : 'border-dpm-orange/60 bg-dpm-black/30 hover:border-dpm-orange'"
        class="border-2 border-dashed rounded-[14px] p-6 text-center cursor-pointer transition-all duration-200"
        @click="$refs.fileInput.click()"
    >
        <input 
            type="file" 
            x-ref="fileInput"
            name="bukti[]" 
            id="bukti" 
            multiple 
            accept=".jpg,.jpeg,.png,.pdf" 
            class="hidden"
            @change="handleFiles($event.target.files)"
        >

        <div class="flex flex-col items-center justify-center space-y-2">
            <div class="w-12 h-12 rounded-full bg-dpm-card border border-dpm-orange/40 flex items-center justify-center text-dpm-gold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-white">
                Tarik & letakkan file di sini, atau <span class="text-dpm-gold underline">klik untuk memilih</span>
            </p>
            <p class="text-xs text-dpm-muted">
                Format yang didukung: JPG, PNG, atau PDF (maksimal 5 MB per file)
            </p>
        </div>
    </div>

    <template x-if="fileError">
        <p class="text-xs text-red-400 font-medium tracking-wide" x-text="fileError"></p>
    </template>
    @error('bukti')
        <p class="text-xs text-red-400 font-medium tracking-wide">{{ $message }}</p>
    @enderror
    @error('bukti.*')
        <p class="text-xs text-red-400 font-medium tracking-wide">{{ $message }}</p>
    @enderror

    <template x-if="files.length > 0">
        <div class="space-y-2 pt-2">
            <p class="text-xs font-bold uppercase tracking-wider text-dpm-gold-warm">File Terlampir:</p>
            <div class="flex flex-wrap gap-2.5">
                <template x-for="(f, idx) in files" :key="idx">
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-dpm-card border border-dpm-orange/60 text-xs text-white">
                        <svg class="w-4 h-4 text-dpm-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="max-w-[160px] truncate font-medium" x-text="f.name"></span>
                        <span class="text-[10px] text-dpm-muted" x-text="'(' + (f.size / 1024 / 1024).toFixed(2) + ' MB)'"></span>
                        
                        <button 
                            type="button" 
                            @click="removeFile(idx)" 
                            class="text-dpm-muted hover:text-red-400 transition-colors ml-1 focus:outline-none"
                            title="Hapus file"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>
