import ApiService from '@/services';

export const getListBlog = async (params) => {
  const response = await ApiService.get(`/blog`, {
    params: params,
  });
  return response?.data;
};

export const getBlogBySlug = async (slug, agent) => {
  const response = await ApiService.get(`/blog/get-detail/${slug}`, {
    httpsAgent: agent,
  });
  return response?.data;
};

export const getListBlogEvent = async (params) => {
  const response = await ApiService.get(`/blog/get-event`, {
    params: params,
  });
  return response?.data;
};

export const getListCategory = async () => {
  const response = await ApiService.get(`/blog/get-category`);
  return response?.data;
};

export const getBlogByCategory = async (id) => {
  const response = await ApiService.get(`/blog/get-blog-by-category/${id}`);
  return response?.data;
};
