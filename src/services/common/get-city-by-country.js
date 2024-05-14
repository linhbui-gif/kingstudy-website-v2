import ApiService from '@/services';

export const getCityByCountry = async (params) => {
  const response = await ApiService.get(`/common/get-city-by-country`, {
    params: params,
  });
  return response?.data;
};
