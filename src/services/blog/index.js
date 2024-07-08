import ApiService from '@/services';

export const getListBlog = async (params) => {
  const response = await ApiService.get(`/blog`, {
    params: params,
  });
  return response?.data;
};

export const getBlogBySlug = async (slug) => {
  const response = await ApiService.get(`/blog/get-detail/${slug}`);
  return response?.data;
};

export const getListBlogEvent = async (params) => {
  const response = await ApiService.get(`/blog/get-event`, {
    params: params,
  });
  return response?.data;
};
