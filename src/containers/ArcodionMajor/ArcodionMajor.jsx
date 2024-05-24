import { majorOptions } from './Major.data';
import Arcodion from '@/components/Arcodion';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
const ArcodionMajor = () => {
  const items = [
    {
      key: '1',
      label: 'Ngành Học',
      children: (
        <div className="py-[0.6rem]">
          {majorOptions.map((item, index) => (
            <div className="mb-10 text-body-16 text-style-12" key={index}>
              {item.label}
            </div>
          ))}
        </div>
      ),
    },
  ];

  const customExpandIcon = ({ isActive }) => (
    <div className="">
      {isActive ? (
        <Icon name={EIconName.ArowDown} color={EIconColor.STYLE_PLUS} />
      ) : (
        <Icon
          className="transform rotate-180"
          name={EIconName.ArowDown}
          color={EIconColor.STYLE_PLUS}
        />
      )}
    </div>
  );
  return (
    <section className={'py-[2rem] lg:py-[7rem]'}>
      <Container>
        <Arcodion
          className={'major'}
          items={items}
          defaultActiveKey={['1']}
          expandIcon={customExpandIcon}
        />
      </Container>
    </section>
  );
};
export default ArcodionMajor;
