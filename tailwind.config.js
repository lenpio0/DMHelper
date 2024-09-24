import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'soft-black-1' : '#222222',
                'soft-black-2' : '#313131',
                'soft-black-3' : '#424242',
                'soft-white-1' : '#d9d9d9',
                'soft-white-2' : '#b3b3b3',
                'soft-white-3' : '#a9a9a9',

            },
        },
    },

    plugins: [forms, typography],
};
