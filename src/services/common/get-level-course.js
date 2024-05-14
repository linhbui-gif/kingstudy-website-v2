import ApiService from '@/services';

export const getLevelCourse = async () => {
  const response = await ApiService.get(`/common/get-level`);
  return response?.data;
};
