import { notification } from 'antd';

import { ETypeNotification } from '@/common/enums';

export const showNotification = (type, description) => {
  const options = {
    className: 'Notification',
    description,
    placement: 'top',
  };

  switch (type) {
    case ETypeNotification.SUCCESS:
      notification.success({
        ...options,
        message: '',
      });
      break;
    case ETypeNotification.WARNING:
      notification.warning({
        ...options,
        message: '',
      });
      break;
    case ETypeNotification.ERROR:
      notification.error({
        ...options,
        message: '',
      });
      break;
    case ETypeNotification.INFO:
      notification.info({
        ...options,
        message: '',
      });
      break;
    default:
      break;
  }
};

export const formatNumberWithCommas = (x) => {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
};

export const validationRules = {
  required: (message) => ({
    required: true,
    message: message || 'Vui lòng nhập thông tin trường này !',
  }),
  email: (message) => ({
    type: 'email',
    message: message || 'Vui lòng nhập email hợp lệ !',
  }),
  confirmPassword: (confirmPasswordValue, message) => ({
    validator: (rule, value) => {
      // eslint-disable-next-line no-undef
      if (!value || value === confirmPasswordValue) return Promise.resolve();
      // eslint-disable-next-line no-undef
      return Promise.reject(message || 'Mật khẩu không trùng khớp !');
    },
  }),
};
