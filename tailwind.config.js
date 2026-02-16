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
                        50: '#f0f7ff',
                        100: '#e0effe',
                        200: '#b9dffe',
                        300: '#7cc2fd',
                        400: '#36a4fa',
                        500: '#0c89eb',
                        600: '#066dc1',
                        700: '#06579d',
                        800: '#084a81',
                        900: '#0d3f6b',
                        950: '#092846',
                    },
                    green: {
                        50: '#f2fcf1',
                        100: '#e1f9e0',
                        200: '#c3f2c2',
                        300: '#94e693',
                        400: '#5dd15c',
                        500: '#36b735',
                        600: '#289727',
                        700: '#217721',
                        800: '#1f5e1f',
                        900: '#1b4f1b',
                        950: '#0a2c0a',
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
