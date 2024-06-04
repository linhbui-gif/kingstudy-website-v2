import ApiService from '@/services';

export const getCountries = async () => {
  const response = await ApiService.get(`/common/get-country`);
  return response?.data;
};
