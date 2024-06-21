import { notification, Tag } from 'antd';

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

export const formatNumbersWithCommas = (number) => {
  let numberString = number.toString();
  numberString = numberString.replace('.', '');
  return parseInt(numberString, 10).toLocaleString('en-US');
};

export const getFileExtension = (filename) => {
  const parts = filename.split('.');
  if (parts.length > 1) {
    return parts.pop().toLowerCase();
  }
  return '';
};

export const groupByArray = (arr, key) => {
  return arr.reduce((result, item) => {
    const groupKey = item[key];
    if (!result[groupKey]) {
      result[groupKey] = [];
    }
    result[groupKey].push(item);
    return result;
  }, {});
};

export const renderStatusCourse = (status) => {
  switch (status) {
    case '0':
      return <Tag color="orange">Processing</Tag>;
    case '1':
      return <Tag color="success">Applied</Tag>;
    case '2':
      return <Tag color="orange">Chase</Tag>;
    case '3':
      return <Tag color="orange">Conditional Offer</Tag>;
    case '4':
      return <Tag color="orange">Unconditional Offer</Tag>;
    case '5':
      return <Tag color="red">Cancel</Tag>;
    case '6':
      return <Tag color="purple">Accept Offer</Tag>;
    case '7':
      return <Tag color="red">Fail</Tag>;
    case '8':
      return <Tag color="success">Successful</Tag>;
  }
};

export const parseObjectToFormData = (data) => {
  const formData = new FormData();
  Object.keys(data).forEach((key) => {
    if (typeof data[key] === 'undefined') return;
    formData.append(key, data[key]);
  });
  return formData;
};

export const slugify = (text) => {
  const from =
    'ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪỬỮỰỳỵỷỹ';
  const to =
    'AAAAEEEIIOOOOUUAĐIUOaaaaeeeiiioooouuaduoUAAAAAAAEEEEEEEEaaaaaaaeeeeeIIIIIIIIIIUUUUUyyyy';

  const map = {};
  for (let i = 0; i < from.length; i++) {
    map[from.charAt(i)] = to.charAt(i);
  }

  const removeDiacritics = (str) => {
    return str
      .split('')
      .map((char) => map[char] || char)
      .join('');
  };

  let slug = text.toLowerCase();

  slug = removeDiacritics(slug);

  slug = slug.replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-');

  slug = slug.replace(/^-+|-+$/g, '');

  return slug;
};
