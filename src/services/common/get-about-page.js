import ApiService from '@/services';

export const getAboutContentPage = async (agent) => {
  const response = await ApiService.get(`/common`, {
    httpsAgent: agent,
  });
  return response?.data;
};
