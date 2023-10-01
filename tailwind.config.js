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
    extend: {
        colors: {
            blue: {
                500: '#2563EB',
                300: '#427EFF',
                800: '#0D3B9E'
            },
            yellow: {
                200: '#FCE61C',
                300: '#F7B928',
                500: '#D19C21',
                800: '#9E6E00',
            },
            white: '#efefef'
        }
    },
  },
  plugins: [],
}

