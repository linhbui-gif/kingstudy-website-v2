import Tabs from '@/components/Tabs';
import CourseAccordion from '@/containers/CourseAccordion';

const Course = ({ data }) => {
  const campusOptions = [
    {
      key: 'all',
      title: 'Tất cả',
      children: (
        <>
          <div className={'max-h-[40rem] overflow-x-auto'}>
            <CourseAccordion />
          </div>
        </>
      ),
    },
    {
      key: 'daihoc',
      title: 'Đại học',
      children: (
        <div
          dangerouslySetInnerHTML={{
            __html: data?.after_college,
          }}
        />
      ),
    },
    {
      key: 'saudaihoc',
      title: 'Sau Đại học',
      children: (
        <div
          dangerouslySetInnerHTML={{
            __html: data?.after_college,
          }}
        />
      ),
    },
    {
      key: 'caodang',
      title: 'Cao đẳng',
      children: (
        <div
          dangerouslySetInnerHTML={{
            __html: data?.after_college,
          }}
        />
      ),
    },
    {
      key: 'khac',
      title: 'Khác',
      children: (
        <div
          dangerouslySetInnerHTML={{
            __html: data?.after_college,
          }}
        />
      ),
    },
  ];
  return (
    <div>
      <Tabs hasMajor options={campusOptions} defaultKey="all" />
    </div>
  );
};
export default Course;
