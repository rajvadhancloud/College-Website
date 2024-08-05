/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {
      // backgroundImage:{
      //   'backgroundImage':"url('/assets/iitbg.jpg')"
      // },
      height:{
        '128': '32rem',
        '144': '36rem',
        '160': '40rem',
        '200': '46rem',
      },
      backgroundColor:{
        'primary':'#b5d7f8'
      }
    },
  },
  plugins: [],
}

