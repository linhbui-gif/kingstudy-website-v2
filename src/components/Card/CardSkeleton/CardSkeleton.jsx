import { Flex } from 'antd';
import SkeletonImage from 'antd/es/skeleton/Image';
import SkeletonInput from 'antd/es/skeleton/Input';

const CardSkeleton = () => {
  return (
    <div className="Card w-full">
      <div className="Card-header">
        <div className="Card-header-image">
          <SkeletonImage className={''} active />
        </div>
      </div>
      <div className="Card-body bg-white shadow-md rounded-sm p-[2.4rem]">
        <div className={'Card-body-title'}>
          <SkeletonInput active />
        </div>
        <div className={'Card-body-price'}>
          <SkeletonInput active />
        </div>
        <div className={'Card-body-action'}>
          <SkeletonInput active />
        </div>
        <Flex
          className={'Card-body-country mt-10'}
          align={'center'}
          justify={'space-between'}
        >
          <SkeletonInput active />
          <SkeletonInput active />
        </Flex>
      </div>
    </div>
  );
};
export default CardSkeleton;
