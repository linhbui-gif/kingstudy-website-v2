const axios = require('axios');
module.exports = {
  siteUrl: process.env.NEXT_PUBLIC_DOMAIN_NAME || 'https://kingstudy.vn/',
  generateRobotsTxt: true,
  changefreq: 'weekly',
  priority: 0.7,
  sitemapSize: 5000,
  exclude: [
    '/me',
    '/submit-profile',
    '/auth/login',
    '/auth/signup',
    '/component-guide',
    '/profile',
  ],

  additionalPaths: async () => {
    const posts = await axios.get('https://admin.kingstudy.vn/api/v1/blog'); // Gọi API để lấy danh sách bài viết
    const data = posts?.data;

    const paths = data?.length
      ? data.map((post) => ({
          loc: `/tin-tuc/${post.alias}`,
          lastmod: post.updated_at || new Date().toISOString(),
          changefreq: 'weekly',
          priority: 0.8,
        }))
      : [];

    return paths;
  },
};
