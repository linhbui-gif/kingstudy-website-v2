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
    },
    colors: {
      black: '#000000',
      white: '#FFFFFF',
      'black-2': '#101010',
      gray: '#D8D8D8',
      blue: '#2AD3F8',
    },
    fontFamily: {
      Kan: 'Kanit, sans-serif',
      Unbutu: 'Ubuntu, sans-serif',
    },
  },
  plugins: [],
  corePlugins: {
    preflight: false,
  },
};
