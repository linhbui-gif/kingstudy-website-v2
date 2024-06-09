import ApiService from '@/services';

export const updateProfile = async (body) => {
  const response = await ApiService.post(`/profile/update-profile`, body);
  return response?.data;
};

export const getProfileUser = async () => {
  const response = await ApiService.get(`/profile/get-profile`);
  return response?.data;
};
