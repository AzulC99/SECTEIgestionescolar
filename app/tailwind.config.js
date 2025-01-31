/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/views/**/*.php",
        "./public/**/*.{html,js,php}",
        "./src/**/*.{html,js,php}"
  ],
  theme: {
    extend: {
      colors: {
        primary: {
            50: '#f0f9ff',
            100: '#e0f2fe',
            500: '#0ea5e9',
            600: '#0284c7',
            700: '#0369a1',
        },
        secondary: {
            50: '#f8fafc',
            100: '#f1f5f9',
            500: '#64748b',
            600: '#475569',
            700: '#334155',
        }
    },
    fontFamily: {
        sans: ['Inter', 'sans-serif'],
    }

    },
  },
  plugins: [

    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}

