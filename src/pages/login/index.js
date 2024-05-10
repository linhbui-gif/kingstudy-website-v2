import Meta from '@/components/Meta';
import AuthLayout from '@/layouts/AuthLayout';

const Login = () => {
  return <div> Hello login</div>;
};
export default Login;
Login.getLayout = function (page) {
  return (
    <>
      <Meta />
      <AuthLayout>{page}</AuthLayout>
    </>
  );
};
