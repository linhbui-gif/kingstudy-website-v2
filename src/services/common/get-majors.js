import ApiService from '@/services';

export const getMajors = async () => {
  const response = await ApiService.get(`/common/get-major`);
  return response?.data;
};
