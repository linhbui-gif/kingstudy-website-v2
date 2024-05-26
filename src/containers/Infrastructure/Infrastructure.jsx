import Tabs from '@/components/Tabs';

const Infrastructure = ({ data }) => {
  const campusOptions = [
    {
      key: 'campus',
      title: 'Campus',
      children: (
        <div
          dangerouslySetInnerHTML={{
            __html: data?.college,
          }}
        />
      ),
    },
    {
      key: 'accommodation',
      title: 'Accommodation',
      children: (
        <div
          dangerouslySetInnerHTML={{
            __html: data?.after_college,
          }}
        />
      ),
    },
  ];
  return <Tabs options={campusOptions} defaultKey="campus" />;
};
export default Infrastructure;
