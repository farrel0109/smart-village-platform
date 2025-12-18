import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
        display: ['Public Sans', 'Noto Sans', 'sans-serif'],
      },
      colors: {
        "primary": "#2E7D32",
        "primary-hover": "#1B5E20",
        "sky-blue": "#0288D1",
        "earth": "#795548",
        "dark-grey": "#263238",
        "background-light": "#FAFAFA",
        "background-dark": "#121212",
        "surface-dark": "#1E1E1E",
        "border-light": "#E0E0E0",
        "border-dark": "#333333",
        "text-secondary": "#616161",
        "text-secondary-dark": "#BDBDBD",
      },
      borderRadius: {
        "DEFAULT": "0.375rem",
        "lg": "0.5rem",
        "xl": "0.75rem",
        "full": "9999px",
      },
    },
  },
  plugins: [],
};
