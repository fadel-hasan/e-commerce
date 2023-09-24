/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/*.blade.php",
    "./resources/views/**/*.blade.php",
    "./resources/**/*.ts",
    "./app/Http/Controllers/**/*.php",
    "./resources/scss/style.scss",
    "./resources/scss/**/*.scss",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

