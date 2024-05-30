import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const plugin = require('tailwindcss/plugin')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    safelist: [
        {
            pattern: /bg-+/, // This includes bg of all colors and shades
        },
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
        plugin(function({ addUtilities }) {
            addUtilities({
                '.custom-scrollbar::-webkit-scrollbar': {
                    'width': '4px',
                },
                '.custom-scrollbar::-webkit-scrollbar-track': {
                    'background': '#ffffff',
                },

                '.custom-scrollbar::-webkit-scrollbar-thumb': {
                    'background': '#888',
                },

                '.no-scrollbar::-webkit-scrollbar': {
                    'display': 'none',
                },

            })
        }),
    ],
};
