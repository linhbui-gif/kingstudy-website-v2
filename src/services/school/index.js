import ApiService from '@/services';

export const getListSchool = async (params) => {
  const response = await ApiService.get(`/school/filter-school`, {
    params: params,
  });
  return response?.data;
};

export const getSchoolDetailBySlug = async (slug, agent) => {
  const response = await ApiService.get(`/school/get-detail/${slug}`, {
    httpsAgent: agent,
  });
  return response?.data;
};

export const addSchoolFavorite = async (idSchool) => {
  const response = await ApiService.get(
    `/profile/add-school-wishlist?school_id=${idSchool}`
  );
  return response?.data;
};

export const getListSchoolWishlist = async () => {
  const response = await ApiService.get(`/profile/school-wishlist`);
  return response?.data;
};

export const addSchoolCompareList = async (id) => {
  const response = await ApiService.get(`/school/add-compare-school?id=${id}`);
  return response?.data;
};
export const getSchoolCompareList = async () => {
  const response = await ApiService.get(`/school/list-compare-school`);
  return response?.data;
};

export const removeSchoolCompareList = async (idSchool) => {
  const response = await ApiService.get(
    `/school/remove-compare-school?id=${idSchool}`
  );
  return response?.data;
};
export const surveySchool = async (body) => {
  const response = await ApiService.post(`/school/survey`, body);
  return response?.data;
};
