import ApiService from '@/services';

export const getSmartSearch = async (body) => {
  const response = await ApiService.post(`/common/search`, body);
  return response?.data;
};
