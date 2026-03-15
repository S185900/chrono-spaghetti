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
        // 'baloo' というクラス名で呼び出せるように設定
        'baloo': ['"Baloo Chettan 2"', 'Inter', 'sans-serif'],
      },
    },
  },
  plugins: [],
}