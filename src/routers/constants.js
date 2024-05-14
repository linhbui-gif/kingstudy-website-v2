export const ModulePaths = {
  MyProfile: '/my-user',
  Admin: '/admin',
  Me: '/me',
};

export const Paths = {
  Home: '/',
  Login: '/login',
  SignUp: '/sign-up',
  ForgotPassword: '/forgot-password',
  ResetPassword: '/reset-password',
  Success: '/success',
  Dashboard: '/dashboard',
  SchoolFilter: (id) => `/school?majors=${id}`,
};
