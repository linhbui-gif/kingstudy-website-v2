import ApiService from '@/services';

export const uploadCommon = async (object, body) => {
  const response = await ApiService.post(`/upload-temp?object=${object}`, body);
  return response?.data;
};
