import { Progress } from 'antd';
import Image from 'next/image';

import ImageLoading from '@/assets/images/image-loading.gif';
const LoadingPage = ({ done }) => {
  return (
    <div
      className={`fixed w-full h-full top-0 left-0 z-[9999] ${
        done ? 'hidden' : 'block'
      }`}
      style={{
        backgroundImage: "url('/images/image-loading.gif')",
        backgroundSize: 'cover',
        backgroundPosition: 'center',
      }}
    ></div>
  );
};
export default LoadingPage;
