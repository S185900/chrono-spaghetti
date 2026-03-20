/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php", // これがないとコンポーネントの中身を見に行きません！
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'baloo': ['"Baloo Chettan 2"', 'Inter', 'sans-serif'],
      },
      colors: {
        'brand': {
          'primary': '#ff8c00',
          'secondary': '#150029',
        },
      },
    },
  },
  plugins: [],
}