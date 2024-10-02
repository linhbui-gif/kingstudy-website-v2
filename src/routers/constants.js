export const ModulePaths = {
  MyProfile: '/profile',
  Auth: '/auth',
  Me: '/me',
};

export const Paths = {
  Home: '/',
  Login: '/login',
  SignUp: '/signup',
  ForgotPassword: '/forgot-password',
  ResetPassword: '/reset-password',
  Success: '/success',
  Dashboard: '/dashboard',
  SchoolFilter: (id) => `/truong-hoc?majors=${id}`,
  School: {
    SchoolDetail: (slug) => `/truong-hoc/${slug}`,
    View: '/truong-hoc',
  },
  Profile: {
    View: '/profile',
    SubmitProfileStep: '/submit-profile',
  },
  Event: {
    View: '/su-kien',
  },
  Blog: {
    View: '/tin-tuc',
    BlogDetail: (slug) => `/tin-tuc/${slug}`,
  },
  About: {
    View: '/gioi-thieu',
  },
  Survey: {
    View: '/khao-sat',
  },
  Menu: {
    View: '/menu',
  },
};
