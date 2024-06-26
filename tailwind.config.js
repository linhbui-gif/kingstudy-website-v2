/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./src/**/*.{js,ts,jsx,tsx,mdx}'],
  theme: {
    extend: {
      boxShadow: {
        sm: '0px 20px 40px 0px #182C4A0D',
        md: '0px 40px 50px 0px #1C335429',
      },
      borderWidth: {
        custom: '0.667px',
      },
      borderRadius: {
        arcodion: '6px 6px 0px 0px',
      }
    },
    colors: {
      white: '#FFFFFF',
      orange: '#F48331',
      green: '#008560',
      yellow: '#EEB443',
      red: '#D51F32',
      'style-1': '#000000',
      'style-2': '#262626',
      'style-3': '#0000EE',
      'style-4': '#82B440',
      'style-5': '#FFFFFF',
      'style-6': '#FFB013',
      'style-7': '#141517',
      'style-8': '#EDEEF2',
      'style-9': '#575757',
      'style-10': '#22458F',
      'style-12': '#575757',
      'style-13': '#F6F8FB',
      'style-14': '#EBFCF7',
      'style-15': '#31BF82',
      'style-16': '#EBF8FC',
      'style-17': '#319DBF',
      'style-18': '#FFEFF1',
      'style-19': '#BF315C',
      'style-20': '#FFFAF1',
      'style-21': '#BF7831',
      'style-23': '#DCE8FE',
      'style-24': '#F8F9FB',
      'style-25': '#007AFF',
      'style-26': '#A2A2A2',
      'style-27': '#212730',
      'style-28': '#1A1F27',
      'style-29': '#373A3E',
      'style-30': '#FFFFFF',
      'style-31': '#FF5002',
      'style-32': '#204590',
      'style-33': '#11367E',
      'style-34': '#FFAC00',
      'style-35': '#124694',
      'style-36': '#DDE2E6',
      'style-37': '#0069F5',
      'Chestnut/50': '#FCF5F4',
      'Chestnut/100': '#FAE8E6',
      'Chestnut/200': '#F6D5D2',
      'Chestnut/300': '#EFB7B2',
      'Chestnut/400': '#E48D85',
      'Chestnut/500': '#D6675D',
      'Chestnut/600': '#C4544A',
      'Chestnut/700': '#A23C33',
      'Chestnut/800': '#86352E',
      'Chestnut/900': '#70322C',
      'Chestnut/950': '#3C1613',
      'Tailwind/black': '#000000',
      'Tailwind/white': '#FFFFFF',
      'Tailwind/slate/50': '#F8FAFC',
      'Tailwind/slate/100': '#F1F5F9',
      'Tailwind/slate/200': '#E2E8F0',
      'Tailwind/slate/300': '#CBD5E1',
      'Tailwind/slate/400': '#94A3B8',
      'Tailwind/slate/500': '#64748B',
      'Tailwind/slate/600': '#475569',
      'Tailwind/slate/700': '#334155',
      'Tailwind/slate/800': '#1E293B',
      'Tailwind/slate/900': '#0F172A',
      'Tailwind/slate/950': '#020617',
      'Tailwind/gray/50': '#F9FAFB',
      'Tailwind/gray/100': '#F3F4F6',
      'Tailwind/gray/200': '#E5E7EB',
      'Tailwind/gray/300': '#D1D5DB',
      'Tailwind/gray/400': '#9CA3AF',
      'Tailwind/gray/500': '#6B7280',
      'Tailwind/gray/600': '#4B5563',
      'Tailwind/gray/700': '#374151',
      'Tailwind/gray/800': '#1F2937',
      'Tailwind/gray/900': '#111827',
      'Tailwind/gray/950': '#030712',
      'Tailwind/zinc/50': '#FAFAFA',
      'Tailwind/zinc/100': '#F4F4F5',
      'Tailwind/zinc/200': '#E4E4E7',
      'Tailwind/zinc/300': '#D4D4D8',
      'Tailwind/zinc/400': '#A1A1AA',
      'Tailwind/zinc/500': '#71717A',
      'Tailwind/zinc/600': '#52525B',
      'Tailwind/zinc/700': '#3F3F46',
      'Tailwind/zinc/800': '#27272A',
      'Tailwind/zinc/900': '#18181B',
      'Tailwind/zinc/950': '#09090B',
      'Tailwind/neutral/50': '#FAFAFA',
      'Tailwind/neutral/100': '#F5F5F5',
      'Tailwind/neutral/200': '#E5E5E5',
      'Tailwind/neutral/300': '#D4D4D4',
      'Tailwind/neutral/400': '#A3A3A3',
      'Tailwind/neutral/500': '#737373',
      'Tailwind/neutral/600': '#525252',
      'Tailwind/neutral/700': '#404040',
      'Tailwind/neutral/800': '#262626',
      'Tailwind/neutral/900': '#171717',
      'Tailwind/neutral/950': '#0A0A0A',
      'Tailwind/stone/50': '#FAFAF9',
      'Tailwind/stone/100': '#F5F5F4',
      'Tailwind/stone/200': '#E7E5E4',
      'Tailwind/stone/300': '#D6D3D1',
      'Tailwind/stone/400': '#A8A29E',
      'Tailwind/stone/500': '#78716C',
      'Tailwind/stone/600': '#57534E',
      'Tailwind/stone/700': '#44403C',
      'Tailwind/stone/800': '#292524',
      'Tailwind/stone/900': '#1C1917',
      'Tailwind/stone/950': '#0C0A09',
      'Tailwind/red/50': '#FEF2F2',
      'Tailwind/red/100': '#FEE2E2',
      'Tailwind/red/200': '#FECACA',
      'Tailwind/red/300': '#FCA5A5',
      'Tailwind/red/400': '#F87171',
      'Tailwind/red/500': '#EF4444',
      'Tailwind/red/600': '#DC2626',
      'Tailwind/red/700': '#B91C1C',
      'Tailwind/red/800': '#991B1B',
      'Tailwind/red/900': '#7F1D1D',
      'Tailwind/red/950': '#450A0A',
      'Tailwind/orange/50': '#FFF7ED',
      'Tailwind/orange/100': '#FFEDD5',
      'Tailwind/orange/200': '#FED7AA',
      'Tailwind/orange/300': '#FDBA74',
      'Tailwind/orange/400': '#FB923C',
      'Tailwind/orange/500': '#F97316',
      'Tailwind/orange/600': '#EA580C',
      'Tailwind/orange/700': '#C2410C',
      'Tailwind/orange/800': '#9A3412',
      'Tailwind/orange/900': '#7C2D12',
      'Tailwind/orange/950': '#431407',
      'Tailwind/amber/50': '#FFFBEB',
      'Tailwind/amber/100': '#FEF3C7',
      'Tailwind/amber/200': '#FDE68A',
      'Tailwind/amber/300': '#FCD34D',
      'Tailwind/amber/400': '#FBBF24',
      'Tailwind/amber/500': '#F59E0B',
      'Tailwind/amber/600': '#D97706',
      'Tailwind/amber/700': '#B45309',
      'Tailwind/amber/800': '#92400E',
      'Tailwind/amber/900': '#78350F',
      'Tailwind/amber/950': '#451A03',
      'Tailwind/yellow/50': '#FEFCE8',
      'Tailwind/yellow/100': '#FEF9C3',
      'Tailwind/yellow/200': '#FEF08A',
      'Tailwind/yellow/300': '#FDE047',
      'Tailwind/yellow/400': '#FACC15',
      'Tailwind/yellow/500': '#EAB308',
      'Tailwind/yellow/600': '#CA8A04',
      'Tailwind/yellow/700': '#A16207',
      'Tailwind/yellow/800': '#854D0E',
      'Tailwind/yellow/900': '#713F12',
      'Tailwind/yellow/950': '#422006',
      'Tailwind/lime/50': '#F7FEE7',
      'Tailwind/lime/100': '#ECFCCB',
      'Tailwind/lime/200': '#D9F99D',
      'Tailwind/lime/300': '#BEF264',
      'Tailwind/lime/400': '#A3E635',
      'Tailwind/lime/500': '#84CC16',
      'Tailwind/lime/600': '#65A30D',
      'Tailwind/lime/700': '#4D7C0F',
      'Tailwind/lime/800': '#3F6212',
      'Tailwind/lime/900': '#365314',
      'Tailwind/lime/950': '#1A2E05',
      'Tailwind/green/50': '#F0FDF4',
      'Tailwind/green/100': '#DCFCE7',
      'Tailwind/green/200': '#BBF7D0',
      'Tailwind/green/300': '#86EFAC',
      'Tailwind/green/400': '#4ADE80',
      'Tailwind/green/500': '#22C55E',
      'Tailwind/green/600': '#16A34A',
      'Tailwind/green/700': '#15803D',
      'Tailwind/green/800': '#166534',
      'Tailwind/green/900': '#14532D',
      'Tailwind/green/950': '#052E16',
      'Tailwind/emerald/50': '#ECFDF5',
      'Tailwind/emerald/100': '#D1FAE5',
      'Tailwind/emerald/200': '#A7F3D0',
      'Tailwind/emerald/300': '#6EE7B7',
      'Tailwind/emerald/400': '#34D399',
      'Tailwind/emerald/500': '#10B981',
      'Tailwind/emerald/600': '#059669',
      'Tailwind/emerald/700': '#047857',
      'Tailwind/emerald/800': '#065F46',
      'Tailwind/emerald/900': '#064E3B',
      'Tailwind/emerald/950': '#022C22',
      'Tailwind/teal/50': '#F0FDFA',
      'Tailwind/teal/100': '#CCFBF1',
      'Tailwind/teal/200': '#99F6E4',
      'Tailwind/teal/300': '#5EEAD4',
      'Tailwind/teal/400': '#2DD4BF',
      'Tailwind/teal/500': '#14B8A6',
      'Tailwind/teal/600': '#0D9488',
      'Tailwind/teal/700': '#0F766E',
      'Tailwind/teal/800': '#115E59',
      'Tailwind/teal/900': '#134E4A',
      'Tailwind/teal/950': '#042F2E',
      'Tailwind/cyan/50': '#ECFEFF',
      'Tailwind/cyan/100': '#CFFAFE',
      'Tailwind/cyan/200': '#A5F3FC',
      'Tailwind/cyan/300': '#67E8F9',
      'Tailwind/cyan/400': '#22D3EE',
      'Tailwind/cyan/500': '#06B6D4',
      'Tailwind/cyan/600': '#0891B2',
      'Tailwind/cyan/700': '#0E7490',
      'Tailwind/cyan/800': '#155E75',
      'Tailwind/cyan/900': '#164E63',
      'Tailwind/cyan/950': '#083344',
      'Tailwind/sky/50': '#F0F9FF',
      'Tailwind/sky/100': '#E0F2FE',
      'Tailwind/sky/200': '#BAE6FD',
      'Tailwind/sky/300': '#7DD3FC',
      'Tailwind/sky/400': '#38BDF8',
      'Tailwind/sky/500': '#0EA5E9',
      'Tailwind/sky/600': '#0284C7',
      'Tailwind/sky/700': '#0369A1',
      'Tailwind/sky/800': '#075985',
      'Tailwind/sky/900': '#0C4A6E',
      'Tailwind/sky/950': '#082F49',
      'Tailwind/blue/50': '#EFF6FF',
      'Tailwind/blue/100': '#DBEAFE',
      'Tailwind/blue/200': '#BFDBFE',
      'Tailwind/blue/300': '#93C5FD',
      'Tailwind/blue/400': '#60A5FA',
      'Tailwind/blue/500': '#3B82F6',
      'Tailwind/blue/600': '#2563EB',
      'Tailwind/blue/700': '#1D4ED8',
      'Tailwind/blue/800': '#1E40AF',
      'Tailwind/blue/900': '#1E3A8A',
      'Tailwind/blue/950': '#172554',
      'Tailwind/indigo/50': '#EEF2FF',
      'Tailwind/indigo/100': '#E0E7FF',
      'Tailwind/indigo/200': '#C7D2FE',
      'Tailwind/indigo/300': '#A5B4FC',
      'Tailwind/indigo/400': '#818CF8',
      'Tailwind/indigo/500': '#6366F1',
      'Tailwind/indigo/600': '#4F46E5',
      'Tailwind/indigo/700': '#4338CA',
      'Tailwind/indigo/800': '#3730A3',
      'Tailwind/indigo/900': '#312E81',
      'Tailwind/indigo/950': '#1E1B4B',
      'Tailwind/violet/50': '#F5F3FF',
      'Tailwind/violet/100': '#EDE9FE',
      'Tailwind/violet/200': '#DDD6FE',
      'Tailwind/violet/300': '#C4B5FD',
      'Tailwind/violet/400': '#A78BFA',
      'Tailwind/violet/500': '#8B5CF6',
      'Tailwind/violet/600': '#7C3AED',
      'Tailwind/violet/700': '#6D28D9',
      'Tailwind/violet/800': '#5B21B6',
      'Tailwind/violet/900': '#4C1D95',
      'Tailwind/violet/950': '#2E1065',
      'Tailwind/purple/50': '#FAF5FF',
      'Tailwind/purple/100': '#F3E8FF',
      'Tailwind/purple/200': '#E9D5FF',
      'Tailwind/purple/300': '#D8B4FE',
      'Tailwind/purple/400': '#C084FC',
      'Tailwind/purple/500': '#A855F7',
      'Tailwind/purple/600': '#9333EA',
      'Tailwind/purple/700': '#7E22CE',
      'Tailwind/purple/800': '#6B21A8',
      'Tailwind/purple/900': '#581C87',
      'Tailwind/purple/950': '#3B0764',
      'Tailwind/fuchsia/50': '#FDF4FF',
      'Tailwind/fuchsia/100': '#FAE8FF',
      'Tailwind/fuchsia/200': '#F5D0FE',
      'Tailwind/fuchsia/300': '#F0ABFC',
      'Tailwind/fuchsia/400': '#E879F9',
      'Tailwind/fuchsia/500': '#D946EF',
      'Tailwind/fuchsia/600': '#C026D3',
      'Tailwind/fuchsia/700': '#A21CAF',
      'Tailwind/fuchsia/800': '#86198F',
      'Tailwind/fuchsia/900': '#701A75',
      'Tailwind/fuchsia/950': '#4A044E',
      'Tailwind/pink/50': '#FDF2F8',
      'Tailwind/pink/100': '#FCE7F3',
      'Tailwind/pink/200': '#FBCFE8',
      'Tailwind/pink/300': '#F9A8D4',
      'Tailwind/pink/400': '#F472B6',
      'Tailwind/pink/500': '#EC4899',
      'Tailwind/pink/600': '#DB2777',
      'Tailwind/pink/700': '#BE185D',
      'Tailwind/pink/800': '#9D174D',
      'Tailwind/pink/900': '#831843',
      'Tailwind/pink/950': '#500724',
      'Tailwind/rose/50': '#FFF1F2',
      'Tailwind/rose/100': '#FFE4E6',
      'Tailwind/rose/200': '#FECDD3',
      'Tailwind/rose/300': '#FDA4AF',
      'Tailwind/rose/400': '#FB7185',
      'Tailwind/rose/500': '#F43F5E',
      'Tailwind/rose/600': '#E11D48',
      'Tailwind/rose/700': '#BE123C',
      'Tailwind/rose/800': '#9F1239',
      'Tailwind/rose/900': '#881337',
      'Tailwind/rose/950': '#4C0519',
    },
    fontFamily: {
      BeVnPro: 'Be Vietnam Pro sans-serif',
    },
    borderRadius: {
      sm: '.4rem',
      md: '1rem',
      full: '50%',
    },
    fontSize: {
      'body-14': [
        '1.4rem',
        {
          fontWeight: '400',
        },
      ],
      'body-16': [
        '1.6rem',
        {
          fontWeight: '400',
        },
      ],
      'button-16': [
        '1.6rem',
        {
          fontWeight: '600',
        },
      ],
      'body-18': [
        '1.8rem',
        {
          fontWeight: '600',
        },
      ],
      'title-20': [
        '2rem',
        {
          fontWeight: '700',
        },
      ],
      'title-24': [
        '2.4rem',
        {
          fontWeight: '700',
        },
      ],
      'title-36': [
        '3.6rem',
        {
          fontWeight: '700',
        },
      ],
      'title-50': [
        '5rem',
        {
          fontWeight: '700',
          lineHeight: '6rem',
        },
      ],
      'title-56': [
        '5.6rem',
        {
          fontWeight: '700',
        },
      ],
    },
    container: {
      screens: {
        sm: '540px',
        md: '768px',
        lg: '992px',
        xl: '1200px',
        '2xl': '1320px',
      },
    },
  },
  plugins: [],
  corePlugins: {
    preflight: false,
  },
  important: false,
};
