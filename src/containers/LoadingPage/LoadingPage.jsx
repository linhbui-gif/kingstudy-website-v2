import { Progress } from 'antd';
import Image from 'next/image';

import Logo from '@/assets/images/logo.svg';
const LoadingPage = ({ done, percent }) => {
  return (
    <div
      className={`fixed transition-all z-50 top-0 left-0 w-full h-full flex items-center justify-center bg-style-10 ${
        done ? 'hidden' : 'block'
      }`}
    >
      <div className={'flex flex-col items-center max-w-[50rem] lg:w-[50rem]'}>
        <Image quality={100} src={Logo} alt={''} />
        <Progress status="active" percent={percent} showInfo={false} />
      </div>
    </div>
  );
};
export default LoadingPage;
