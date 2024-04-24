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
