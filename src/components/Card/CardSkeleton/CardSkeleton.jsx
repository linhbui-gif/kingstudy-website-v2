import SkeletonImage from 'antd/es/skeleton/Image';
import SkeletonInput from 'antd/es/skeleton/Input';

const CardSkeleton = () => {
  return (
    <div className="Card w-full">
      <div className="Card-header">
        <div className="Card-header-image">
          <SkeletonImage active />
        </div>
      </div>
      <div className="Card-body">
        <div className={'mt-2'}>
          <SkeletonInput active />
        </div>
        <div className={'mt-2'}>
          <SkeletonInput active />
        </div>
      </div>
    </div>
  );
};
export default CardSkeleton;
