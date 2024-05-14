import ApiService from '@/services';

export const getListSchool = async (params) => {
  const response = await ApiService.get(`/school/filter-school`, {
    params: params,
  });
  return response?.data;
};
