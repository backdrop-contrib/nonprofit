/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'selector',
  content: [
    "./**/*.tpl.php",
    "./*.info",
    "./template.php",
    "./js/**/*.js",
    "./src/safelist.txt",
  ],
  theme: {
    extend: {
      colors: {
        forest: '#123d35',
        mint: '#dff3e8',
        lime: '#bce875',
        ink: '#17352f',
      },
    },
  },
  plugins: [],
}

