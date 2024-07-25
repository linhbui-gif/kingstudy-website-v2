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
  SchoolFilter: (id) => `/school?majors=${id}`,
  School: {
    SchoolDetail: (slug) => `/school/${slug}`,
  },
  Profile: {
    View: '/profile',
    SubmitProfileStep: '/submit-profile',
  },
  Event: {
    View: '/event',
  },
  Blog: {
    View: '/blog',
    BlogDetail: (slug) => `/blog/${slug}`,
  },
  About: {
    View: '/about',
  },
  Survey: {
    View: '/survey',
  },
};
