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
                sans: ['Inter', 'Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    blue: {
                        50: 'rgb(var(--color-brand-blue-50) / <alpha-value>)',
                        100: 'rgb(var(--color-brand-blue-100) / <alpha-value>)',
                        200: 'rgb(var(--color-brand-blue-200) / <alpha-value>)',
                        300: 'rgb(var(--color-brand-blue-300) / <alpha-value>)',
                        400: 'rgb(var(--color-brand-blue-400) / <alpha-value>)',
                        500: 'rgb(var(--color-brand-blue-500) / <alpha-value>)',
                        600: 'rgb(var(--color-brand-blue-600) / <alpha-value>)',
                        700: 'rgb(var(--color-brand-blue-700) / <alpha-value>)',
                        800: 'rgb(var(--color-brand-blue-800) / <alpha-value>)',
                        900: 'rgb(var(--color-brand-blue-900) / <alpha-value>)',
                        950: 'rgb(var(--color-brand-blue-950) / <alpha-value>)',
                    },
                    green: {
                        50: 'rgb(var(--color-brand-green-50) / <alpha-value>)',
                        100: 'rgb(var(--color-brand-green-100) / <alpha-value>)',
                        200: 'rgb(var(--color-brand-green-200) / <alpha-value>)',
                        300: 'rgb(var(--color-brand-green-300) / <alpha-value>)',
                        400: 'rgb(var(--color-brand-green-400) / <alpha-value>)',
                        500: 'rgb(var(--color-brand-green-500) / <alpha-value>)',
                        600: 'rgb(var(--color-brand-green-600) / <alpha-value>)',
                        700: 'rgb(var(--color-brand-green-700) / <alpha-value>)',
                        800: 'rgb(var(--color-brand-green-800) / <alpha-value>)',
                        900: 'rgb(var(--color-brand-green-900) / <alpha-value>)',
                        950: 'rgb(var(--color-brand-green-950) / <alpha-value>)',
                    },
                }
            },
            boxShadow: {
                'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.37)',
            }
        },
    },

    plugins: [forms],
};
