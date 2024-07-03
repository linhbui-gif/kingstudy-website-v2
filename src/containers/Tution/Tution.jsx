import Tabs from '@/components/Tabs';

const Tution = ({ data }) => {
  const campusOptions = [
    {
      key: 'dh',
      title: 'Đại học',
      children: (
        <>
          <div
            dangerouslySetInnerHTML={{
              __html: data?.tuition,
            }}
          />
        </>
      ),
    },
    {
      key: 'after_dh',
      title: 'Sau đại học',
      children: (
        <div
          dangerouslySetInnerHTML={{
            __html: data?.request,
          }}
        />
      ),
    },
  ];
  return <Tabs options={campusOptions} defaultKey="dh" />;
};
export default Tution;
