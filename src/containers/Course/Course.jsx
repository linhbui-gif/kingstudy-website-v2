import { useState } from 'react';

import Tabs from '@/components/Tabs';
import CourseAccordion from '@/containers/CourseAccordion';
import { useAPI } from '@/contexts/APIContext';
import { changeArrayToOptions } from '@/utils/utils';

const Course = ({ data, hasDocument, school_id }) => {
  const [activeTabCourse, setActiveCourse] = useState('0');
  const { majors } = useAPI();
  const majorOptions = changeArrayToOptions(majors);
  const campusOptions = [
    {
      key: '0',
      title: 'Tất cả',
      children: (
        <>
          <div className={'max-h-[40rem] overflow-x-auto'}>
            <CourseAccordion
              school_id={school_id}
              hasDocument={hasDocument}
              data={data}
              activeTabCourse={activeTabCourse}
            />
          </div>
        </>
      ),
    },
    {
      key: '1',
      title: 'Đại học',
      children: (
        <>
          <div className={'max-h-[40rem] overflow-x-auto'}>
            <CourseAccordion
              school_id={school_id}
              hasDocument={hasDocument}
              data={data}
              activeTabCourse={activeTabCourse}
            />
          </div>
        </>
      ),
    },
    {
      key: '2',
      title: 'Sau Đại học',
      children: (
        <>
          <div className={'max-h-[40rem] overflow-x-auto'}>
            <CourseAccordion
              school_id={school_id}
              hasDocument={hasDocument}
              data={data}
              activeTabCourse={activeTabCourse}
            />
          </div>
        </>
      ),
    },
    {
      key: '3',
      title: 'Cao đẳng',
      children: (
        <>
          <div className={'max-h-[40rem] overflow-x-auto'}>
            <CourseAccordion
              school_id={school_id}
              hasDocument={hasDocument}
              data={data}
              activeTabCourse={activeTabCourse}
            />
          </div>
        </>
      ),
    },
    {
      key: '4',
      title: 'Khác',
      children: (
        <>
          <div className={'max-h-[40rem] overflow-x-auto'}>
            <CourseAccordion
              school_id={school_id}
              hasDocument={hasDocument}
              data={data}
              activeTabCourse={activeTabCourse}
            />
          </div>
        </>
      ),
    },
  ];
  return (
    <div>
      <Tabs
        onKeyChange={(keyTab) => {
          setActiveCourse(keyTab);
        }}
        hasMajor
        options={campusOptions}
        defaultKey="0"
        majors={majorOptions}
      />
    </div>
  );
};
export default Course;
