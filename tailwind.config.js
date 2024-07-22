/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",

  ],
  theme: {
    extend: {
      colors: {
        'sidebar': '#222831',
        'font-light': '#EEEEEE',
        'font-dark': '#000000',
        'hover': '#76ABAE',
        'hover-logout': '#FF0000',
        'primary-bg': '#393E46',
        'secondary-bg': '#00ADB5',
        'accent': '#FF5722',
        'button-bg': '#4B4B4B',
        'success': '#4CAF50'
      }
      
    },
  },
  plugins: [],
}

