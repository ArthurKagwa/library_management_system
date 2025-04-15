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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#374151', // primary (for light mode text)
                    dark: '#d1d5db',    // primary-dark (for dark mode text)
                },
                secondary: {
                    DEFAULT: '#f3f4f6', // secondary (light background)
                    dark: '#111827',    // gray-800 (dark background)
                    accent : '#3b82f6', // blue-500 (accent color)
                },
            }
        },
    },

    plugins: [forms],
};
