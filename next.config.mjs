/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: false,
  transpilePackages: [
    'antd',
    '@ant-design',
    'rc-util',
    'rc-pagination',
    'rc-picker',
    'rc-notification',
    'rc-tooltip',
    'rc-tree',
    'rc-table',
  ],
  compiler: {
    removeConsole: false,
  },
  images: {
    domains: [
      'admin.kingstudy.vn',
      'localhost',
      'king-study.loc',
      'devwebsite.kingstudy.vn',
      'kingstudy.vn'
    ],
    dangerouslyAllowSVG: true,
    contentDispositionType: 'attachment',
    contentSecurityPolicy: "default-src 'self'; script-src 'none'; sandbox;",
    formats: ['image/webp'],
  },
  devIndicators: {
    buildActivity: false,
  },
  trailingSlash: false,
};

export default nextConfig;
