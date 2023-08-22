/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/*.blade.php",
    "./resources/views/**/*.blade.php",
    "./resources/**/*.ts",
    "./resources/**/*.js",
    "./resources/**/*.css",
    "./app/Http/Controllers/**/*.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

