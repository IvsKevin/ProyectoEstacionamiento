/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./view/**/*.{php, js, html}",
    "./view/dashboard.php",
    "./index.php"
  ],
  theme: {
    extend: {
      colors: {
        'principal': '#696969',
        'azul-oscuro': '#0d1b3e',
        'azul-principal': 'rgb(17 24 39 / var(--tw-bg-opacity)',
        'gris-clarito': '#181924',
        'gris-oscurito': '#2a2b36',
        'search' : '#7582ff',
      }
    },
  },
  plugins: [require("daisyui")],
}

