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
    try {
      const postsResponse = await axios.get(
        'https://admin.kingstudy.vn/api/v1/blog'
      );
      const postsData = postsResponse?.data?.data;

      const schoolsResponse = await axios.get(
        'https://admin.kingstudy.vn/api/v1/school?limit=500'
      );
      const schoolsData = schoolsResponse?.data?.data?.data;

      // Tạo paths từ bài viết
      const postPaths = postsData?.length
        ? postsData.map((post) => ({
            loc: `/tin-tuc/${post.alias}`,
            lastmod: post.updated_at || new Date().toISOString(),
            changefreq: 'daily',
            priority: 0.8,
          }))
        : [];

      // Tạo paths từ trường học
      const schoolPaths = schoolsData?.length
        ? schoolsData.map((school) => ({
            loc: `/truong-hoc/${school.slug}`, // Giả sử trường có thuộc tính 'alias'
            lastmod: school.updated_at || new Date().toISOString(),
            changefreq: 'daily',
            priority: 0.8,
          }))
        : [];

      // Kết hợp các paths từ bài viết và trường học
      return [...postPaths, ...schoolPaths];
    } catch (error) {
      return []; // Trả về mảng rỗng nếu có lỗi
    }
  },
};
