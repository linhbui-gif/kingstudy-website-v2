import ApiService from '@/services';

export const getRanking = async () => {
  const response = await ApiService.get(`/common/get-ranking`);
  return response?.data;
};
