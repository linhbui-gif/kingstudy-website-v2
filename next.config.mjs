/** @type {import('next').NextConfig} */
import TerserPlugin from 'terser-webpack-plugin';
import CssMinimizerPlugin from 'css-minimizer-webpack-plugin';
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
  webpack: (config, { isServer }) => {
    if (!isServer) {
      config.optimization.minimizer.push(
        new TerserPlugin({
          terserOptions: {
            compress: {
              drop_console: true,
            },
          },
          extractComments: false,
        })
      );

      config.optimization.minimizer.push(
        new CssMinimizerPlugin()
      );
    }

    return config;
  },
};

export default nextConfig;
