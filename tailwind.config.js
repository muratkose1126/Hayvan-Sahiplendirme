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
            backgroundImage: {
                'gradient-background': 'linear-gradient(to bottom right, #F0F4F8, #E6EEF5)',
                'gradient-background-dark': 'linear-gradient(to bottom right, #1A202C, #2D3748)',
            },
            colors: {
                primary: {
                    DEFAULT: '#4299E1',
                    dark: '#63B3ED',
                    text: '#1A202C',
                    'text-dark': '#E6F2FF',
                },
                secondary: {
                    DEFAULT: '#9F7AEA',
                    dark: '#B794F4',
                    text: '#553C9A',
                    'text-dark': '#FAF5FF',
                },
                neutral: {
                    DEFAULT: '#718096',
                    dark: '#A0AEC0',
                    text: '#1A202C',
                    'text-dark': '#F7FAFC',
                },
                accent: {
                    DEFAULT: '#ED8936',
                    dark: '#F6AD55',
                    text: '#7B341E',
                    'text-dark': '#FFFAF0',
                },
                success: {
                    DEFAULT: '#48BB78',
                    dark: '#68D391',
                    text: '#22543D',
                    'text-dark': '#F0FFF4',
                },
                warning: {
                    DEFAULT: '#ECC94B',
                    dark: '#F6E05E',
                    text: '#744210',
                    'text-dark': '#FFFFF0',
                },
                danger: {
                    DEFAULT: '#F56565',
                    dark: '#FC8181',
                    text: '#742A2A',
                    'text-dark': '#FFF5F5',
                },
                background: {
                    DEFAULT: '#FFFFFF',
                    dark: '#1A202C',
                },
                surface: {
                    DEFAULT: '#F7FAFC',
                    dark: '#2D3748',
                },
                input: {
                    DEFAULT: '#EDF2F7',
                    dark: '#4A5568',
                    hover: '#E2E8F0',
                    'hover-dark': '#718096',
                    focus: '#CBD5E0',
                    'focus-dark': '#A0AEC0',
                    text: '#2D3748',
                    'text-dark': '#E2E8F0',
                    placeholder: '#A0AEC0',
                    'placeholder-dark': '#718096',
                    border: '#CBD5E0',
                    'border-dark': '#4A5568',
                },
                btn: {
                    primary: {
                        DEFAULT: '#4299E1',
                        dark: '#63B3ED',
                        hover: '#3182CE',
                        'hover-dark': '#90CDF4',
                        focus: '#2C5282',
                        'focus-dark': '#BEE3F8',
                        text: '#E6F2FF',
                        'text-dark': '#E6F2FF',
                    },
                    secondary: {
                        DEFAULT: '#9F7AEA',
                        dark: '#B794F4',
                        hover: '#805AD5',
                        'hover-dark': '#D6BCFA',
                        focus: '#6B46C1',
                        'focus-dark': '#E9D8FD',
                        text: '#FAF5FF',
                        'text-dark': '#FAF5FF',
                    },
                    neutral: {
                        DEFAULT: '#718096',
                        dark: '#A0AEC0',
                        hover: '#4A5568',
                        'hover-dark': '#CBD5E0',
                        focus: '#2D3748',
                        'focus-dark': '#E2E8F0',
                        text: '#1A202C',
                        'text-dark': '#F7FAFC',
                    },
                    accent: {
                        DEFAULT: '#ED8936',
                        dark: '#F6AD55',
                        hover: '#DD6B20',
                        'hover-dark': '#FBD38D',
                        focus: '#C05621',
                        'focus-dark': '#FEEBC8',
                        text: '#7B341E',
                        'text-dark': '#FFFAF0',
                    },
                    success: {
                        DEFAULT: '#48BB78',
                        dark: '#68D391',
                        hover: '#38A169',
                        'hover-dark': '#9AE6B4',
                        focus: '#2F855A',
                        'focus-dark': '#C6F6D5',
                        text: '#22543D',
                        'text-dark': '#F0FFF4',
                    },
                    warning: {
                        DEFAULT: '#ECC94B',
                        dark: '#F6E05E',
                        hover: '#D69E2E',
                        'hover-dark': '#FAF089',
                        focus: '#B7791F',
                        'focus-dark': '#FEFCBF',
                        text: '#744210',
                        'text-dark': '#FFFFF0',
                    },
                    danger: {
                        DEFAULT: '#F56565',
                        dark: '#FC8181',
                        hover: '#E53E3E',
                        'hover-dark': '#FEB2B2',
                        focus: '#C53030',
                        'focus-dark': '#FED7D7',
                        text: '#742A2A',
                        'text-dark': '#FFF5F5',
                    },
                },
            },
        },
    },

    plugins: [forms],
};
