export const AppConfig = {
  site_name: 'KingStudy',
  title: 'KingStudy',
  description: 'Personalized AI fitness coaching for all',
  url: 'https://example.com',
  locale: 'vi',
  author: 'KingStudy',
  pagination_size: 5,
};

export const addTrailingSlash = (url) => {
  // If the trailing slash exists, it is replaced with /.
  // If the trailing slash does not exist, a / is appended to the end
  // (to be exact: The trailing anchor is replaced with /)
  return url.replace(/\/?$/, '/');
};

export const isBrowser = () => {
  return typeof window !== 'undefined';
};
