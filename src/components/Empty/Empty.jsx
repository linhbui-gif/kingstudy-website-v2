import Image from 'next/image';

import ImageEmpty from '@/assets/images/image-empty.webp';
const Empty = () => {
  return (
    <Image
      src={ImageEmpty}
      alt={'empty-data'}
      loading={'lazy'}
      width={404}
      height={404}
    />
  );
};
export default Empty;
