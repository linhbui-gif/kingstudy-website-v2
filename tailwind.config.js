/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./src/**/*.{js,ts,jsx,tsx,mdx}'],
  theme: {
    extend: {
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'gradient-conic':
          'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
      },
      boxShadow: {
        md: '0 .4rem 2rem rgba(0, 0, 0, .2)',
      },
    },
    colors: {
      'style-7': '#141517',
      white: '#FFFFFF',
      primary: '#29448B',
      orange: '#f48331',
      green: '#008560',
      red: '#D51F32',
      purple: '#4f3792',
      pink: '#df6ca6',
    },
    fontFamily: {
      BeVnPro: 'Be Vietnam Pro sans-serif',
    },
    borderRadius: {
      sm: '0.5rem',
    },
  },
  plugins: [],
  corePlugins: {
    preflight: false,
  },
  important: true,
};
