import { Space } from 'antd';

import Arcodion from '@/components/Arcodion';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
const CourseAccordion = () => {
  const items = [
    {
      key: '1',
      label: 'MBA Scholarship (£4,000)',
      children: (
        <div>
          <p className="text-button-16 font-[400] text-style-7 leading-[140%] mb-0">
            <strong>What is it?</strong> Boost your career prospects with our
            prestigious Master of Business Administration (MBA) degrees. Study
            in Cambridge and take advantage of our scholarship, which takes the
            form of a fee reduction.
          </p>
          <p className="text-button-16 font-[400] text-style-7 leading-[140%] mb-0">
            <strong>Who is it for?</strong> UK or international students on our
            MBA course.
          </p>
          <p className="text-button-16 font-[400] text-style-7 leading-[140%] mb-0">
            <strong>How much is it worth?</strong> £4,000 for a one-year course,
            or £2,000 for a two-year course with placement.
          </p>
          <p className="text-button-16 font-[400] text-style-7 leading-[140%] mb-0">
            <strong>How do I apply?</strong> We will automatically consider you
            for this scholarship when you apply for the MBA.
          </p>
          <Space>
            <ButtonComponent
              title={'Nộp hồ sơ'}
              className={'primary mt-[2.4rem]'}
            />
            <ButtonComponent
              title={'Xem chi tiết'}
              className={'default mt-[2.4rem]'}
            />
          </Space>
        </div>
      ),
    },
    {
      key: '2',
      label: 'International Merit Scholarship (£1,000-£2,000)',
      children: (
        <div>
          <p className="text-button-16 font-[400] text-style-7 leading-[140%] mb-0">
            <strong>How do I apply?</strong> We will automatically consider you
            for this scholarship when you apply for the MBA.
          </p>
          <ButtonComponent
            title={'Xem chi tiết'}
            className={'default mt-[2.4rem]'}
          />
        </div>
      ),
    },
  ];

  const customExpandIcon = ({ isActive }) => (
    <div>
      {isActive ? (
        <Icon name={EIconName.Minus} />
      ) : (
        <Icon name={EIconName.Plus} />
      )}
    </div>
  );
  return <Arcodion items={items} expandIcon={customExpandIcon} />;
};
export default CourseAccordion;
