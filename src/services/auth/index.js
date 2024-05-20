import ApiService from '@/services';

export const signIn = async (body) => {
  const response = await ApiService.post(`/auth/login`, body);
  return response?.data;
};

export const signUp = async (body) => {
  const response = await ApiService.post(`/auth/signUp`, body);
  return response?.data;
};
