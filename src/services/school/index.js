import ApiService from '@/services';

export const getListSchool = async (params) => {
  const response = await ApiService.get(`/school/filter-school`, {
    params: params,
  });
  return response?.data;
};

export const getSchoolDetailBySlug = async (slug) => {
  const response = await ApiService.get(`/school/get-detail/${slug}`);
  return response?.data;
};
