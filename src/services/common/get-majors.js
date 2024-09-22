import ApiService from '@/services';

export const getMajors = async (params) => {
  const response = await ApiService.get(`/common/get-major`, {
    params: params,
  });
  return response?.data;
};
