import ProtectedLayout from '@/layouts/ProtectedLayout';

const Me = () => {
  return <div>Me</div>;
};
export default Me;
Me.getLayout = function (page) {
  return (
    <>
      <ProtectedLayout>{page}</ProtectedLayout>
    </>
  );
};
