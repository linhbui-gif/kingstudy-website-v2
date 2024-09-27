import ApiService from '@/services';

export const sendContact = async (body) => {
  const response = await ApiService.post(`/common/save-contact`, body);
  return response?.data;
};
