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
        './resources/views/**/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                'green-dark': '#142D10',
                'green-bright': '#2F8022',
                'graphite': '#2C2E29',
                'black-green': '#051103',
                'gray-soft': '#E0E8E8',
                'red-alert': '#B40F0F',
                'white': '#FFFFFF',
            },
            fontFamily: {
                sans: ['Poppins', 'Kameron', 'sans-serif'],
                heading: ['Montserrat', 'sans-serif'],
                kameron: ['Kameron', 'serif'],
            },
            fontSize: {
                'title-sm': '1.5rem',
                'title-md': '2rem',
            },
            zIndex: {
                '-1': '-1',
                '1': '1',
                '999999': '999999',
            },
            boxShadow: {
                'theme-xs': '0px 2px 4px 0px rgba(11, 40, 56, 0.08)',
            },
        },
    },
    darkMode: 'class',
    plugins: [
        forms,
        typography,
    ],
}
