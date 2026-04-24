import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';

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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        daisyui,
    ],

    daisyui: {
        themes: [
            {
                shiftswap: {
                    'primary':          '#2563EB', // blue-600
                    'primary-content':  '#ffffff',
                    'secondary':        '#F38222',
                    'secondary-content':'#ffffff',
                    'accent':           '#F97316', // orange-500
                    'accent-content':   '#ffffff',
                    'neutral':          '#374151', // gray-700
                    'neutral-content':  '#ffffff',
                    'base-100':         '#ffffff',
                    'base-200':         '#F9FAFB', // gray-50
                    'base-300':         '#F3F4F6', // gray-100
                    'base-content':     '#111827', // gray-900
                    'info':             '#0EA5E9',
                    'info-content':     '#ffffff',
                    'success':          '#16A34A',
                    'success-content':  '#ffffff',
                    'warning':          '#D97706',
                    'warning-content':  '#ffffff',
                    'error':            '#DC2626',
                    'error-content':    '#ffffff',
                },
            },
        ],
        darkTheme: false,
        logs: false,
    },
};
