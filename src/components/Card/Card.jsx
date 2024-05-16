import { Flex } from 'antd';
import Image from 'next/image';
import Link from 'next/link';

import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import { rootUrl, statusSchool } from '@/utils/utils';
const Card = ({
  url = '',
  alt,
  title,
  price = 47,
  oldPrice = 1000,
  type,
  country,
}) => {
  return (
    <div className="Card bg-white lg:shadow-md rounded-md">
      <div className="Card-header">
        <div className="Card-header-image">
          <Link href={'/'}>
            <Image
              quality={100}
              layout="responsive"
              loading="lazy"
              src={url}
              alt={alt}
              className={'rounded-md'}
              width={420}
              height={236}
            />
          </Link>
        </div>
      </div>
      <div className="Card-body px-[2.4rem] pt-[2.4rem]">
        <Flex justify={'space-between'} align={'center'}>
          {statusSchool(type)}
          <Flex align={'center'} gap={'small'}>
            <Icon name={EIconName.Star} />
            <span className={'mt-2 text-body-16 text-style-12'}>4.9 (25)</span>
          </Flex>
        </Flex>
        <h3 className={'my-[8px]'}>
          <Link
            href={'/'}
            className={
              'block w-full lg:font-[700] text-button-16 lg:text-[2rem] text-style-7 hover:text-style-7'
            }
          >
            {title}
          </Link>
        </h3>
        <Flex gap={'small'}>
          <span className={'text-body-18 text-style-10'}>{price}đ</span>
          <del className={'text-body-16 text-style-12 mt-1'}>{oldPrice}đ</del>
        </Flex>
        <Flex className={'my-[2.4rem] ml-[-1rem]'}>
          <Flex align={'center'} gap={'small'} className={'cursor-pointer'}>
            <Icon name={EIconName.Compare} width={40} height={40} />
          </Flex>
          <Flex align={'center'} gap={'small'} className={' cursor-pointer'}>
            <Icon name={EIconName.Favorite} width={25} height={25} />
          </Flex>
        </Flex>
      </div>
      <Flex
        align={'center'}
        justify={'space-between'}
        className={'relative px-[2.4rem]'}
        style={{ borderTop: '1px solid #edeef2' }}
      >
        <Flex
          gap={'small'}
          align={'center'}
          className={
            'before:absolute before:content-[""] before:bg-style-8 before:m-auto before:top-0 before:left-0 before:right-0 before:w-[1px] before:h-full py-[1.2rem]'
          }
        >
          <Image
            quality={100}
            src={`${rootUrl}${country?.icon ? country?.icon : ''}`}
            alt={''}
            loading={'lazy'}
            width={18}
            height={18}
          />
          <span className={'text-body-14 text-style-12'}>{country?.name}</span>
        </Flex>
        <Link href={'/'}>
          <Flex gap={'small'} align={'center'} className={'py-[1.2rem]'}>
            <span className={'text-body-14 font-[700] text-style-10'}>
              Chi Tiết
            </span>
            <Icon name={EIconName.Arrow_Right} color={EIconColor.STYLE_10} />
          </Flex>
        </Link>
      </Flex>
    </div>
  );
};
export default Card;
