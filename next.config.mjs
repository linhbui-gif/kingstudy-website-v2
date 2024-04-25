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
    removeConsole: true,
  },
  images: {
    domains: ['kingstudy.vn','localhost','king-study.loc'],
  },
  devIndicators: {
    buildActivity: false,
  },
  trailingSlash: false,
};

export default nextConfig;
