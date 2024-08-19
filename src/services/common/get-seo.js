import ApiService from '@/services';

export const getSeoCommon = async (agent) => {
  const response = await ApiService.get(`/common/seo`, {
    httpsAgent: agent,
  });
  return response?.data;
};
