export const ETypeNotification = {
  SUCCESS: 'success',
  WARNING: 'warning',
  ERROR: 'error',
  INFO: 'info',
};

export const EResponseCode = {
  UNAUTHORIZED: 401,
};

export const ETimeoutDebounce = {
  SEARCH: 300,
};

export const EProfileSidebar = {
  MY_PROFILE_INFORMATION: 'my-profile',
  TRACKING_PROFILE_INFORMATION: 'tracking-profile',
  MANAGER_PROFILE_INFORMATION: 'manager-profile',
  SCHOOL_FAVORITE: 'school-favorite',
  SETTING: 'setting',
};

export const EUploadType = {
  USER: 'user',
  ATTACHMENT: 'attachment',
};

export const ETTypeGender = {
  MALE: 1,
  FEMALE: 2,
};

export const REGEX = {
  url: /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_+.~#?&//=]*)/i,
  domain: /^[a-zA-Z0-9](?:[a-zA-Z0-9-.]*[a-zA-Z0-9])?$/i,
  alphabetic: /^[a-z\s]+$/i,
  alphanumerial: /^[a-z0-9\s]+$/i,
  numeric: /^\d+$/i,
  onlySpecialKey:
    /^[a-zA-Z\sÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚÝàáâãèéêìíòóôõùúýĂăĐđĨĩŨũƠơƯưẠạẢảẤấẦầẨẩẪẫẬậẮắẰằẲẳẴẵẶặẸẹẺẻẼẽỀềỂểỄễỆệỈỉỊịỌọỎỏỐốỒồỔổỖỗỘộỚớỜờỞởỠỡỢợỤụỦủỨứỪừỬửỮữỰựỲỳỴỵỶỷỸỹ]+$/,
  phoneNumberVietnam: /^0\d{9}$/,
  password:
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/i,
};

export const EFormat = {
  'YYYY-MM-DD': 'YYYY-MM-DD',
  'DD/MM/YYYY - HH:mm': 'DD/MM/YYYY - HH:mm',
  'HH:mm': 'HH:mm',
};
