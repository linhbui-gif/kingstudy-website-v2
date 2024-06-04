const AuthLayout = ({ children }) => {
  return (
    <div
      className={
        'AuthLayout min-h-screen px-4 bg-style-10 flex items-center justify-center '
      }
    >
      {children}
    </div>
  );
};
export default AuthLayout;
