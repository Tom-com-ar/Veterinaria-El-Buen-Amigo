/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.html",        // si usas HTML suelto
    "./src/**/*.{js,ts,jsx,tsx}", // si usas JS/React
    "./pages/**/*.html",
    "./**/*.php"       // si usas PHP
  ],
  theme: {
    extend: {
      screens: {
        xs: '321px',
        'max-xs': {'max': '321px'},
      }
    }
  },
  plugins: [],
}
