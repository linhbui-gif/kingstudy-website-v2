import axios from 'axios';

import Helpers from './helpers';
import { EResponseCode, ETypeNotification } from '@/common/enums';
import { Paths } from '@/routers/constants';
import { showNotification } from '@/utils/functions';

const AuthorizedInstance = (baseURL) => {
  const instance = axios.create({
    baseURL,
  });

  const onRequest = (request) => {
    const authBearer = Helpers.getAccessToken();

    if (authBearer) {
      request.headers.Authorization = `${authBearer}`;
    }

    return request;
  };

  const onResponseSuccess = (response) => response;

  const onResponseError = async (axiosError) => {
    const { response } = axiosError;
    const responseStatus = response?.status;
    const originalRequest = axiosError.config;
    if (responseStatus === EResponseCode.UNAUTHORIZED && originalRequest) {
      Helpers.clearTokens();
      window.location.href = `${Paths.Login}`;
      showNotification(
        ETypeNotification.ERROR,
        'Tài khoản đã hết hạn phiên sử dụng. Vui lòng đăng nhập lại'
      );
    }

    // eslint-disable-next-line no-undef
    return Promise.reject(axiosError);
  };

  instance.interceptors.request.use(onRequest);
  instance.interceptors.response.use(onResponseSuccess, onResponseError);

  return instance;
};

export default AuthorizedInstance;
