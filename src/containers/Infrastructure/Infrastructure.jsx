import DOMPurify from 'isomorphic-dompurify';

import Tabs from '@/components/Tabs';

const Infrastructure = ({ data, after_college }) => {
  const cleanHTML = DOMPurify.sanitize(after_college);
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
            __html: cleanHTML,
          }}
        />
      ),
    },
  ];
  return <Tabs options={campusOptions} defaultKey="campus" />;
};
export default Infrastructure;
