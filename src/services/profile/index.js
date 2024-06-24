import ApiService from '@/services';

export const updateProfile = async (body) => {
  const response = await ApiService.post(`/profile/update-profile`, body);
  return response?.data;
};

export const getProfileUser = async () => {
  const response = await ApiService.get(`/profile/get-profile`);
  return response?.data;
};

export const followProfileUser = async () => {
  const response = await ApiService.get(`/profile/follow-profile-user`);
  return response?.data;
};

export const submitProfile = async (body) => {
  const response = await ApiService.post(`/profile/save-profile-file`, body);
  return response?.data;
};

export const submitProfileByCourse = async (params) => {
  const response = await ApiService.get(`/profile/process-course-by-school`, {
    params: params,
  });
  return response?.data;
};

export const submitProfileStudyAboard = async (body) => {
  const response = await ApiService.post(
    `/profile/update-information-study-aboard`,
    body
  );
  return response?.data;
};
