/** @type {import('next').NextConfig} */
import DuplicatePackageCheckerPlugin from 'duplicate-package-checker-webpack-plugin';
import withPWA from 'next-pwa';
import withBundleAnalyzer from '@next/bundle-analyzer';

const runtimeCaching = [
  {
    urlPattern: /\/api\/.*\/*.json/,
    handler: 'NetworkFirst',
    options: {
      cacheName: 'api-cache',
      expiration: {
        maxEntries: 50,
        maxAgeSeconds: 86400,
      },
    },
  },
];
const withPWAConfig = withPWA({
  dest: 'public',
  register: true,
  skipWaiting: true,
  runtimeCaching,
  disable: process.env.NODE_ENV === 'development',
  buildExcludes: [/middleware-manifest.json$/],
  maximumFileSizeToCacheInBytes: 4000000,
})

const withBundleAnalyzerConfig = withBundleAnalyzer({
  enabled: process.env.ANALYZE === 'true',
})

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
  experimental: {
    optimizeCss: true,
    legacyBrowsers: false,
    nextScriptWorkers: true,
  },
  compiler: {
    removeConsole: process.env.NODE_ENV !== 'development',
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
  webpack: (config, options) => {
    config.plugins.push(new DuplicatePackageCheckerPlugin())

    return config
  }
};

export default () => {
  const plugins = [withPWAConfig, withBundleAnalyzerConfig]
  return plugins.reduce((acc, plugin) => plugin(acc), {
    ...nextConfig,
  })
}