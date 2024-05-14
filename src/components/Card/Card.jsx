import { Flex, Tag } from 'antd';
import Image from 'next/image';
import Link from 'next/link';

import ImageCountryUk from '@/assets/images/image-country-uk.svg';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
const Card = ({ url = '', alt, title, price = 47, oldPrice = 1000 }) => {
  return (
    <div className="Card bg-white lg:shadow-md rounded-sm">
      <div className="Card-header">
        <div className="Card-header-image">
          <Link href={'/'}>
            <Image
              quality={100}
              layout="responsive"
              loading="lazy"
              src={url}
              alt={alt}
              className={'rounded-sm'}
            />
          </Link>
        </div>
      </div>
      <div className="Card-body px-[2.4rem] pt-[2.4rem]">
        <Flex justify={'space-between'} align={'center'}>
          <Tag className={'text-[1.6rem] text-style-13 py-2'} color="#008560">
            Avaiable
          </Tag>
          {/*<Tag color="#F48331">Partner</Tag>*/}
          <Flex align={'center'} gap={'small'}>
            <Icon name={EIconName.Star} />
            <span className={'mt-2 text-body-16 text-style-12'}>4.9 (25)</span>
          </Flex>
        </Flex>
        <h3 className={'my-[8px]'}>
          <Link
            href={'/'}
            className={
              'lg:text-title-24 text-button-16 text-style-7 hover:text-style-7'
            }
          >
            {title}
          </Link>
        </h3>
        <Flex gap={'small'}>
          <span className={'text-body-18 text-style-10'}>{price}đ</span>
          <del className={'text-body-16 text-style-12 mt-1'}>{oldPrice}đ</del>
        </Flex>
        <Flex className={'my-[2.4rem]'}>
          <Flex
            align={'center'}
            gap={'small'}
            className={'ml-[-5px] pr-[.8rem] cursor-pointer'}
            style={{ borderRight: '1px solid #EDEEF2' }}
          >
            <Icon name={EIconName.Compare} width={32} height={32} />
            <span>So sánh</span>
          </Flex>
          <Flex
            align={'center'}
            gap={'small'}
            className={'pl-[.8rem] cursor-pointer'}
          >
            <Icon name={EIconName.Favorite} width={24} height={24} />
            <span>Yêu thích</span>
          </Flex>
        </Flex>
        <Flex align={'center'} justify={'space-between'}>
          <Flex gap={'small'} align={'center'} className={'py-[1.2rem]'}>
            <Image
              quality={100}
              src={ImageCountryUk}
              alt={''}
              loading={'lazy'}
            />
            <span className={'text-body-14 text-style-12'}>United kingdom</span>
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
    </div>
  );
};
export default Card;
