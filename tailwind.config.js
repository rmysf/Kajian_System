import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    'emerald-950': 'var(--emerald-950)',
                    'emerald-900': 'var(--emerald-900)',
                    'emerald-700': 'var(--emerald-700)',
                    'emerald-600': 'var(--emerald-600)',
                    'emerald-500': 'var(--emerald-500)',
                    'emerald-300': 'var(--emerald-300)',
                    'emerald-100': 'var(--emerald-100)',
                    'gold': 'var(--gold)',
                    'gold-soft': 'var(--gold-soft)',
                    'gold-text': 'var(--gold-text)',
                    'cream': 'var(--cream)',
                    'ink': 'var(--ink)',
                    'ink-soft': 'var(--ink-soft)',
                    'bg-outer': 'var(--bg-outer)',
                    'border-light': 'var(--border-light)',
                    'border-card': 'var(--border-card)',
                    'nav-inactive': 'var(--nav-inactive)',
                    'badge-live': 'var(--badge-live)',
                    'danger': 'var(--danger)',
                    'danger-soft': 'var(--danger-soft)',
                    'danger-text': 'var(--danger-text)',
                }
            }
        },
    },

    plugins: [forms],
};
