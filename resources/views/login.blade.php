<!DOCTYPE html>
<html lang="id" class="bg-dpm-black">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-dpm.png') }}">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-dpm-black font-sans text-dpm-cream antialiased">
    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10">
        {{-- Ambient glow --}}
        <div
            class="pointer-events-none absolute -top-40 left-1/2 h-[28rem] w-[28rem] -translate-x-1/2 rounded-full bg-dpm-orange/20 blur-3xl">
        </div>
        <div class="pointer-events-none absolute -bottom-40 right-0 h-80 w-80 rounded-full bg-dpm-gold/10 blur-3xl">
        </div>

        <div class="relative w-full max-w-md">
            {{-- Brand --}}
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-4 h-14 w-14 rounded-card bg-gradient-to-br from-dpm-orange to-dpm-gold-bright p-[2px] shadow-glow-gold">
                    <div class="flex h-full w-full items-center justify-center rounded-[16px] bg-dpm-card">
                        <img src="{{ asset('images/logo-dpm.png') }}" alt="Logo DPM FILKOM UB"
                            class="w-10 h-10 object-contain drop-shadow-md group-hover:scale-105 transition-transform">
                    </div>
                </div>
                <h1 class="text-2xl font-bold tracking-tight">Selamat datang kembali</h1>
                <p class="mt-1 text-sm text-dpm-muted">Masuk untuk melanjutkan ke dashboard DPM</p>
            </div>

            <div class="rounded-card border border-dpm-border bg-dpm-card p-8 shadow-glow-orange">
                @if (session('status'))
                    <div class="mb-5 rounded-xl bg-dpm-gold/10 px-4 py-3 text-sm text-dpm-gold-bright">
                        {{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-dpm-cream">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username" placeholder="nama@email.com"
                            class="w-full rounded-xl border bg-dpm-surface px-4 py-3 text-sm text-dpm-cream placeholder-dpm-muted/60 outline-none transition
                        {{ $errors->has('email') ? 'border-red-500/70 shadow-glow-error' : 'border-dpm-gray focus:border-dpm-orange focus:shadow-glow-orange-input' }}">
                        @error('email')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label for="password" class="text-sm font-medium text-dpm-cream">Kata sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs text-dpm-orange-light transition hover:text-dpm-gold-bright">Lupa
                                    sandi?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <input id="password" name="password" type="password" required
                                autocomplete="current-password" placeholder="••••••••"
                                class="w-full rounded-xl border bg-dpm-surface px-4 py-3 pr-12 text-sm text-dpm-cream placeholder-dpm-muted/60 outline-none transition
                            {{ $errors->has('password') ? 'border-red-500/70 shadow-glow-error' : 'border-dpm-gray focus:border-dpm-orange focus:shadow-glow-orange-input' }}">
                            <button type="button" id="togglePassword" aria-label="Tampilkan kata sandi"
                                class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-dpm-muted transition hover:text-dpm-gold-bright">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.6"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember --}}
                    <label class="flex cursor-pointer items-center gap-2 text-sm text-dpm-muted">
                        <input type="checkbox" name="remember"
                            class="h-4 w-4 rounded border-dpm-gray bg-dpm-surface text-dpm-orange focus:ring-dpm-orange/40 focus:ring-offset-0">
                        Ingat saya
                    </label>

                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-dpm-orange to-dpm-orange-vibrant px-4 py-3 text-sm font-semibold text-dpm-black transition hover:shadow-glow-orange hover:brightness-110 focus:outline-none focus:shadow-glow-orange-input active:scale-[0.99]">
                        Masuk
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-dpm-muted">&copy; {{ date('Y') }} DPM. Hak cipta dilindungi.
            </p>
        </div>
    </main>

    <script>
        document.getElementById('togglePassword').addEventListener('click', () => {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
    </script>
</body>

</html>
