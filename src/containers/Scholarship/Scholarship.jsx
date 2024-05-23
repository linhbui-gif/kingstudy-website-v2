import Arcodion from '@/components/Arcodion';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
const Scholarship = () => {
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
        </div>
      ),
    },
    {
      key: '2',
      label: 'International Merit Scholarship (£1,000-£2,000)',
      children: (
        <p className="text-button-16 font-[400] text-style-7 leading-[140%] mb-0">
          <strong>How do I apply?</strong> We will automatically consider you
          for this scholarship when you apply for the MBA.
        </p>
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
  return (
    <section className={'py-[2rem] lg:py-[7rem]'}>
      <Container>
        <h2 className="text-title-20 leading-[120%] text-style-7">Học Bổng</h2>
        <Arcodion
          items={items}
          defaultActiveKey={['1']}
          expandIcon={customExpandIcon}
        />
      </Container>
    </section>
  );
};
export default Scholarship;
