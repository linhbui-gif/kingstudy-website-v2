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
