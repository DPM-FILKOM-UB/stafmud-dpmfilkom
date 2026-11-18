import defaultTheme from 'tailwindcss/defaultTheme';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                dpm: {
                    black: '#0B0B0D',
                    surface: '#101218',
                    card: '#16171D',
                    gray: '#282B32',
                    muted: '#B0B0B0',
                    cream: '#F3EDE1',
                    orange: {
                        DEFAULT: '#C55F06',
                        light: '#F6B06A',
                        dark: '#C96A12',
                        vibrant: '#F5A623',
                    },
                    gold: {
                        DEFAULT: '#DFA94E',
                        bright: '#FED06C',
                        warm: '#D9A441',
                    },
                    border: 'rgba(197, 95, 6, 0.45)',
                    footer: '#070707',
                }
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'glow-orange': '0 0 25px -4px rgba(197, 95, 6, 0.35)',
                'glow-orange-input': '0 0 0 3px rgba(197, 95, 6, 0.25), 0 0 20px rgba(254, 208, 108, 0.3)',
                'glow-gold': '0 0 30px -5px rgba(223, 169, 78, 0.35)',
                'glow-error': '0 0 0 3px rgba(239, 68, 68, 0.2), 0 0 16px rgba(239, 68, 68, 0.25)',
            },
            borderRadius: {
                'card': '18px',
            }
        },
    },
    plugins: [],
};
