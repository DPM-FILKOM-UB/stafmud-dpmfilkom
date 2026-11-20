{{-- Pakai sekali saja per halaman. Dibuka oleh tombol dengan atribut data-bukti-open. --}}
<dialog id="buktiModal"
    class="m-auto w-[min(92vw,56rem)] overflow-hidden rounded-card border border-dpm-border bg-dpm-card p-0 text-dpm-cream shadow-glow-orange backdrop:bg-black/70 backdrop:backdrop-blur-sm">
    <div class="flex max-h-[90vh] flex-col">
        {{-- Header --}}
        <div class="flex items-start justify-between gap-4 border-b border-dpm-gray px-6 py-4">
            <div class="min-w-0">
                <h3 id="buktiTitle" class="truncate text-lg font-semibold"></h3>
                <p id="buktiCount" class="text-xs text-dpm-muted"></p>
            </div>
            <button type="button" id="buktiClose" aria-label="Tutup"
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-dpm-muted transition hover:bg-dpm-surface hover:text-dpm-gold-bright">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>

        {{-- Tampilan 1: grid thumbnail (scroll kalau banyak) --}}
        <div id="buktiGridWrap" class="overflow-y-auto p-6">
            <div id="buktiGrid" class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4"></div>
        </div>

        {{-- Tampilan 2: viewer satu gambar dengan navigasi --}}
        <div id="buktiViewer" class="hidden flex-col">
            <div class="relative flex min-h-[16rem] items-center justify-center bg-dpm-black/60 p-4">
                <img id="buktiImg" alt="" class="max-h-[60vh] max-w-full rounded-lg object-contain">
                <button type="button" id="buktiPrev" aria-label="Sebelumnya"
                    class="absolute left-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-dpm-card/90 text-dpm-cream transition hover:text-dpm-gold-bright hover:shadow-glow-orange">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 6l-6 6 6 6" />
                    </svg>
                </button>
                <button type="button" id="buktiNext" aria-label="Berikutnya"
                    class="absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-dpm-card/90 text-dpm-cream transition hover:text-dpm-gold-bright hover:shadow-glow-orange">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 6l6 6-6 6" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-wrap items-center justify-between gap-3 border-t border-dpm-gray px-6 py-3 text-sm">
                <button type="button" id="buktiBack"
                    class="text-dpm-orange-light transition hover:text-dpm-gold-bright">← Semua bukti</button>
                <span class="min-w-0 truncate text-dpm-muted"><span id="buktiName"></span> · <span
                        id="buktiPos"></span></span>
                <a id="buktiOpen" href="#" target="_blank" rel="noopener"
                    class="text-dpm-orange-light transition hover:text-dpm-gold-bright">Buka di tab baru ↗</a>
            </div>
        </div>
    </div>
</dialog>

<script>
    (() => {
        const $ = (id) => document.getElementById(id);
        const dlg = $('buktiModal');
        const gridWrap = $('buktiGridWrap'),
            grid = $('buktiGrid'),
            viewer = $('buktiViewer');
        const img = $('buktiImg'),
            prevBtn = $('buktiPrev'),
            nextBtn = $('buktiNext');

        let images = [];
        let idx = 0;

        const el = (tag, cls, text) => {
            const e = document.createElement(tag);
            if (cls) e.className = cls;
            if (text !== undefined) e.textContent = text;
            return e;
        };

        function showGrid() {
            viewer.classList.add('hidden');
            viewer.classList.remove('flex');
            gridWrap.classList.remove('hidden');
        }

        function showImage(i) {
            idx = (i + images.length) % images.length;
            const f = images[idx];
            img.src = f.url;
            img.alt = f.name;
            $('buktiName').textContent = f.name;
            $('buktiPos').textContent = (idx + 1) + ' / ' + images.length;
            $('buktiOpen').href = f.url;
            const many = images.length > 1;
            prevBtn.classList.toggle('hidden', !many);
            nextBtn.classList.toggle('hidden', !many);
            gridWrap.classList.add('hidden');
            viewer.classList.remove('hidden');
            viewer.classList.add('flex');
        }

        function open(title, files) {
            images = files.filter((f) => f.image);
            $('buktiTitle').textContent = title;
            $('buktiCount').textContent = files.length + ' file' + (images.length ? ' · ' + images.length +
                ' gambar' : '');

            grid.replaceChildren();
            files.forEach((f) => {
                if (f.image) {
                    const n = images.indexOf(f);
                    const tile = el('button',
                        'group relative aspect-square overflow-hidden rounded-xl border border-dpm-gray bg-dpm-surface transition hover:border-dpm-orange hover:shadow-glow-orange'
                        );
                    tile.type = 'button';
                    const thumb = el('img', 'h-full w-full object-cover');
                    thumb.src = f.url;
                    thumb.alt = f.name;
                    thumb.loading = 'lazy';
                    tile.append(thumb, el('span',
                        'absolute bottom-1 right-1 rounded-md bg-black/60 px-1.5 py-0.5 text-[10px] text-dpm-cream',
                        String(n + 1)));
                    tile.addEventListener('click', () => showImage(n));
                    grid.append(tile);
                } else {
                    const tile = el('a',
                        'flex aspect-square flex-col items-center justify-center gap-1 rounded-xl border border-dpm-gray bg-dpm-surface p-2 text-center transition hover:border-dpm-orange hover:shadow-glow-orange'
                        );
                    tile.href = f.url;
                    tile.target = '_blank';
                    tile.rel = 'noopener';
                    tile.append(
                        el('span', 'text-sm font-bold uppercase text-dpm-gold', (f.name.split('.')
                        .pop() || 'file').slice(0, 5)),
                        el('span', 'w-full truncate text-[10px] text-dpm-muted', f.name)
                    );
                    grid.append(tile);
                }
            });

            showGrid();
            gridWrap.scrollTop = 0;
            document.body.classList.add('overflow-hidden');
            dlg.showModal();
        }

        // Tombol pemicu (event delegation, jadi aman untuk baris yang banyak)
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('[data-bukti-open]');
            if (!btn) return;
            let files = [];
            try {
                files = JSON.parse(btn.dataset.files || '[]');
            } catch (_) {}
            if (files.length) open(btn.dataset.title || 'Bukti', files);
        });

        $('buktiClose').addEventListener('click', () => dlg.close());
        $('buktiBack').addEventListener('click', showGrid);
        prevBtn.addEventListener('click', () => showImage(idx - 1));
        nextBtn.addEventListener('click', () => showImage(idx + 1));

        // Klik area gelap di luar kotak = tutup
        dlg.addEventListener('click', (e) => {
            if (e.target === dlg) dlg.close();
        });

        // Esc: kalau sedang di viewer, kembali ke grid dulu
        dlg.addEventListener('cancel', (e) => {
            if (!viewer.classList.contains('hidden')) {
                e.preventDefault();
                showGrid();
            }
        });

        // Panah kiri/kanan untuk pindah gambar
        dlg.addEventListener('keydown', (e) => {
            if (viewer.classList.contains('hidden')) return;
            if (e.key === 'ArrowLeft') showImage(idx - 1);
            if (e.key === 'ArrowRight') showImage(idx + 1);
        });

        dlg.addEventListener('close', () => {
            document.body.classList.remove('overflow-hidden');
            img.removeAttribute('src');
        });
    })();
</script>
