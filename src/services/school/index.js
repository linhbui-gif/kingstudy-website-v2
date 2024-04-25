import ApiService from '@/services';

export const getListSchool = async () => {
  const response = await ApiService.get(`/school`);
  return response?.data;
};
