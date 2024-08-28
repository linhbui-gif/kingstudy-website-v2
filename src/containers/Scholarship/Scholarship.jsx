import { useRouter } from 'next/router';

import Arcodion from '@/components/Arcodion';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
const Scholarship = ({ data }) => {
  const router = useRouter();
  const itemArr =
    data &&
    Object.values(data).map((element, index) => {
      return {
        key: index,
        label: element?.title,
        children: (
          <>
            <div
              className={
                'text-button-16 font-[400] text-style-7 leading-[140%] mb-0'
              }
              dangerouslySetInnerHTML={{
                __html: element?.content,
              }}
            />
            <ButtonComponent
              title={'Xem chi tiết'}
              className={'default mt-[2.4rem]'}
              onClick={() => {
                router.push(`${element?.link}`);
              }}
            />
          </>
        ),
      };
    });
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
    <Arcodion
      className={'modify-school-detail'}
      items={itemArr}
      expandIcon={customExpandIcon}
    />
  );
};
export default Scholarship;
